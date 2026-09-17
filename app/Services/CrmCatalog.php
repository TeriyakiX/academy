<?php

namespace App\Services;

/**
 * Курсы из CRM вместо файлов настроек.
 *
 * Шаблоны сайта читают курсы из config('courses'), config('course-pages')
 * и config('site.pages'). Чтобы не переписывать шаблоны, при запросе
 * подменяем эти настройки данными из CRM. Если CRM ничего не отдала,
 * настройки остаются как есть и сайт работает на файлах.
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
                    'facts'   => $course['facts'] ?: ($pages[$url]['facts'] ?? []),
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
