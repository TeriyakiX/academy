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
        $left  = $event['seats_left'] ?? null;
        $total = $event['seats_total'] ?? null;
        $isPast = !empty($event['date']) && $event['date'] < now()->format('Y-m-d');

        /* «Осталось три места» словами: цифра без подписи людям ничего не говорит. */
        $seatsWord = function (int $n) {
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
                        @if (!empty($event['section']))
                            <span class="ab-cpage__tag">{{ $event['section'] }}</span>
                        @endif

                        <h1 class="ab-cpage__title">{{ $event['title'] }}</h1>
                        <p class="ab-cpage__lead">{{ $event['text'] }}</p>

                        <ul class="ab-evp__facts">
                            <li>
                                <b>{{ $event['day'] }} {{ $event['month'] }}</b>
                                <span>{{ $event['weekday'] }}, {{ $event['time'] }}</span>
                            </li>
                            @if (!empty($event['duration']))
                                <li><b>{{ $event['duration'] }}</b><span>длительность</span></li>
                            @endif
                            <li>
                                <b>{{ $event['price'] ? number_format($event['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}</b>
                                <span>участие</span>
                            </li>
                            @if ($total)
                                <li>
                                    <b>{{ $isPast || !$left ? 'мест нет' : 'осталось ' . $seatsWord($left) }}</b>
                                    <span>группа до {{ $total }} человек</span>
                                </li>
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
                        @else
                            <button class="ab-btn ab-btn--primary ab-btn--lg" type="button"
                                    data-modal-path="events">
                                Записаться на встречу
                            </button>
                        @endif
                    </div>

                    <div class="ab-evp__media">
                        <img src="{{ $event['photo'] ?? '/assets/master-class.webp' }}"
                             alt="{{ $event['title'] }}"
                             width="573" height="470" loading="eager" decoding="async">
                    </div>
                </div>
            </div>
        </section>

        @if (!empty($event['about']))
            <section class="ab-evp__about ab-reveal">
                <div class="ab-container">
                    <h2 class="ab-h2">Что будет на встрече</h2>

                    <div class="ab-evp__cols">
                        <div class="ab-evp__story">
                            @foreach ($event['about'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>

                        <aside class="ab-evp__aside">
                            @if (!empty($event['for_whom']))
                                <div class="ab-evp__card">
                                    <b>Кому подойдёт</b>
                                    <p>{{ $event['for_whom'] }}</p>
                                </div>
                            @endif

                            @if (!empty($event['place']))
                                <div class="ab-evp__card">
                                    <b>Где проходит</b>
                                    <p>{{ $event['place'] }}</p>
                                </div>
                            @endif

                            <div class="ab-evp__card">
                                <b>Что взять с собой</b>
                                <p>Ничего: зерно, посуда и оборудование — наши.</p>
                            </div>
                        </aside>
                    </div>
                </div>
            </section>
        @endif

        @if (!empty($others))
            <section class="ab-events ab-reveal">
                <div class="ab-container">
                    <h2 class="ab-h2">Другие встречи</h2>

                    <ul class="ab-ev__list">
                        @foreach ($others as $other)
                            <li class="ab-ev__card">
                                <a class="ab-ev__photo" href="/events/{{ $other['slug'] }}.html">
                                    <img src="{{ $other['photo'] ?? '/assets/master-class.webp' }}"
                                         alt="{{ $other['title'] }}"
                                         width="420" height="280" loading="lazy" decoding="async">
                                    @if (!empty($other['section']))
                                        <span class="ab-ev__badge">{{ $other['section'] }}</span>
                                    @endif
                                </a>

                                <div class="ab-ev__body">
                                    <div class="ab-ev__when">
                                        <b class="ab-ev__day">{{ $other['day'] }}<span>{{ $other['month'] }}</span></b>
                                        <span class="ab-ev__time">
                                            {{ $other['time'] }}
                                            <em>{{ $other['weekday'] }}</em>
                                        </span>
                                    </div>

                                    <h3 class="ab-ev__title">
                                        <a href="/events/{{ $other['slug'] }}.html">{{ $other['title'] }}</a>
                                    </h3>
                                    <p class="ab-ev__text">{{ $other['text'] }}</p>
                                    <p class="ab-ev__price">
                                        {{ $other['price'] ? number_format($other['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
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
