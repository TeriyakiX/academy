<?php
/*
 | Перестраивает юридические страницы: вокруг текста документа — читаемая обёртка.
 | Сам текст берётся из уже перенесённых шаблонов и не меняется:
 | это юридические документы, править их формулировки нельзя.
 */

$views = __DIR__ . '/../laravel/resources/views/pages';

$pages = [
    'oferta'          => 'Договор-оферта',
    'privacy-policy'  => 'Политика конфиденциальности',
    'user-agreement'  => 'Пользовательское соглашение',
];

foreach ($pages as $name => $title) {
    $file = "$views/$name.blade.php";
    if (!is_file($file)) { echo "MISS $name\n"; continue; }

    $src = file_get_contents($file);

    // тело страницы между @section('content') и @endsection
    if (!preg_match("/@section\('content'\)(.*)@endsection/s", $src, $m)) {
        echo "SKIP $name: не найден блок content\n";
        continue;
    }
    $body = $m[1];

    // выкидываем прежние include шапки/подвала — обёртка добавит свои
    $body = preg_replace("/@include\('partials\.site\.(header|footer)'\)/", '', $body);
    // и внешний .wrapper, если он есть
    $body = trim($body);
    $body = preg_replace('/^<div class="wrapper">/', '', $body);
    $body = preg_replace('/<\/div>$/', '', $body);

    // сам текст документа: убираем старые обёртки-контейнеры, оставляя контент
    $text = trim($body);

    $tpl = <<<BLADE
@extends('layouts.app')

@push('head')
    @vite('resources/css/legal.css')
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-legal">
        <div class="ab-legal__container">
            <nav class="ab-crumbs" aria-label="Хлебные крошки">
                <a href="/">Главная</a>
                <span>/</span>
                <b>{$title}</b>
            </nav>

            <div class="ab-legal__body">
{$text}
            </div>

            <div class="ab-legal__docs">
                <p class="ab-legal__docs-title">Документы для скачивания</p>
                <a href="/docs/%D0%9F%D1%83%D0%B1%D0%BB%D0%B8%D1%87%D0%BD%D0%B0%D1%8F_%D0%BE%D1%84%D0%B5%D1%80%D1%82%D0%B0_%D0%90%D0%BA%D0%B0%D0%B4%D0%B5%D0%BC%D0%B8%D0%B8_%D0%B1%D0%B0%D1%80%D0%B8%D1%81%D1%82%D0%B0.pdf" target="_blank" rel="noopener">Публичная оферта, PDF</a>
                <a href="/docs/%D0%9F%D0%BE%D0%BB%D0%B8%D1%82%D0%B8%D0%BA%D0%B0_%D0%BA%D0%BE%D0%BD%D1%84%D0%B8%D0%B4%D0%B5%D0%BD%D1%86%D0%B8%D0%B0%D0%BB%D1%8C%D0%BD%D0%BE%D1%81%D1%82%D0%B8_%D0%90%D0%BA%D0%B0%D0%B4%D0%B5%D0%BC%D0%B8%D0%B8_%D0%B1%D0%B0%D1%80%D0%B8%D1%81%D1%82%D0%B0.pdf" target="_blank" rel="noopener">Политика конфиденциальности, PDF</a>
                <a href="/docs/%D0%A1%D0%BE%D0%B3%D0%BB%D0%B0%D1%81%D0%B8%D0%B5_%D0%BE%D0%B1%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%BA%D0%B8_%D0%9F%D0%94_%D0%90%D0%BA%D0%B0%D0%B4%D0%B5%D0%BC%D0%B8%D0%B8_%D0%B1%D0%B0%D1%80%D0%B8%D1%81%D1%82%D0%B0.pdf" target="_blank" rel="noopener">Согласие на обработку данных, PDF</a>
            </div>
        </div>
    </main>

    @include('partials.site.footer')
</div>
@endsection

BLADE;

    file_put_contents($file, $tpl);
    printf("%-18s обновлена (%d байт текста)\n", $name, strlen($text));
}
