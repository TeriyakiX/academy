@extends('layouts.app')

@push('head')
    @vite([
        'resources/src/app/assets/styles/home-blocks.css',
        'resources/src/app/assets/styles/course.css',
    ])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    @php
        $total  = $event['seats_total'];
        $left   = $event['seats_left'];
        $taken  = $total !== null && $left !== null ? max(0, $total - $left) : null;
        $isPast = $event['date'] < now()->format('Y-m-d');

        /* «три места» словами: голая цифра рядом с «свободно» читается хуже. */
        $places = function (int $n) {
            $t = ($n % 10 === 1 && $n % 100 !== 11) ? 'место'
                : (($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20)) ? 'места' : 'мест');

            return "{$n} {$t}";
        };
    @endphp

    <main class="ab-page ab-page--event">
        <section class="ab-evp__hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a>
                    <span>/</span>
                    <a href="/events.html">Встречи</a>
                    <span>/</span>
                    <b>{{ $event['title'] }}</b>
                </nav>

                <div class="ab-evp__grid">
                    <div class="ab-evp__text">
                        @if ($event['section'])
                            <span class="ab-cpage__tag">{{ $event['section'] }}</span>
                        @endif

                        <h1 class="ab-cpage__title">{{ $event['title'] }}</h1>
                        <p class="ab-cpage__lead">{{ $event['text'] }}</p>

                        {{-- Коротко самое нужное: когда, сколько идёт, сколько стоит,
                             сколько мест осталось и кто проводит. --}}
                        <ul class="ab-evp__facts">
                            <li>
                                <b>{{ $event['day'] }} {{ $event['month'] }}, {{ $event['time'] }}</b>
                                <span>{{ $event['weekday'] }}</span>
                            </li>

                            @if ($event['duration'])
                                <li><b>{{ $event['duration'] }}</b><span>длительность</span></li>
                            @endif

                            <li>
                                <b>{{ $event['price'] ? number_format($event['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}</b>
                                <span>участие</span>
                            </li>

                            @if ($total)
                                <li @class(['is-last' => !$isPast && $left && $left <= 2])>
                                    <b>{{ $isPast || !$left ? 'мест нет' : 'свободно ' . $places($left) }}</b>
                                    <span>
                                        @if ($taken)
                                            записалось {{ $taken }} из {{ $total }}
                                        @else
                                            группа до {{ $total }} человек
                                        @endif
                                    </span>
                                </li>
                            @endif

                            @if ($event['host'])
                                <li><b>{{ $event['host'] }}</b><span>проводит встречу</span></li>
                            @endif

                            @if ($event['place'])
                                <li><b>{{ $event['place'] }}</b><span>где проходит</span></li>
                            @endif
                        </ul>

                        @if ($isPast)
                            <p class="ab-evp__closed">
                                Встреча прошла. Напишите нам — подскажем ближайшую дату
                                по той же теме.
                            </p>
                            <a class="ab-btn ab-btn--outline ab-btn--lg" href="/events.html">
                                Смотреть ближайшие встречи
                            </a>
                        @elseif ($total && !$left)
                            <p class="ab-evp__closed">
                                Мест на эту дату больше нет. Оставьте заявку — позовём,
                                когда объявим следующую.
                            </p>
                            <button class="ab-btn ab-btn--outline ab-btn--lg" type="button"
                                    data-modal-path="events" data-modal-kind="event"
                                    data-modal-item="{{ $event['title'] }}"
                                    data-modal-item-label="Встреча {{ $event['day'] }} {{ $event['month'] }}, {{ $event['time'] }}"
                                    data-modal-source="Встреча: {{ $event['title'] }} ({{ $event['day'] }} {{ $event['month'] }})">
                                Сообщить о следующей
                            </button>
                        @else
                            <button class="ab-btn ab-btn--primary ab-btn--lg" type="button"
                                    data-modal-path="events" data-modal-kind="event"
                                    data-modal-item="{{ $event['title'] }}"
                                    data-modal-item-label="Встреча {{ $event['day'] }} {{ $event['month'] }}, {{ $event['time'] }}"
                                    data-modal-source="Встреча: {{ $event['title'] }} ({{ $event['day'] }} {{ $event['month'] }})">
                                Записаться на встречу
                            </button>
                        @endif
                    </div>

                    <div class="ab-evp__media">
                        <img src="{{ $event['photo'] }}" alt="{{ $event['title'] }}"
                             width="573" height="470" loading="eager" decoding="async">
                    </div>
                </div>
            </div>
        </section>

        @if ($event['about'])
            <section class="ab-evp__about ab-reveal">
                <div class="ab-container">
                    <h2 class="ab-h2">Что будет на встрече</h2>

                    <div class="ab-evp__story">
                        @foreach ($event['about'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>

                    {{-- Карточки идут под текстом в ряд: сбоку они оставляли
                         пустое белое поле рядом с коротким описанием. --}}
                    <div class="ab-evp__aside">
                        @if ($event['for_whom'])
                            <div class="ab-evp__card">
                                <b>Кому подойдёт</b>
                                <p>{{ $event['for_whom'] }}</p>
                            </div>
                        @endif

                        <div class="ab-evp__card">
                            <b>Что взять с собой</b>
                            <p>Ничего: зерно, посуда и оборудование — наши.</p>
                        </div>

                        @if (!$isPast)
                            <div class="ab-evp__card ab-evp__card--cta">
                                <b>Записаться</b>
                                <p>Подтвердим место и напомним за день до встречи.</p>
                                <button class="ab-btn ab-btn--primary" type="button"
                                        data-modal-path="events" data-modal-kind="event"
                                    data-modal-item="{{ $event['title'] }}"
                                    data-modal-item-label="Встреча {{ $event['day'] }} {{ $event['month'] }}, {{ $event['time'] }}"
                                    data-modal-source="Встреча: {{ $event['title'] }} ({{ $event['day'] }} {{ $event['month'] }})">
                                    Оставить заявку
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        @if ($others)
            <section class="ab-events ab-reveal">
                <div class="ab-container">
                    <h2 class="ab-h2">Другие встречи</h2>
                    @include('partials.blocks.events-posters', [
                        'limit' => 6, 'withPast' => false, 'row' => true, 'except' => $event['slug'],
                    ])
                </div>
            </section>
        @endif

        @include('partials.blocks.lead', [
            'title' => 'Остались вопросы по встрече?',
            'note'  => 'Расскажем, как проходит встреча, что нужно взять с собой и есть ли свободные места.',
        ])
        @include('partials.blocks.contacts')
    </main>

    @include('partials.site.footer')
</div>
@endsection
