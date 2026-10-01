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
            {{-- Волна в основании шапки: мягкий переход к следующему блоку. --}}
            <div class="ab-cpage__wave" aria-hidden="true">
                <svg viewBox="0 0 1200 160" preserveAspectRatio="none">
                    <path d="M0 96c100-34 200-34 300 0s200 34 300 0 200-34 300 0 200 34 300 0v64H0Z" />
                    <path d="M0 108c120-28 240-28 360 0s240 28 360 0 240-28 360 0 240 28 360 0v52H0Z" />
                    <path d="M0 124c140-22 280-22 420 0s280 22 420 0 280-22 420 0v36H0Z" />
                </svg>
            </div>

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

                        @include('partials.blocks.course-trust')

                        @php
                            /* Цены за двоих и больше — в карточке записи. */
                            $prices = (array) ($course['facts']['стоимость'] ?? []);
                        @endphp
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

                        {{-- Главное о курсе здесь же: раньше это была вторая
                             карточка у программы, с такой же кнопкой. --}}
                        @php
                            $f = $course['facts'];
                            $specs = array_values(array_filter([
                                !empty($f['длительность']) ? ['Занятия', $f['длительность']] : null,
                                !empty($f['формат']) ? ['Формат', $f['формат']] : null,
                                !empty($f['размер группы']) ? ['Группа', $f['размер группы']] : null,
                                !empty($f['входной уровень']) ? ['Входной уровень', $f['входной уровень']] : null,
                                !empty($f['документ']) ? ['Документ', $f['документ']] : null,
                            ]));
                        @endphp

                        @if ($specs)
                            <dl class="ab-cpage__specs">
                                @foreach ($specs as $row)
                                    <div>
                                        <dt>{{ $row[0] }}</dt>
                                        <dd>{{ is_array($row[1]) ? implode(', ', $row[1]) : $row[1] }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        @endif

                        <ul class="ab-cpage__buy-list">
                            <li>Обучение по образовательной лицензии</li>
                            <li>Практика на профессиональном оборудовании</li>
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


        {{-- ---------- Программа курса ----------
             Слева — темы по дням: в каждом дне теория и практика.
             Справа — карточка записи, она едет вместе с прокруткой,
             чтобы записаться можно было из любого места программы. --}}
        @php
            /* У курсов из методичек программа записана по дням сразу,
               общий список тем им не нужен. */
            $days = \App\Support\CourseSchedule::days(
                $course['program'] ?? [], $course['duration'] ?? null, $course['days'] ?? null
            );
            $dayCount = \App\Support\CourseSchedule::dayCount($course['duration'] ?? null);
            $dayWord  = ($dayCount % 10 === 1 && $dayCount % 100 !== 11) ? 'дня' : 'дней';
            /* Мастер-класс — не курс: и в заголовке, и в карточке записи. */
            $isClass  = ($course['school'] ?? '') === 'Мастер-классы';
            /* Короткая программа (одно занятие) не дотягивается до карточки
               записи, и справа от неё оставалось пустое поле в пол-экрана.
               В таком случае ставим карточку под программой. */
            $shortProgram = count($days) === 1;
        @endphp

        @if (count($days) && count($days[0]['groups']))
            <section class="ab-cmod ab-reveal">
                <div class="ab-container">
                    <div class="ab-cmod__grid @if ($shortProgram) ab-cmod__grid--short @endif">
                        <div class="ab-cmod__main">
                            <h2 class="ab-cmod__title">
                                Программа {{ $isClass ? 'мастер-класса' : 'курса' }}
                            </h2>

                            <ol class="ab-cmod__list">
                                @foreach ($days as $i => $day)
                                    {{-- День раскрывается по нажатию: вся программа
                                         сразу занимала несколько экранов телефона.
                                         Первый день открыт, чтобы было видно, что внутри. --}}
                                    <li class="ab-cmod__day">
                                        <details @if ($shortProgram || $i === 0) open @endif>
                                            <summary class="ab-cmod__day-title">
                                                {{-- Номер дня уже в подписи, рядом значок зерна как метка. --}}
                                                <svg class="ab-cmod__day-mark" viewBox="0 0 24 24" aria-hidden="true">
                                                    <ellipse cx="12" cy="12" rx="7" ry="9.5" transform="rotate(35 12 12)" />
                                                    <path d="M8.5 5.5c3 2.5 1 5.5 3.5 7s1.5 4 3.5 6" />
                                                </svg>
                                                {{ $shortProgram ? 'Что разбираем на занятии' : $day['label'] }}
                                            </summary>

                                        @if (!empty($day['note']))
                                            <p class="ab-cmod__day-note">{{ $day['note'] }}</p>
                                        @endif

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
                                        </details>
                                    </li>
                                @endforeach
                            </ol>
                        </div>

                        {{-- Справа — снимок школы: карточка с такой же кнопкой,
                             как в шапке, тут только дублировалась. --}}
                        <aside class="ab-cmod__aside">
                            <figure class="ab-cmod__shot">
                                <img src="{{ $course['photo'] }}" alt="Занятие в Академии Бариста"
                                     width="760" height="520" loading="lazy" decoding="async">
                                <figcaption>Занятия идут в нашей кофейне на {{ str_replace('г. Москва, ', '', config('nav.contacts.address')) }}</figcaption>
                            </figure>
                        </aside>

                    </div>
                </div>
            </section>
        @endif


        {{-- ---------- О курсе: зачем, кому и что внутри ---------- --}}
        @include('partials.blocks.course-pitch')

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
