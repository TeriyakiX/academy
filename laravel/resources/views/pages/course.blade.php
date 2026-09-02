@extends('layouts.app')

@push('head')
    @vite(['resources/css/constructor.css', 'resources/css/home-blocks.css', 'resources/css/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--course">
        {{-- ---------- Шапка курса ---------- --}}
        <section class="ab-cpage__hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a>
                    <span>/</span>
                    <a href="/courses.html">Курсы</a>
                    <span>/</span>
                    <b>{{ $course['title'] }}</b>
                </nav>

                <div class="ab-cpage__grid">
                    <div class="ab-cpage__main">
                        <span class="ab-cpage__tag">{{ $course['school'] }}</span>
                        <h1 class="ab-cpage__title">{{ $course['title'] }}</h1>

                        @if ($course['lead'])
                            <p class="ab-cpage__lead">{{ $course['lead'] }}</p>
                        @endif

                        <ul class="ab-cpage__facts">
                            @foreach ($course['facts'] as $label => $value)
                                <li>
                                    <span>{{ $label }}</span>
                                    <b>{{ $value }}</b>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Карточка записи --}}
                    <aside class="ab-cpage__buy">
                        <div class="ab-cpage__price">
                            @if (!empty($course['old_price']))
                                <s>{{ number_format($course['old_price'], 0, ',', ' ') }} ₽</s>
                            @endif
                            @if (!empty($course['price']))
                                <strong>{{ number_format($course['price'], 0, ',', ' ') }} ₽</strong>
                            @endif
                        </div>

                        <ul class="ab-cpage__buy-list">
                            <li>Обучение по образовательной лицензии</li>
                            <li>Практика на профессиональном оборудовании</li>
                            <li>Документ об обучении</li>
                        </ul>

                        <button class="ab-btn ab-btn--primary ab-btn--block ab-btn--lg"
                                type="button" data-modal-path="consultation">Записаться на курс</button>

                        <a class="ab-cpage__buy-phone" href="{{ config('nav.contacts.phone_href') }}">
                            {{ config('nav.contacts.phone') }}
                            <span>{{ config('nav.contacts.hours') }}</span>
                        </a>
                    </aside>
                </div>
            </div>
        </section>

        {{-- ---------- Программа курса ---------- --}}
        @if (count($course['program']))
            <section class="ab-cprog ab-reveal">
                <div class="ab-container">
                    <h2 class="ab-h2">Программа курса</h2>
                    <p class="ab-lead">Что именно разбираем на занятиях — по блокам.</p>

                    <div data-island="CourseProgram"
                         data-props="{{ json_encode(['blocks' => $course['program']], JSON_UNESCAPED_UNICODE) }}"></div>
                </div>
            </section>
        @endif

        {{-- ---------- Чему научитесь ---------- --}}
        @if (count($course['learn']))
            <section class="ab-clearn ab-reveal">
                <div class="ab-container">
                    <h2 class="ab-h2">Чему вы научитесь</h2>
                    <ul class="ab-clearn__list">
                        @foreach ($course['learn'] as $item)
                            <li>
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="m5 12 5 5L19 8" fill="none" stroke="currentColor"
                                          stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif

        {{-- ---------- Преподаватели ---------- --}}
        @include('partials.blocks.teachers')

        {{-- ---------- Другие программы ---------- --}}
        <section class="ab-programs ab-reveal">
            <div class="ab-container">
                <h2 class="ab-h2">Другие программы</h2>
                <p class="ab-lead">Можно пройти по отдельности или собрать свой набор со скидкой.</p>
                <div data-island="CourseTabs"
                     data-props="{{ json_encode(['schools' => config('courses.schools')], JSON_UNESCAPED_UNICODE) }}"></div>
            </div>
        </section>

        {{-- ---------- Заявка ---------- --}}
        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
