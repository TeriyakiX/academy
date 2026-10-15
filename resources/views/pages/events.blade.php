@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    @php
        /* Варианты страницы на время выбора: ?v=a — афиша, ?v=b — строками,
           без параметра — плитки с фильтрами. Когда вариант выберут,
           здесь останется один. */
        $variant = in_array(request('v'), ['a', 'e', 'f', 'g', 'h', 'j'], true) ? request('v') : 'c';

        $all   = \App\Support\Meetings::all();
        $today = now()->format('Y-m-d');
        $ahead = $all->filter(fn ($e) => ($e['date'] ?? '') >= $today)->sortBy('date');
        $next  = $ahead->first();
    @endphp

    <main class="ab-page ab-page--events">
        <section class="ab-evlist__head">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a>
                    <span>/</span>
                    <b>Встречи</b>
                </nav>

                <div class="ab-evlist__top">
                    <div>
                        <h1 class="ab-evlist__title">Встречи в Академии</h1>
                        <p class="ab-evlist__lead">
                            Мастер-классы, каппинги и открытые дни. Прийти можно без записи
                            на курс — на один вечер, попробовать и познакомиться со школой.
                        </p>
                    </div>

                    @if ($next)
                        <a class="ab-evlist__next" href="/events/{{ $next['slug'] }}.html">
                            <span class="ab-evlist__next-label">Ближайшая</span>
                            <b>{{ $next['title'] }}</b>
                            <span class="ab-evlist__next-date">
                                {{ $next['day'] }} {{ $next['month'] }}, {{ $next['weekday'] }}, {{ $next['time'] }}
                            </span>
                            @if ($ahead->count() > 1)
                                <span class="ab-evlist__next-more">и ещё {{ $ahead->count() - 1 }} впереди</span>
                            @endif
                        </a>
                    @endif
                </div>
            </div>
        </section>

        {{-- Временная панель выбора: на боевой сервер не уходит. --}}
        @if (app()->environment('local') || request()->has('v'))
            <div class="ab-container">
                <div class="ab-vswitch">
                    <span>Вариант страницы:</span>
                    <a class="@if ($variant === 'c') is-active @endif" href="/events.html">1. Плитки с фильтрами</a>
                    <a class="@if ($variant === 'a') is-active @endif" href="/events.html?v=a">2. Афиша по месяцам</a>
                    <a class="@if ($variant === 'e') is-active @endif" href="/events.html?v=e">3. Ближайшая крупно</a>
                    <a class="@if ($variant === 'f') is-active @endif" href="/events.html?v=f">4. Лента времени</a>
                    <a class="@if ($variant === 'g') is-active @endif" href="/events.html?v=g">5. Афиши-постеры</a>
                    <a class="@if ($variant === 'j') is-active @endif" href="/events.html?v=j">6. Обложки по две</a>
                    <a class="@if ($variant === 'h') is-active @endif" href="/events.html?v=h">7. Список и просмотр</a>
                </div>
            </div>
        @endif

        <section class="ab-events">
            <div class="ab-container">
                @if ($variant === 'a')
                    @include('partials.blocks.events-poster')
                @elseif ($variant === 'e')
                    @include('partials.blocks.events-hero')
                @elseif ($variant === 'f')
                    @include('partials.blocks.events-timeline')
                @elseif ($variant === 'g')
                    @include('partials.blocks.events-posters')
                @elseif ($variant === 'h')
                    @include('partials.blocks.events-split')
                @elseif ($variant === 'j')
                    @include('partials.blocks.events-covers')
                @else
                    <div data-island="EventsSchedule"
                         data-props="{{ json_encode(['months' => \App\Support\Meetings::months()], JSON_UNESCAPED_UNICODE) }}"></div>
                @endif
            </div>
        </section>

        @include('partials.blocks.lead')
        @include('partials.blocks.contacts')
    </main>

    @include('partials.site.footer')
</div>
@endsection
