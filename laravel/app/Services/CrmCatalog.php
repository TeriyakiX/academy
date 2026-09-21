<?php

namespace App\Services;

/**
 * Курсы и тексты из CRM вместо файлов настроек.
 *
 * Шаблоны сайта читают данные из config('home'), config('courses'),
 * config('course-pages') и config('site.pages'). Чтобы не переписывать
 * шаблоны, при запросе подменяем эти настройки данными из CRM. Если CRM
 * ничего не отдала, настройки остаются как есть и сайт работает на файлах.
 */
class CrmCatalog
{
    /** Страница, с которой копируется оформление для новых курсов. */
    private const PAGE_TEMPLATE = '/courses/barista-base.html';

    public function __construct(private CrmClient $crm)
    {
    }

    public function apply(): void
    {
        $this->applyBlocks();
        $this->applyCourses();
    }

    /**
     * Тексты главной и скидки. Ключ блока в CRM совпадает с ключом
     * настройки на сайте: home.faq → config('home.faq').
     */
    private function applyBlocks(): void
    {
        $blocks = $this->crm->cached('blocks')['blocks'] ?? [];

        foreach ($blocks as $key => $value) {
            if (is_array($value) && preg_match('/^(home|courses)\.[a-z_]+$/', $key)) {
                config([$key => $value]);
            }
        }
    }

    private function applyCourses(): void
    {
        $data = $this->crm->cached('courses', ['full' => 1]);

        if (empty($data['schools'])) {
            return;
        }

        $schools = [];
        $pages = config('course-pages', []);
        $seo = config('site.pages', []);

        foreach ($data['schools'] as $school => $courses) {
            foreach ($courses as $course) {
                $schools[$school][] = $this->card($course);

                if (!$course['has_page']) {
                    continue;
                }

                $url = $course['url'];

                $pages[$url] = [
                    'title'   => $course['title'],
                    'lead'    => $course['lead'],
                    'facts'   => $this->facts($course['facts'] ?: ($pages[$url]['facts'] ?? []), (int) $course['price']),
                    'program' => $course['program'],
                    'days'    => $course['days'],
                    'learn'   => $course['learn'],
                    'gallery' => $course['gallery'] ?: ($pages[$url]['gallery'] ?? []),
                    'groups'  => $course['groups'] ?? [],
                ];

                $seo[$url] = $this->seo($seo[$url] ?? null, $seo[self::PAGE_TEMPLATE] ?? [], $url, $course);
            }
        }

        config([
            'courses.schools' => $schools,
            'courses.discounts' => $data['discounts'] ?: config('courses.discounts'),
            'course-pages' => $pages,
            'site.pages' => $seo,
        ]);
    }

    /** Карточка в том же виде, что в config/courses.php. */
    private function card(array $course): array
    {
        return array_filter([
            // Идентификатор — имя файла страницы: так он совпадает со старыми
            // и выбор в конструкторе, сохранённый у посетителя, не теряется.
            'id'       => basename($course['url'], '.html'),
            'title'    => $course['title'],
            'desc'     => $course['desc'],
            'price'    => (int) $course['price'],
            'old'      => $course['old'] ? (int) $course['old'] : null,
            'url'      => $course['url'],
            'duration' => $course['duration'],
            'format'   => $course['format'],
            'schedule' => $course['schedule'],
            'badge'    => $course['badge'],
            'photo'    => $course['photo'],
        ], fn ($value) => $value !== null);
    }

    /**
     * В характеристиках цена записана текстом — строку «за одного» берём
     * из CRM, чтобы не расходилась. Цены за двоих и больше остаются как есть.
     */
    private function facts(array $facts, int $price): array
    {
        if (!isset($facts['стоимость'])) {
            return $facts;
        }

        $single = 'за одного — ' . number_format($price, 0, '', ' ') . ' ₽';
        $lines = (array) $facts['стоимость'];
        $lines[0] = $single;

        $facts['стоимость'] = count($lines) === 1 ? $lines[0] : $lines;

        return $facts;
    }

    /** Заголовки для поисковиков: из CRM, иначе прежние. */
    private function seo(?array $current, array $template, string $url, array $course): array
    {
        $page = $current ?? array_merge($template, [
            'keywords'  => '',
            'canonical' => 'https://academy-barista.ru' . $url,
        ]);

        $page['title'] = $course['seo']['title'] ?: ($current['title'] ?? $course['title'] . ' – Академия Бариста');
        $page['og_title'] = $page['title'];
        $page['description'] = $course['seo']['description'] ?: ($current['description'] ?? (string) $course['desc']);

        return $page;
    }
}
