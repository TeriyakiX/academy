@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/blog.css'])
@endpush

@section('content')
@php
    /*
     | Список статей. Статьи — из config/blog.php, а когда сайт подключён
     | к CRM — оттуда. Фильтр по рубрике работает без скриптов: ссылкой
     | ?category=, чтобы каждая рубрика открывалась и по прямой ссылке.
     */
    $all = collect(config('blog.articles', []));
    $categories = $all->pluck('category')->filter()->unique()->values();
    $current = request()->query('category');
    $current = $categories->contains($current) ? $current : null;
    $articles = $current ? $all->where('category', $current)->values() : $all;
@endphp

<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--blog">
        <section class="ab-blog-head">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a><span>/</span><b>Блог</b>
                </nav>

                <h1 class="ab-cpage__title">Блог Академии Бариста</h1>
                <p class="ab-cpage__lead">
                    Статьи о кофе, профессии бариста и кофейном бизнесе — от преподавателей школы.
                </p>

                @if ($categories->count() > 1)
                    <nav class="ab-blog-cats" aria-label="Рубрики">
                        <a href="/blog.html" @class(['is-active' => !$current])>Все статьи</a>
                        @foreach ($categories as $category)
                            <a href="/blog.html?category={{ urlencode($category) }}"
                               @class(['is-active' => $current === $category])>{{ $category }}</a>
                        @endforeach
                    </nav>
                @endif
            </div>
        </section>

        <section class="ab-blog-list">
            <div class="ab-container">
                @if ($articles->isEmpty())
                    <p class="ab-blog-empty">Статей пока нет.</p>
                @else
                    <div class="ab-blog-grid">
                        @foreach ($articles as $article)
                            @include('partials.blocks.article-card', ['article' => $article])
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
