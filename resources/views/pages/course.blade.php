@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/constructor.css', 'resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/course.css'])
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

                        @php
                            /*
                             | Короткая строка фактов вместо пяти одинаковых плиток.
                             | Порядок и подписи берём из методички курса как есть,
                             | цену показываем только в карточке записи.
                             */
                            $facts = $course['facts'];
                            $prices = (array) ($facts['стоимость'] ?? []);
                            /* Документ выносим из строки фактов: он один занимал
                               целый ряд и висел в пустоте. */
                            $doc = $facts['документ'] ?? null;
                            $meta = collect($facts)->except(['стоимость', 'документ'])->filter(fn ($v) => !empty($v));
                        @endphp

                        {{-- Характеристики и документ одной карточкой. --}}
                        <div class="ab-cpage__facts">
                        <dl class="ab-cpage__meta">
                            @foreach ($meta as $label => $value)
                                <div>
                                    <span class="ab-cpage__meta-mark">
                                        @include("partials.icons.fact", ["key" => $label])
                                    </span>
                                    <dt>{{ $label }}</dt>
                                    <dd>
                                        @foreach ((array) $value as $line)
                                            <span>{{ $line }}</span>
                                        @endforeach
                                    </dd>
                                </div>
                            @endforeach
                        </dl>

                        @if ($doc)
                            <p class="ab-cpage__doc">
                                @include("partials.icons.fact", ["key" => "документ"])
                                <span>Документ</span>
                                <b>{{ is_array($doc) ? implode(", ", $doc) : $doc }}</b>
                            </p>
                        @endif
                        </div>
                    </div>

                    {{-- Карточка записи. --}}
                    <div class="ab-cpage__side">
                    <aside class="ab-cpage__buy">
                        <div class="ab-cpage__price">
                            @if (!empty($course['old_price']))
                                <s>{{ number_format($course['old_price'], 0, ',', ' ') }} ₽</s>
                            @endif
                            @if (!empty($course['price']))
                                <strong>{{ number_format($course['price'], 0, ',', ' ') }} ₽</strong>
                            @else
                                {{-- Цена ещё не назначена: обещать сумму нельзя. --}}
                                <strong class="ab-cpage__price--ask">Цена по запросу</strong>
                            @endif
                        </div>

                        {{-- Цены за двоих и больше: рядом с основной ценой, а не
                             отдельной плиткой среди фактов курса. Показываем
                             сразу — под раскрывающейся строкой их не замечали. --}}
                        @if (count($prices) > 1)
                            <div class="ab-cpage__more">
                                <span class="ab-cpage__more-title">цены для группы</span>
                                @foreach (array_slice($prices, 1) as $line)
                                    <b>{{ $line }}</b>
                                @endforeach
                            </div>
                        @endif

                        <ul class="ab-cpage__buy-list">
                            <li>Обучение по образовательной лицензии</li>
                            <li>Практика на профессиональном оборудовании</li>
                            <li>Свидетельство о присвоении квалификации</li>
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
            </div>
        </section>

        {{-- ---------- Зачем и кому ---------- --}}
        @include('partials.blocks.course-pitch')

        {{-- ---------- Программа курса ----------
             Дни переключаются шагами: номер, название, под ними — содержимое
             дня. Форму записи отсюда убрали, она есть в шапке и в конце
             страницы, а ехать за человеком по экрану ей незачем. --}}
        @php
            /* У курсов из методичек программа записана по дням сразу,
               общий список тем им не нужен. */
            $days = \App\Support\CourseSchedule::days(
                $course['program'] ?? [], $course['duration'] ?? null, $course['days'] ?? null
            );
            $isClass = ($course['school'] ?? '') === 'Мастер-классы';
        @endphp

        @if (count($days) && count($days[0]['groups']))
            <section class="ab-prog ab-reveal">
                <div class="ab-container">
                    <h2 class="ab-prog__title">
                        Программа {{ $isClass ? 'мастер-класса' : 'курса' }}
                    </h2>

                    {{-- Снимок во всю ширину: он здесь уместнее, чем картинка
                         в карточке, которая ехала вместе с прокруткой. --}}
                    <div class="ab-prog__media">
                        <img src="{{ $course['photo'] }}" alt="{{ $course['title'] }}"
                             width="1600" height="500" loading="lazy" decoding="async">
                    </div>

                    <div class="ab-prog__tabs">
                        @foreach ($days as $i => $day)
                            <input class="ab-prog__radio" type="radio" name="ab-prog"
                                   id="ab-prog-{{ $i }}" @if ($i === 0) checked @endif>
                        @endforeach

                        {{-- У однодневных программ переключать нечего. --}}
                        @if (count($days) > 1)
                        <div class="ab-prog__steps" role="tablist">
                            @foreach ($days as $i => $day)
                                @php
                                    /* «День 1. Кофемашина» → номер отдельно, название отдельно. */
                                    $label = preg_replace('/^День\s*\d+[.:]?\s*/ui', '', $day['label']);
                                @endphp
                                <label class="ab-prog__step" for="ab-prog-{{ $i }}">
                                    <b>{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</b>
                                    <span>{{ $label ?: $day['label'] }}</span>
                                </label>
                            @endforeach
                        </div>
                        @endif

                        @foreach ($days as $i => $day)
                            <div class="ab-prog__panel" data-day="{{ $i }}">
                                @if (!empty($day['note']))
                                    <p class="ab-prog__note">{{ $day['note'] }}</p>
                                @endif

                                <div class="ab-prog__groups">
                                    @foreach ($day['groups'] as $group)
                                        <div class="ab-prog__group">
                                            <h3 class="ab-prog__group-title">
                                                @if ($group['icon'] === 'practice')
                                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                                        <path d="M4 10h13v4a6 6 0 0 1-6 6h-1a6 6 0 0 1-6-6v-4Z" />
                                                        <path d="M17 11h1.5a2.5 2.5 0 0 1 0 5H16" />
                                                        <path d="M8 3c0 1.5 1 1.5 1 3M12 3c0 1.5 1 1.5 1 3" />
                                                    </svg>
                                                @elseif ($group['icon'] === 'result')
                                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                                        <circle cx="12" cy="9" r="6" />
                                                        <path d="m9 14-2 7 5-3 5 3-2-7" />
                                                    </svg>
                                                @else
                                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                                        <path d="M4 20h4L19 9l-4-4L4 16v4Z" />
                                                        <path d="M13 7l4 4" />
                                                        <path d="M4 4h8" />
                                                    </svg>
                                                @endif
                                                {{ $group['title'] }}
                                            </h3>

                                            <ul class="ab-prog__items">
                                                @foreach ($group['items'] as $n => $item)
                                                    <li style="--i: {{ $n }}">{{ \Illuminate\Support\Str::ucfirst(trim($item)) }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- ---------- Преподаватели ---------- --}}
        @include('partials.blocks.teachers')

        {{-- ---------- Документ об обучении ---------- --}}
        @include('partials.blocks.course-diploma')

        {{-- ---------- Соседние программы ----------
             Вместо вкладок со всем каталогом: человек уже выбрал
             направление, ему нужнее ближайшие программы. --}}
        @include('partials.blocks.course-related')

        {{-- ---------- Заявка ---------- --}}
        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
