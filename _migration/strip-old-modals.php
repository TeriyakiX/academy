<?php
/*
 | Удаляет старые модальные окна из шаблонов страниц.
 | После перехода на единую модалку (partials/site/modal) они дублируют
 | data-modal-target и перехватывают клик, а отправка у них была завязана
 | на удалённый фронтенд-скрипт — то есть форма не работала.
 */

$dir = __DIR__ . '/../laravel/resources/views/pages';

/** Вырезает элемент <div ...data-modal-target...> ... </div> с учётом вложенности. */
function cutModal(string $html): array
{
    $count = 0;

    while (($pos = strpos($html, 'data-modal-target')) !== false) {
        // начало открывающего тега
        $start = strrpos(substr($html, 0, $pos), '<');
        if ($start === false) break;

        $open = strpos($html, '>', $pos);
        if ($open === false) break;

        $depth = 1;
        $i = $open + 1;
        $len = strlen($html);

        while ($i < $len && $depth > 0) {
            $nextOpen  = strpos($html, '<div', $i);
            $nextClose = strpos($html, '</div>', $i);
            if ($nextClose === false) break;

            if ($nextOpen !== false && $nextOpen < $nextClose) {
                $depth++;
                $i = $nextOpen + 4;
            } else {
                $depth--;
                $i = $nextClose + 6;
            }
        }

        $html = substr($html, 0, $start) . substr($html, $i);
        $count++;
    }

    return [$html, $count];
}

$total = 0;
foreach (['index', 'glavnaya'] as $name) {
    $file = "$dir/$name.blade.php";
    if (!is_file($file)) continue;

    $src = file_get_contents($file);
    [$out, $n] = cutModal($src);

    if ($n === 0) { echo "$name: модалок нет\n"; continue; }

    file_put_contents($file, $out);
    $total += $n;
    printf("%-12s удалено модалок: %d, -%d байт\n", $name, $n, strlen($src) - strlen($out));
}

echo "\nвсего: $total\n";
