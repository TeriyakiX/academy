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

                        {{-- Главное о курсе — в текстовой колонке, а не внизу карточки:
                             там его не замечали. --}}
                        @php
                            $f = $course['facts'];
                            $specs = array_values(array_filter([
                                !empty($f['длительность']) ? ['Занятия', $f['длительность']] : null,
                                !empty($f['формат']) ? ['Формат', $f['формат']] : null,
                                !empty($f['размер группы']) ? ['Группа', $f['размер группы']] : null,
                                !empty($f['документ']) ? ['Документ', $f['документ']] : null,
                            ]));
                        @endphp

                        @if ($specs)
                            <dl class="ab-cpage__specs ab-cpage__specs--left">
                                @foreach ($specs as $row)
                                    <div>
                                        <dt>{{ $row[0] }}</dt>
                                        <dd>{{ is_array($row[1]) ? implode(', ', $row[1]) : $row[1] }}</dd>
                                    </div>
                                @endforeach
                            </dl>
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
                        {{-- Карточка собрана в том же ключе, что форма у программы:
                             снимок, плашки, заголовок. Отличие — здесь не форма,
                             а цена и кнопка: заполнять ничего не надо. --}}
                        <img class="ab-cpage__buy-shot" src="{{ $course['photo'] }}"
                             alt="Занятие в Академии Бариста" width="760" height="420"
                             loading="lazy" decoding="async">

                        <div class="ab-cpage__buy-chips">
                            @if (!empty($course['duration']))
                                <span>{{ $course['duration'] }}</span>
                            @endif
                        </div>

                        <b class="ab-cpage__buy-title">Стоимость обучения</b>

                        <div class="ab-cpage__price">
                            @if (!empty($course['price']))
                                <strong>{{ number_format($course['price'], 0, ',', ' ') }} ₽</strong>
                            @else
                                {{-- Цена ещё не назначена: обещать сумму нельзя. --}}
                                <strong class="ab-cpage__price--ask">Цена по запросу</strong>
                            @endif

                            @if (!empty($course['old_price']))
                                <span class="ab-cpage__price-old">
                                    <s>{{ number_format($course['old_price'], 0, ',', ' ') }} ₽</s>
                                    <i>выгода {{ number_format($course['old_price'] - $course['price'], 0, ',', ' ') }} ₽</i>
                                </span>
                            @endif
                        </div>

                        @if (count($prices) > 1)
                            <dl class="ab-cpage__group">
                                <dt class="ab-cpage__group-title">Если идёте компанией</dt>
                                @foreach (array_slice($prices, 1) as $line)
                                    @php $parts = preg_split('/\s+—\s+/u', $line, 2); @endphp
                                    <dd>
                                        <span>{{ $parts[0] }}</span>
                                        <b>{{ $parts[1] ?? '' }}</b>
                                    </dd>
                                @endforeach
                            </dl>
                        @endif

                        <button class="ab-btn ab-btn--primary ab-btn--block ab-btn--lg"
                                type="button" data-modal-path="consultation">Записаться на курс</button>

                        <div class="ab-cpage__buy-foot">
                            <a class="ab-cpage__buy-phone" href="{{ config('nav.contacts.phone_href') }}">
                                {{ config('nav.contacts.phone') }}
                                <span>{{ config('nav.contacts.hours') }}</span>
                            </a>

                            {{-- Написать, а не звонить: часть людей так удобнее. --}}
                            <ul class="ab-cpage__buy-socials">
                                @foreach (collect(config('nav.socials'))->whereIn('icon', ['telegram', 'whatsapp', 'max']) as $s)
                                    <li>
                                        <a href="{{ $s['href'] }}" target="_blank" rel="noopener"
                                           title="{{ $s['title'] }}" aria-label="Написать в {{ $s['title'] }}">
                                            <svg class="site-icon"><use href="#i-{{ $s['icon'] }}"></use></svg>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                    </div>
                </div>
            </div>
        </section>


        {{-- ---------- О курсе: зачем, кому и что внутри ---------- --}}
        @include('partials.blocks.course-pitch')

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

                        {{-- Форма записи рядом с программой: так её и просил
                             клиент — снимок, часы с ценой, два поля и кнопка. --}}
<aside class="ab-cmod__aside">
                            <form class="ab-cmod__card" method="post" action="/lead">
                                @csrf
                                @include('partials.form-guard')

                                <input type="hidden" name="source" value="Программа курса">
                                <input type="hidden" name="page" value="{{ request()->getPathInfo() }}">
                                <input type="hidden" name="courses" value="{{ $course['title'] }}">

                                <img class="ab-cmod__photo" src="{{ $course['photo'] }}" alt="{{ $course['title'] }}"
                                     width="573" height="470" loading="lazy" decoding="async">

                                {{-- Всё, кроме фото: у короткой программы карточка
                                     широкая, и текст с формой встаёт рядом со снимком. --}}
                                <div class="ab-cmod__card-body">
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
                                </div>
                            </form>
                        </aside>

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
