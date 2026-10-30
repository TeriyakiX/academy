<?php

namespace App\Services;

/**
 * Курсы и тексты из CRM вместо файлов настроек.
 *
 * Шаблоны сайта читают данные из config('home'), config('courses'),
 * config('course-pages'), config('site.pages') и config('blog'). Чтобы не переписывать
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
        $this->applyEvents();
        $this->applyArticles();
    }

    /** Статьи блога. Пустой ответ CRM статьи из файла не стирает. */
    private function applyArticles(): void
    {
        $articles = $this->crm->cached('articles')['articles'] ?? [];

        if ($articles) {
            config(['blog.articles' => $articles]);
        }
    }

    /*
     | Блоки, которые ведём в файлах сайта, а не в CRM.
     |
     | «Чем занимается школа» — это структура сайта: направления появляются
     | вместе со страницами. Когда блок шёл из CRM, новое направление надо
     | было заводить дважды, и правка в файле на боевом просто не появлялась.
     | Тексты, которые школа правит сама (например home.faq), остаются в CRM.
     */
    private const OWN_BLOCKS = ['home.events'];

    /**
     * Тексты главной и скидки. Ключ блока в CRM совпадает с ключом
     * настройки на сайте: home.faq → config('home.faq').
     */
    private function applyBlocks(): void
    {
        $blocks = $this->crm->cached('blocks')['blocks'] ?? [];

        foreach ($blocks as $key => $value) {
            if (in_array($key, self::OWN_BLOCKS, true)) {
                continue;
            }

            /* Из `site.*` школе доверяем только заголовки и описания
               страниц. Редиректы и снятые программы держат индексацию,
               их правит разработчик. */
            if ($key === 'site.pages' && is_array($value)) {
                $pages = config('site.pages', []);

                foreach ($value as $url => $page) {
                    if (!is_array($page)) {
                        continue;
                    }

                    /* Берём только заголовок и описание: canonical,
                       robots и og-поля остаются файловыми. */
                    $pages[$url] = array_filter([
                        'title'       => $page['title'] ?? null,
                        'description' => $page['description'] ?? null,
                    ]) + ($pages[$url] ?? []);
                }

                config(['site.pages' => $pages]);
                continue;
            }

            /* Тексты страниц тоже переехали в CRM: кроме главной и курсов
               принимаем «для бизнеса», сервис и контакты. Ключ блока
               совпадает с ключом настройки, поэтому шаблоны не трогаем. */
            if (is_array($value) && preg_match('/^(home|courses|business|service|nav|documents)\.[a-z_]+$/', $key)) {
                /* Строку выгружали обёрткой {"value": "…"} - разворачиваем
                   обратно, иначе в шаблон приходит массив. */
                if (array_keys($value) === ['value']) {
                    config([$key => $value['value']]);
                    continue;
                }

                if ($key === 'nav.footer') {
                    $value = self::columns($value);

                    if ($value === []) {
                        continue;
                    }
                }

                if ($key === 'nav.legal') {
                    $value = self::links($value);

                    if ($value === []) {
                        continue;
                    }
                }

                if ($key === 'nav.main') {
                    $value = self::menu($value);

                    /* Пустое меню не ставим: лучше прежнее, чем шапка без ссылок. */
                    if ($value === []) {
                        continue;
                    }
                }

                /* Блок из CRM кладём поверх файлового, но технические
                   ключи, которых в панели нет (например, через сколько
                   дней повторить предложение), не теряем. Списки
                   заменяем целиком: дополнять их нечем. */
                $current = config($key);

                if (self::named($value) && self::named($current)) {
                    $value += $current;
                }

                config([$key => $value]);
            }
        }
    }

    /** Массив с именами ключей, а не список. */
    private static function named($value): bool
    {
        return is_array($value) && $value !== [] && array_keys($value) !== range(0, count($value) - 1);
    }

    /*
     | Меню школа переставляет в CRM. Пункт без названия или без адреса
     | уводит в никуда, поэтому такие выбрасываем, а признаки разметки
     | (выпадающий список услуг, направление курсов) берём из файла по
     | адресу: в CRM их никто не заполняет.
     */
    /*
     | Подвал: колонка - либо список ссылок, либо название направления
     | (тогда сайт сам подставит его программы). Пустую колонку не
     | показываем: заголовок без ссылок выглядит как ошибка.
     */
    private static function columns(array $value): array
    {
        $columns = [];

        foreach ($value as $title => $links) {
            if (trim((string) $title) === '') {
                continue;
            }

            if (is_string($links)) {
                $columns[$title] = $links;
                continue;
            }

            if (is_array($links) && ($clean = self::links($links)) !== []) {
                $columns[$title] = $clean;
            }
        }

        return $columns;
    }

    /** Ссылки без названия или с нерабочим адресом выбрасываем. */
    private static function links(array $items): array
    {
        return collect($items)
            ->filter(fn ($item) => is_array($item)
                && trim((string) ($item['title'] ?? '')) !== ''
                && preg_match('~^(/|https?://)~', trim((string) ($item['href'] ?? ''))) === 1)
            ->map(fn (array $item) => ['title' => $item['title'], 'href' => $item['href']])
            ->values()
            ->all();
    }
    private static function menu(array $items): array
    {
        $own = collect(config('nav.main'))->keyBy('href');

        return collect($items)
            ->filter(fn ($item) => is_array($item) && trim((string) ($item['title'] ?? '')) !== ''
                /* Адрес должен быть адресом: «Курсы» без косой черты ведёт в никуда. */
                && preg_match('~^(/|https?://)~', trim((string) ($item['href'] ?? ''))) === 1)
            ->map(function (array $item) use ($own) {
                $file = $own->get($item['href'], []);

                return array_merge(
                    array_intersect_key($file, array_flip(['school', 'accent', 'services'])),
                    ['title' => $item['title'], 'href' => $item['href']],
                );
            })
            ->values()
            ->all();
    }

    /**
     * Встречи из CRM. Там их заводит школа: дата, места, раздел, текст
     * страницы. Пустой ответ встречи из файла не стирает — иначе при
     * недоступной CRM расписание на сайте пропало бы совсем.
     */
    private function applyEvents(): void
    {
        if (!config('crm.events')) {
            return;
        }

        $events = $this->crm->cached('events')['events'] ?? [];

        if (!$events) {
            return;
        }

        $months = [];

        foreach ($events as $event) {
            if (empty($event['starts']) || empty($event['slug'])) {
                continue;
            }

            $at = \Illuminate\Support\Carbon::parse($event['starts'])->locale('ru');

            /* Ключ вкладки — месяц с большой буквы: «Октябрь». */
            $month = mb_convert_case($at->translatedFormat('F'), MB_CASE_TITLE, 'UTF-8');

            $months[$month][] = [
                'slug'        => $event['slug'] ?? null,
                'date'        => $at->format('Y-m-d'),
                'day'         => $at->format('d'),
                'month'       => $at->translatedFormat('M'),
                'weekday'     => $at->translatedFormat('l'),
                'time'        => $at->format('H:i'),
                'title'       => $event['title'],
                'section'     => $event['section'] ?? null,
                'photo'       => $event['image'] ?: null,
                'seats_total' => $event['seatsTotal'] ?? null,
                'seats_left'  => $event['seats'] ?? null,
                'price'       => (int) ($event['price'] ?? 0),
                'duration'    => $event['duration'] ? $event['duration'] . ' мин' : null,
                'place'       => $event['location'] ?? null,
                'host'        => $event['trainer'] ?? null,
                'text'        => $event['summary'] ?? '',
                /* Абзацы страницы: в CRM это одно поле, пустая строка — новый абзац. */
                'about'       => array_values(array_filter(array_map(
                    'trim',
                    preg_split('/\R{2,}/', (string) ($event['about'] ?? '')),
                ))),
                'for_whom'    => $event['forWhom'] ?? null,
            ];
        }

        if ($months) {
            config(['home.events.months' => $months, 'home.events.demo' => false]);
        }
    }

    private function applyCourses(): void
    {
        $data = $this->crm->cached('courses', ['full' => 1]);

        if (empty($data['schools'])) {
            return;
        }

        $local = config('courses.schools', []);
        $pages = config('course-pages', []);
        $seo = config('site.pages', []);

        /* Снятые с сайта программы: в CRM они ещё есть, но показывать их не нужно. */
        $retired = config('site.retired', []);

        $fromCrm = [];

        foreach ($data['schools'] as $school => $courses) {
            foreach ($courses as $course) {
                $url = $course['url'];

                if (in_array($url, $retired, true)) {
                    continue;
                }

                $fromCrm[$school][$url] = $this->card($course);

                if (!$course['has_page']) {
                    continue;
                }

                /*
                 | Тексты курсов школа правит в CRM, поэтому заполненное там
                 | главнее. Файл остаётся запасным: поля, которые в CRM пусты
                 | (а это почти все тексты из методичек, пока их не перенесли),
                 | берутся из него, и страница не пустеет.
                 */
                $pages[$url] = array_filter([
                    'title'   => $course['title'],
                    'lead'    => $course['lead'],
                    'facts'   => $this->facts($course['facts'] ?: ($pages[$url]['facts'] ?? []), (int) $course['price']),
                    'program' => $course['program'],
                    'days'    => $course['days'],
                    'learn'   => $course['learn'],
                    'gallery' => $course['gallery'],
                ]) + ($pages[$url] ?? []) + ['groups' => $course['groups'] ?? []];

                $pages[$url]['groups'] = $course['groups'] ?? [];

                $seo[$url] = $this->seo($seo[$url] ?? null, $seo[self::PAGE_TEMPLATE] ?? [], $url, $course);
            }
        }

        /* Порядок карточек берём из файлов: там он выверен под витрину.
           Курс, которого в файлах ещё нет, добавляем следом. */
        $schools = [];

        foreach ($local as $school => $cards) {
            foreach ($cards as $card) {
                $url = $card['url'] ?? null;
                if (in_array($url, $retired, true)) {
                    continue;
                }

                /* Значения из CRM главнее, но поля, которых в CRM нет
                   (короткое имя, отметка 18+), берём из файла. */
                $schools[$school][] = ($fromCrm[$school][$url] ?? []) + $card;
                unset($fromCrm[$school][$url]);
            }
        }

        foreach ($fromCrm as $school => $cards) {
            foreach ($cards as $card) {
                $schools[$school][] = $card;
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
            'duration' => self::duration($course['duration']),
            'format'   => $course['format'],
            'schedule' => self::schedule($course['schedule']),
            'badge'    => $course['badge'],
            'photo'    => $course['photo'],
        ], fn ($value) => $value !== null);
    }

    /*
     | «Расписание: индивидуальное обучение» — формулировка со старого сайта.
     | Занятия ставим под гостя, поэтому и в карточке, и в характеристиках
     | пишем «удобное вам время». В CRM текст пока прежний, правим здесь.
     */
    private static function schedule(?string $value): ?string
    {
        return preg_match('/расписан|индивидуальн/ui', (string) $value)
            ? 'Удобное вам время'
            : $value;
    }

    /*
     | «1 день · 4 часа» — у однодневных программ день только мешает:
     | рядом стоят «3 часа» и «4 часа», и строка выбивается. Дни оставляем
     | там, где их правда несколько.
     */
    private static function duration(?string $value): ?string
    {
        return preg_replace('/^\s*1\s*день\s*(·\s*)?/ui', '', (string) $value) ?: $value;
    }

    /** Переименовать характеристику, сохранив её место в списке. */
    private static function rename(array $facts, string $from, string $to): array
    {
        $out = [];

        foreach ($facts as $key => $value) {
            $out[$key === $from ? $to : $key] = $value;
        }

        return $out;
    }

    /**
     * В характеристиках цена записана текстом — строку «за одного» берём
     * из CRM, чтобы не расходилась. Цены за двоих и больше остаются как есть.
     */
    private function facts(array $facts, int $price): array
    {
        foreach (['длительность', 'продолжительность'] as $key) {
            if (isset($facts[$key])) {
                $facts[$key] = self::duration((string) $facts[$key]);
            }
        }

        if (isset($facts['расписание'])) {
            $facts = self::rename($facts, 'расписание', 'время занятий');
            $facts['время занятий'] = self::schedule((string) $facts['время занятий']);
        }

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
