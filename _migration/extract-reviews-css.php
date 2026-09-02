<?php
$css = file_get_contents(__DIR__ . '/../laravel/public/assets/sertifikat.css');

// разбираем на правила верхнего уровня, включая @media
$out = [];
$len = strlen($css);
$i = 0;
while ($i < $len) {
    // @media / @supports — блок с вложенностью
    if ($css[$i] === '@') {
        $start = $i;
        $j = strpos($css, '{', $i);
        if ($j === false) break;
        $depth = 1; $k = $j + 1;
        while ($k < $len && $depth > 0) {
            if ($css[$k] === '{') $depth++;
            elseif ($css[$k] === '}') $depth--;
            $k++;
        }
        $block = substr($css, $start, $k - $start);
        if (str_contains($block, '.reviews')) {
            // внутри @media оставляем только правила про reviews
            $head = substr($block, 0, strpos($block, '{') + 1);
            $body = substr($block, strpos($block, '{') + 1, -1);
            $kept = '';
            foreach (preg_split('/(?<=\})/', $body) as $rule) {
                if (str_contains($rule, '.reviews')) $kept .= $rule;
            }
            if (trim($kept)) $out[] = $head . $kept . '}';
        }
        $i = $k;
        continue;
    }
    $j = strpos($css, '}', $i);
    if ($j === false) break;
    $rule = substr($css, $i, $j - $i + 1);
    if (str_contains(explode('{', $rule)[0], '.reviews')) $out[] = $rule;
    $i = $j + 1;
}
$res = "/* Стили блока отзывов. Извлечены из sertifikat.css —\n"
     . "   подключать целиком чужой файл нельзя: он переопределяет .header/.footer/.container. */\n"
     . implode("\n", $out) . "\n";
file_put_contents(__DIR__ . '/../laravel/resources/css/reviews.css', $res);
echo "правил: " . count($out) . " | " . strlen($res) . " байт\n";
