@extends('layouts.app')

@push('head')
    @vite(['resources/css/home-blocks.css', 'resources/css/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--events">
        <section class="ab-cpage__hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a>
                    <span>/</span>
                    <b>Мероприятия</b>
                </nav>

                <h1 class="ab-cpage__title">Расписание мероприятий</h1>
                <p class="ab-cpage__lead">
                    Однодневные мастер-классы и открытые встречи Академии. Прийти можно
                    без записи на курс — попробовать профессию и познакомиться со школой.
                </p>
            </div>
        </section>

        <section class="ab-events">
            <div class="ab-container">
                <div data-island="EventsSchedule"
                     data-props="{{ json_encode(['months' => config('home.events.months')], JSON_UNESCAPED_UNICODE) }}"></div>
            </div>
        </section>

        @include('partials.blocks.lead')
        @include('partials.blocks.contacts')
    </main>

    @include('partials.site.footer')
</div>
@endsection
