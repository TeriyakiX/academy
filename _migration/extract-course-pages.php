<?php
/*
 | Разбирает 13 однотипных страниц курсов и складывает их содержимое в config/course-pages.php.
 | Структура у всех одна: hero, course-composition, learn, team, gallery, want-course.
 */

$root = realpath(__DIR__ . '/..');

$pages = [
    '/courses/barista-base.html',
    '/courses/barista-advanced.html',
    '/courses/barista-technician.html',
    '/courses/barista-professional.html',
    '/courses/upravlyayushchiy-kofeyni.html',
    '/master-class/latte-art.html',
    '/master-class/young-barista.html',
    '/master-class/domashnyaya-kofeynya.html',
    '/master-class/barista-v-take-away.html',
    '/master-class/domashniy-barista.html',
    '/barnoe-delo/metod-ctir.html',
    '/barnoe-delo/koktel-metodom-bild.html',
    '/barnoe-delo/vstryakhni-i-poday.html',
];

function txt(?DOMNode $n): ?string
{
    return $n ? trim(preg_replace('/\s+/u', ' ', $n->textContent)) : null;
}

$out = [];

foreach ($pages as $url) {
    $file = $root . str_replace('/', DIRECTORY_SEPARATOR, $url);
    if (!is_file($file)) { echo "MISS $url\n"; continue; }

    $d = new DOMDocument();
    libxml_use_internal_errors(true);
    $d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($file));
    libxml_clear_errors();
    $x = new DOMXPath($d);

    $sec = fn(string $cls) => $x->query("//section[contains(@class,'{$cls}')]")->item(0);

    // ---- hero: заголовок, описание, характеристики ----
    $hero = $sec('hero');
    $title = txt($x->query('//h1')->item(0));
    $lead  = $hero ? txt($x->query(".//*[contains(@class,'hero__description')]", $hero)->item(0)) : null;

    $facts = [];
    if ($hero) {
        foreach ($x->query(".//*[contains(@class,'hero__list-item')]", $hero) as $li) {
            $label = txt($x->query(".//*[contains(@class,'hero__list-item-label')]", $li)->item(0));
            $value = txt($x->query(".//*[contains(@class,'hero__list-item-text')]", $li)->item(0));
            if ($label && $value) $facts[rtrim($label, ':')] = $value;
        }
    }

    // ---- состав курса: карточки «Теория» и «Практика» со списком тем ----
    $program = [];
    if ($cc = $sec('course-composition')) {
        foreach ($x->query(".//div[contains(@class,'course-composition__card') and not(contains(@class,'card-icon')) and not(contains(@class,'card-more'))]", $cc) as $card) {
            $t = txt($x->query(".//*[contains(@class,'course-composition__card-title')]", $card)->item(0));
            if (!$t) continue;

            $topics = [];
            foreach ($x->query(".//li[contains(@class,'course-composition__card-item')]", $card) as $li) {
                $v = txt($li);
                if ($v) $topics[] = rtrim($v, ';.');
            }
            $program[] = ['title' => $t, 'topics' => array_values(array_unique($topics))];
        }
    }

    // ---- чему научитесь ----
    $learn = [];
    if ($ln = $sec('learn')) {
        foreach ($x->query(".//li[contains(@class,'learn__item')]", $ln) as $li) {
            $t = txt($li);
            if ($t && mb_strlen($t) > 4) $learn[] = rtrim($t, ';.');
        }
        $learn = array_values(array_unique($learn));
    }

    // ---- галерея ----
    $gallery = [];
    if ($g = $sec('gallery')) {
        foreach ($x->query(".//li[contains(@class,'gallery__slider-slide')]//img | .//img", $g) as $img) {
            foreach (['src', 'data-src', 'data-splide-lazy'] as $attr) {
                $src = $img->getAttribute($attr);
                if ($src && !str_starts_with($src, 'data:')) { $gallery[] = $src; break; }
            }
        }
        foreach ($x->query('.//source', $g) as $s) {
            $ss = $s->getAttribute('srcset');
            if ($ss && !str_starts_with($ss, 'data:')) $gallery[] = explode(' ', trim($ss))[0];
        }
        $gallery = array_values(array_unique($gallery));
    }

    $out[$url] = [
        'title'   => $title,
        'lead'    => $lead,
        'facts'   => $facts,
        'program' => $program,
        'learn'   => array_slice($learn, 0, 12),
        'gallery' => array_slice($gallery, 0, 12),
    ];

    printf("%-42s факты:%-2d программа:%-2d учитесь:%-2d фото:%d\n",
        $url, count($facts), count($program), count($learn), count($gallery));
}

file_put_contents(
    $root . '/laravel/config/course-pages.php',
    "<?php\n\n/*\n | Содержимое страниц курсов, извлечённое из прежней вёрстки.\n"
    . " | Пересобирается скриптом _migration/extract-course-pages.php\n */\n\nreturn "
    . var_export($out, true) . ";\n"
);

echo "\nстраниц: " . count($out) . " -> laravel/config/course-pages.php\n";
