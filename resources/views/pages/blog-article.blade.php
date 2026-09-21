@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/blog.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    {{--
        Страница статьи. Текст приходит готовой разметкой (из CRM или из
        config/blog.php): заголовки, абзацы, списки и ссылки. Разметка
        чистится при сохранении, поэтому выводится как есть.
    --}}
    <main class="ab-page ab-page--blog">
        <article class="ab-article">
            <div class="ab-container ab-article__container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a><span>/</span>
                    <a href="/blog.html">Блог</a><span>/</span>
                    <b>{{ \Illuminate\Support\Str::limit($article['title'], 40) }}</b>
                </nav>

                <p class="ab-blog-card__meta">
                    <a href="/blog.html?category={{ urlencode($article['category']) }}">{{ $article['category'] }}</a>
                    <time datetime="{{ $article['date'] }}">
                        {{ \Illuminate\Support\Carbon::parse($article['date'])->locale('ru')->translatedFormat('j F Y') }}
                    </time>
                </p>

                <h1 class="ab-article__title">{{ $article['title'] }}</h1>

                @if (!empty($article['image']))
                    <img class="ab-article__cover" src="{{ $article['image'] }}" alt="{{ $article['title'] }}"
                         width="1200" height="680" loading="eager" decoding="async">
                @endif

                <div class="ab-article__text">
                    {!! $article['content'] !!}
                </div>

                @if (!empty($article['tags']))
                    <ul class="ab-article__tags">
                        @foreach ($article['tags'] as $tag)
                            <li>{{ $tag }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </article>

        @if (!empty($others))
            <section class="ab-blog-list ab-blog-list--more">
                <div class="ab-container">
                    <h2 class="ab-h2">Читайте также</h2>

                    <div class="ab-blog-grid">
                        @foreach ($others as $other)
                            @include('partials.blocks.article-card', ['article' => $other])
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
