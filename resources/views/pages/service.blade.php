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

    {{--
        Страница одной услуги для бизнеса.
        Сделана как страница курса: слева — что входит в работу,
        справа — карточка заявки, которая едет вместе с прокруткой.
        Свой адрес у каждой услуги нужен, чтобы её можно было
        отправить ссылкой и найти через поиск.
    --}}
    <main class="ab-page ab-page--business">
        <section class="ab-cpage__hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a><span>/</span>
                    <a href="/busines.html">Для бизнеса</a><span>/</span>
                    <b>{{ $service['short'] }}</b>
                </nav>

                <div class="ab-cpage__split">
                    <div>
                        <span class="ab-cpage__tag">Услуги для бизнеса</span>
                        <h1 class="ab-cpage__title">{{ $service['title'] }}</h1>
                        <p class="ab-cpage__lead">{{ $service['text'] }}</p>

                        {{-- Характеристики как на странице курса: одинаковый
                             вид по всему сайту, значок подбирается по подписи. --}}
                        @php
                            $specs = array_filter([
                                'стоимость' => !empty($service['price'])
                                    ? 'от ' . number_format($service['price'], 0, '', ' ') . ' ₽'
                                    : null,
                                'сроки'  => $service['duration'] ?? null,
                                /* Выездное обучение идёт только на территории
                                   заведения: онлайн тут обещать нельзя. */
                                'формат' => $service['format'] ?? 'очно и онлайн',
                            ]);
                        @endphp

                        {{-- На телефоне характеристики стоят плитками по две,
                             поэтому длинное значение и непарную последнюю
                             плитку растягиваем на всю строку: иначе рядом
                             остаётся пустая половина. --}}
                        @php
                            $wide = [];
                            $i = 0;

                            foreach ($specs as $key => $value) {
                                $wide[$key] = mb_strlen((string) $value) > 24;
                                $i++;
                            }

                            $narrow = array_keys(array_filter($wide, fn ($w) => !$w));

                            if (count($narrow) % 2 === 1) {
                                $wide[end($narrow)] = true;
                            }
                        @endphp

                        <dl class="ab-cpage__specs ab-cpage__specs--left">
                            @foreach ($specs as $key => $value)
                                <div @class(['is-wide' => $wide[$key]])>
                                    <dt>
                                        @include('partials.icons.fact', ['key' => $key])
                                        {{ \Illuminate\Support\Str::ucfirst($key) }}
                                    </dt>
                                    <dd>{{ $value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>

                    @if (!empty($service['image']))
                        <div class="ab-cpage__media">
                            <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}"
                                 width="573" height="470" loading="eager" decoding="async">
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @if (!empty($service['points']))
            <section class="ab-cmod ab-reveal">
                <div class="ab-container">
                    <div class="ab-cmod__grid">
                        <div class="ab-cmod__main">
                            <h2 class="ab-cmod__title">Что входит в работу</h2>

                            <ul class="ab-cmod__items ab-cmod__items--solo">
                                @foreach ($service['points'] as $point)
                                    <li>{{ \Illuminate\Support\Str::ucfirst(trim($point)) }}</li>
                                @endforeach
                            </ul>

                            {{-- Порядок работы и результат: без них под списком
                                 оставалось пустое место рядом с формой. --}}
                            @if (!empty($service['steps']))
                                <h3 class="ab-srv__subtitle">Как проходит работа</h3>

                                <ol class="ab-srv__steps">
                                    @foreach ($service['steps'] as $i => $step)
                                        <li>
                                            <b class="ab-srv__steps-n">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</b>
                                            <span>
                                                <b>{{ $step['title'] }}</b>
                                                {{ $step['text'] }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ol>
                            @endif

                            @if (!empty($service['result']))
                                <h3 class="ab-srv__subtitle">Что получает заведение</h3>

                                <ul class="ab-cmod__items ab-cmod__items--solo">
                                    @foreach ($service['result'] as $line)
                                        <li>{{ $line }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <aside class="ab-cmod__aside">
                            <form class="ab-cmod__card" method="post" action="/lead">
                                @csrf
                                @include('partials.form-guard')

                                <input type="hidden" name="source" value="Услуга: {{ $service['short'] }}">
                                <input type="hidden" name="page" value="{{ request()->getPathInfo() }}">
                                <input type="hidden" name="courses" value="{{ $service['title'] }}">

                                {{-- Снимок сверху — как в карточке записи на курс:
                                     карточки по сайту должны выглядеть одинаково. --}}
                                @if (!empty($service['image']))
                                    <img class="ab-cmod__photo" src="{{ $service['image'] }}" alt="{{ $service['title'] }}"
                                         width="573" height="470" loading="lazy" decoding="async">
                                @endif

                                <div class="ab-cmod__card-body">
                                <div class="ab-cmod__chips">
                                    @if (!empty($service['price']))
                                        <span>от {{ number_format($service['price'], 0, '', ' ') }} ₽</span>
                                    @endif
                                    @if (!empty($service['duration']))
                                        <span>{{ $service['duration'] }}</span>
                                    @endif
                                </div>

                                <b class="ab-cmod__card-title">Обсудить проект</b>
                                <p class="ab-cmod__card-note">
                                    Расскажите про кофейню — посчитаем работу под ваш проект и сроки.
                                </p>

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

        @if (!empty($others))
            <section class="ab-bus ab-reveal">
                <div class="ab-container">
                    <h2 class="ab-h2">Другие услуги</h2>

                    <div class="ab-bus__grid ab-bus__grid--near">
                        @each('partials.blocks.service-card', $others, 'service')
                    </div>
                </div>
            </section>
        @endif

        @include('partials.blocks.lead', [
            'title'  => 'Не нашли нужную услугу?',
            'note'   => 'Опишите задачу — подскажем, с чего начать, и предложим решение под ваш формат.',
            'points' => [
                'Разберём вашу задачу и формат заведения',
                'Предложим подходящую услугу',
                'Посчитаем стоимость и сроки',
            ],
            'action' => 'Обсудить проект',
            'source' => 'Услуги для бизнеса: блок внизу страницы',
        ])
    </main>

    @include('partials.site.footer')
</div>
@endsection
