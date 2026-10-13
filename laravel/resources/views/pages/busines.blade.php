@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--business">
        <section class="ab-cpage__hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a><span>/</span><b>Для бизнеса</b>
                </nav>

                <div class="ab-bus__intro">
                    <div>
                        <span class="ab-cpage__tag">Услуги для бизнеса</span>
                        <h1 class="ab-cpage__title">Услуги для Бизнеса</h1>
                        <p class="ab-cpage__lead">
                            Наши услуги подойдут, если вы стоите на пороге открытия первой кофейни
                            или хотите навести порядок в уже работающем заведении. Помогаем на всех
                            этапах: от оборудования и меню до обучения персонала.
                        </p>
                        <div class="ab-hero__actions">
                            <button class="ab-btn ab-btn--primary ab-btn--lg" type="button"
                                    data-modal-path="consultation">Обсудить проект</button>
                            <a class="ab-btn ab-btn--outline ab-btn--lg" href="{{ config('nav.contacts.phone_href') }}">
                                {{ config('nav.contacts.phone') }}
                            </a>
                        </div>
                    </div>

                    <ul class="ab-bus__stats">
                        <li><b>50+</b><span>кофеен помогли открыть</span></li>
                        <li><b>{{ (int) date("Y") - 2019 }} лет</b><span>в кофейном бизнесе</span></li>
                        <li><b>8</b><span>услуг для бизнеса</span></li>
                    </ul>
                </div>
            </div>
        </section>

        {{-- Навигатор по этапам.

             Девять услуг одним списком человек читает подряд и всё равно
             не понимает, какая его. Здесь он узнаёт себя по вопросу и сразу
             попадает на нужную страницу. --}}
        <section class="ab-busnav ab-reveal">
            <div class="ab-container">
                <h2 class="ab-h2">С чего начать</h2>
                <p class="ab-lead">Четыре шага одного пути — от «ещё думаю» до «кофейня работает».</p>

                <ol class="ab-busnav__list">
                    @foreach ([
                        ['step' => 'Этап 0', 'q' => 'Не знаете, с чего начать?',
                         'a' => 'Как открыть кофейню', 'href' => '/busines/kak-otkryt-kofejnyu.html'],
                        ['step' => 'Этап 1', 'q' => 'Готовы делать сами, но нужна поддержка?',
                         'a' => 'Кофейня с нуля', 'href' => '/busines/kofejnya-s-nulya.html'],
                        ['step' => 'Этап 2', 'q' => 'Хотите передать запуск целиком?',
                         'a' => 'Кофейня под ключ', 'href' => '/busines/kofejnya-pod-klyuch.html'],
                        ['step' => 'Этап 3', 'q' => 'Кофейня открыта, но управление хромает?',
                         'a' => 'Менеджмент кофейни', 'href' => '/busines/menedzhment-kofejni.html'],
                    ] as $row)
                        <li>
                            <a href="{{ $row['href'] }}">
                                <span class="ab-busnav__step">{{ $row['step'] }}</span>
                                <b class="ab-busnav__q">{{ $row['q'] }}</b>
                                <span class="ab-busnav__a">
                                    {{ $row['a'] }}
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor"
                                              stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ol>

                <p class="ab-busnav__note">
                    Барную зону и меню можно заказать отдельно или добавить к любому пакету запуска.
                </p>
            </div>
        </section>

        <section class="ab-bus ab-reveal">
            <div class="ab-container">
                <h2 class="ab-h2">Что мы делаем</h2>
                <p class="ab-lead">Выберите услугу — на её странице расписано, что входит в работу и сколько это стоит.</p>

                <div class="ab-bus__grid">
                    @each('partials.blocks.service-card', config('business.items'), 'service')
                </div>
            </div>
        </section>

        @include('partials.blocks.stats')
        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
