@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    @php
        $today = now()->format('Y-m-d');
        $ahead = \App\Support\Meetings::all()
            ->filter(fn ($e) => $e['date'] >= $today)
            ->sortBy('date');
        $next = $ahead->first();
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

        <section class="ab-events">
            <div class="ab-container">
                @include('partials.blocks.events-posters')
            </div>
        </section>

        @include('partials.blocks.lead')
        @include('partials.blocks.contacts')
    </main>

    @include('partials.site.footer')
</div>
@endsection