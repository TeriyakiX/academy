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

                        <ul class="ab-cpage__facts">
                            @foreach ($course['facts'] as $label => $value)
                                {{-- Значение бывает списком: цена за одного, за двоих, за троих.
                                     Цены для группы свёрнуты: иначе в карточке простыня цифр. --}}
                                @php $lines = (array) $value; @endphp
                                <li @class(['is-list' => count($lines) > 1])>
                                    <span>{{ $label }}</span>
                                    @if ($label === 'стоимость' && count($lines) > 1)
                                        <b>{{ $lines[0] }}</b>
                                        <details class="ab-cpage__more">
                                            <summary>цены для группы</summary>
                                            @foreach (array_slice($lines, 1) as $line)
                                                <b>{{ $line }}</b>
                                            @endforeach
                                        </details>
                                    @else
                                        @foreach ($lines as $line)
                                            <b>{{ $line }}</b>
                                        @endforeach
                                    @endif
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
        </section>

        {{-- ---------- Программа курса ----------
             Слева — темы по дням: в каждом дне теория и практика.
             Справа — карточка записи, она едет вместе с прокруткой,
             чтобы записаться можно было из любого места программы. --}}
        @php
            $days = \App\Support\CourseSchedule::days(
                $course['program'], $course['duration'] ?? null, $course['days'] ?? null
            );
            $dayCount = \App\Support\CourseSchedule::dayCount($course['duration'] ?? null);
            $dayWord  = ($dayCount % 10 === 1 && $dayCount % 100 !== 11) ? 'дня' : 'дней';
            /* Мастер-класс — не курс: и в заголовке, и в карточке записи. */
            $isClass  = ($course['school'] ?? '') === 'Мастер-классы';
        @endphp

        @if (count($days) && count($days[0]['groups']))
            <section class="ab-cmod ab-reveal">
                <div class="ab-container">
                    <div class="ab-cmod__grid">
                        <div class="ab-cmod__main">
                            <h2 class="ab-cmod__title">
                                Программа {{ $isClass ? 'мастер-класса' : 'курса' }} <b>{{ $course['title'] }}</b>
                                @if ($dayCount > 1)
                                    <span>состоит из {{ $dayCount }} {{ $dayWord }}</span>
                                @endif
                            </h2>

                            <ol class="ab-cmod__list">
                                @foreach ($days as $day)
                                    <li class="ab-cmod__day">
                                        <h3 class="ab-cmod__day-title">
                                            {{-- Номер уже в подписи — рядом значок зерна, как метка модуля. --}}
                                            <svg class="ab-cmod__day-mark" viewBox="0 0 24 24" aria-hidden="true">
                                                <ellipse cx="12" cy="12" rx="7" ry="9.5" transform="rotate(35 12 12)" />
                                                <path d="M8.5 5.5c3 2.5 1 5.5 3.5 7s1.5 4 3.5 6" />
                                            </svg>
                                            [ {{ $day['label'] }} ]
                                        </h3>

                                        <div class="ab-cmod__groups">
                                            @foreach ($day['groups'] as $group)
                                                <div class="ab-cmod__group">
                                                    <h4 class="ab-cmod__group-title">
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
                                                    </h4>

                                                    <ul class="ab-cmod__items">
                                                        @foreach ($group['items'] as $item)
                                                            <li>{{ \Illuminate\Support\Str::ucfirst(trim($item)) }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>

                        {{-- Карточка записи рядом с программой. --}}
                        <aside class="ab-cmod__aside">
                            <form class="ab-cmod__card" method="post" action="/lead">
                                @csrf
                                @include('partials.form-guard')

                                <input type="hidden" name="source" value="Программа курса">
                                <input type="hidden" name="page" value="{{ request()->getPathInfo() }}">
                                <input type="hidden" name="courses" value="{{ $course['title'] }}">

                                <img class="ab-cmod__photo" src="{{ $course['photo'] }}" alt="{{ $course['title'] }}"
                                     width="573" height="470" loading="lazy" decoding="async">

                                <div class="ab-cmod__chips">
                                    @if (!empty($course['duration']))
                                        <span>{{ $course['duration'] }}</span>
                                    @endif
                                    @if (!empty($course['price']))
                                        <span>{{ number_format($course['price'], 0, ',', ' ') }} ₽</span>
                                    @endif
                                </div>

                                <b class="ab-cmod__card-title">Хочу записаться на {{ $isClass ? 'мастер-класс' : 'курс' }} «{{ $course['title'] }}»</b>
                                @if (!empty($course['groups']))
                                    {{-- Ближайшие группы ведутся в CRM. --}}
                                    <ul class="ab-cmod__dates">
                                        @foreach (array_slice($course['groups'], 0, 3) as $group)
                                            <li>
                                                <b>{{ \Illuminate\Support\Carbon::parse($group['date'])->locale('ru')->translatedFormat('j F') }}</b>
                                                @if ($group['time']) <span>{{ $group['time'] }}</span> @endif
                                                @if ($group['seats'] !== null) <i>{{ $group['seats'] ? 'мест: ' . $group['seats'] : 'мест нет' }}</i> @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                    <p class="ab-cmod__card-note">Оставьте заявку — менеджер забронирует место в группе.</p>
                                @else
                                    <p class="ab-cmod__card-note">Оставьте заявку — менеджер свяжется с вами и подберёт дату.</p>
                                @endif

                                <label class="ab-cmod__field">
                                    <span>Имя</span>
                                    <input type="text" name="name" placeholder="Как к вам обращаться" required autocomplete="name">
                                </label>

                                <label class="ab-cmod__field">
                                    <span>Телефон</span>
                                    <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required autocomplete="tel">
                                </label>

                                <button class="ab-btn ab-btn--primary ab-btn--block ab-btn--lg" type="submit">
                                    Отправить заявку
                                </button>

                                <p class="ab-cmod__legal">
                                    Отправляя форму, вы соглашаетесь с
                                    <a href="/privacy-policy.html">политикой обработки персональных данных</a>
                                </p>
                            </form>
                        </aside>
                    </div>
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

        {{-- ---------- График занятий ----------
             Раньше блок стоял на главной. Он полезнее здесь: человек
             читает про конкретный курс и сразу видит, когда учиться. --}}
        @include('partials.blocks.schedule')

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
