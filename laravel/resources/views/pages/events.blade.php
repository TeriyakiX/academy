@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/course.css'])
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

                @php
                    /* Цифры считаем по тем же встречам, что показаны ниже. */
                    $events = collect(config('home.events.months', []))->flatMap(fn ($list) => $list);
                    $from = $events->filter(fn ($e) => !empty($e['price']))->min('price');
                    $n = $events->count();
                    $word = ($n % 10 === 1 && $n % 100 !== 11) ? 'встреча'
                        : (($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20)) ? 'встречи' : 'встреч');
                @endphp

                {{-- Шапка со снимком и цифрами: раньше здесь была голая строка
                     заголовка, и страница начиналась пустой полосой. --}}
                <div class="ab-cpage__split">
                    <div>
                        <span class="ab-cpage__tag">Мероприятия</span>
                        <h1 class="ab-cpage__title">Расписание мероприятий</h1>
                        <p class="ab-cpage__lead">
                            Однодневные мастер-классы и открытые встречи Академии. Прийти можно
                            без записи на курс — попробовать профессию и познакомиться со школой.
                        </p>

                        <ul class="ab-cpage__nums">
                            <li><b>{{ $n }}</b><span>{{ $word }} в афише</span></li>
                            @if ($from)
                                <li><b>от {{ number_format($from, 0, ',', ' ') }} ₽</b><span>участие</span></li>
                            @endif
                            <li><b>один день</b><span>без записи на курс</span></li>
                            <li><b>до 10</b><span>человек в группе</span></li>
                        </ul>
                    </div>

                    <div class="ab-cpage__media">
                        <img src="/assets/master-class.webp" alt="Открытая встреча в Академии Бариста"
                             width="573" height="470" loading="eager" decoding="async">
                    </div>
                </div>
            </div>
        </section>

        <section class="ab-events">
            <div class="ab-container">
                <div data-island="EventsSchedule"
                     data-props="{{ json_encode(['months' => config('home.events.months')], JSON_UNESCAPED_UNICODE) }}"></div>
            </div>
        </section>

        {{-- Под расписанием страница обрывалась на последней строке списка:
             объясняем, что это за формат и чем он отличается от курса. --}}
        <section class="ab-evwhat ab-reveal">
            <div class="ab-container">
                <h2 class="ab-h2">Что это за встречи</h2>

                <div class="ab-evwhat__grid">
                    <article>
                        <b>Один вечер, без обязательств</b>
                        <p>
                            Встреча идёт три-четыре часа в выходной. Это не курс: записываться
                            на программу и готовиться заранее не нужно.
                        </p>
                    </article>

                    <article>
                        <b>Можно прийти одному</b>
                        <p>
                            Группа небольшая, до десяти человек. Приходят и поодиночке,
                            и парами, и компанией — заранее собирать своих не нужно.
                        </p>
                    </article>

                    <article>
                        <b>Всё за стойкой, руками</b>
                        <p>
                            Работаем на профессиональном оборудовании школы. Зерно, молоко
                            и посуда — наши, приносить ничего не надо.
                        </p>
                    </article>

                    <article>
                        <b>Место бронируется заранее</b>
                        <p>
                            Мест немного, поэтому участие подтверждаем при записи.
                            Если даты в афише не подходят — позвоните, подскажем ближайшие.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        @include('partials.blocks.lead')
        @include('partials.blocks.contacts')
    </main>

    @include('partials.site.footer')
</div>
@endsection
