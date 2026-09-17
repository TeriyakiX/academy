@extends('layouts.app')

@push('head')
    @vite([
        'resources/src/app/assets/styles/home-blocks.css',
        'resources/src/app/assets/styles/course.css',
        'resources/src/app/assets/styles/service.css',
    ])
@endpush

@section('content')
@php $srv = config('service'); @endphp

<div class="wrapper">
    @include('partials.site.header')

    {{--
        Сервисный центр: ремонт и обслуживание оборудования.

        Порядок такой же, как думает человек с поломкой: сначала оставить
        заявку, потом понять, что делают, сколько это стоит и как проходит.
        Цены берутся из config/service.php; пока их не дали, стоит
        «по запросу» — выдуманных цифр на странице быть не должно.
    --}}
    <main class="ab-page ab-page--service">
        <section class="ab-srv-hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a><span>/</span><b>Сервис</b>
                </nav>

                <div class="ab-srv-hero__grid">
                    <div>
                        <span class="ab-cpage__tag">{{ $srv['hero']['tag'] }}</span>
                        <h1 class="ab-cpage__title">{{ $srv['hero']['title'] }}</h1>
                        <p class="ab-cpage__lead">{{ $srv['hero']['lead'] }}</p>

                        <ul class="ab-srv-hero__list">
                            @foreach ($srv['works'] as $work)
                                <li>{{ $work['title'] }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <form class="ab-srv-form" method="post" action="/lead">
                        @csrf
                        @include('partials.form-guard')

                        <input type="hidden" name="source" value="Сервис: ремонт оборудования">
                        <input type="hidden" name="page" value="{{ request()->getPathInfo() }}">

                        <b class="ab-srv-form__title">Оставьте заявку на ремонт</b>
                        <p class="ab-srv-form__note">{{ $srv['hero']['note'] }}</p>

                        <label class="ab-cmod__field">
                            <span>Имя</span>
                            <input type="text" name="name" placeholder="Как к вам обращаться" required autocomplete="name">
                        </label>

                        <label class="ab-cmod__field">
                            <span>Телефон</span>
                            <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required autocomplete="tel">
                        </label>

                        <label class="ab-cmod__field">
                            <span>Техника и что с ней</span>
                            <textarea name="comment" rows="3"
                                      placeholder="Например: суперавтомат Jura, не набирает воду"></textarea>
                        </label>

                        <button class="ab-btn ab-btn--primary ab-btn--block ab-btn--lg" type="submit">
                            Отправить заявку
                        </button>

                        <p class="ab-cmod__legal">
                            Отправляя форму, вы соглашаетесь с
                            <a href="/privacy-policy.html">политикой обработки персональных данных</a>
                        </p>
                    </form>
                </div>
            </div>
        </section>

        <section class="ab-srv-benefits ab-reveal">
            <div class="ab-container">
                <ul class="ab-srv-benefits__list">
                    @foreach ($srv['benefits'] as $benefit)
                        <li>
                            <b>{{ $benefit['title'] }}</b>
                            <span>{{ $benefit['text'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="ab-srv-works ab-reveal">
            <div class="ab-container">
                <h2 class="ab-h2">Что делаем</h2>
                <p class="ab-lead">Три типа работ: починить, поддерживать в порядке и настроить под ваш кофе.</p>

                <div class="ab-srv-works__grid">
                    @foreach ($srv['works'] as $work)
                        <article class="ab-srv-work">
                            <h3>{{ $work['title'] }}</h3>
                            <p>{{ $work['text'] }}</p>
                            <ul>
                                @foreach ($work['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="ab-srv-price ab-reveal">
            <div class="ab-container">
                <div class="ab-srv-price__grid">
                    <div>
                        <h2 class="ab-h2">Сколько это стоит</h2>
                        <p class="ab-lead">
                            Точную сумму называем после диагностики: она зависит от модели и узла.
                            Без согласования с вами работы не начинаем.
                        </p>

                        <ul class="ab-srv-price__list">
                            @foreach ($srv['prices'] as $row)
                                <li>
                                    <span>
                                        <b>{{ $row['title'] }}</b>
                                        <i>{{ $row['note'] }}</i>
                                    </span>
                                    <em>{{ $row['price'] ? 'от ' . number_format($row['price'], 0, '', ' ') . ' ₽' : 'по запросу' }}</em>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <ol class="ab-srv-steps">
                        @foreach ($srv['steps'] as $i => $step)
                            <li>
                                <span class="ab-srv-steps__num">{{ $i + 1 }}</span>
                                <b>{{ $step['title'] }}</b>
                                <span>{{ $step['text'] }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </section>

        <section class="ab-srv-equip ab-reveal">
            <div class="ab-container">
                <div class="ab-srv-equip__grid">
                    <div>
                        <h2 class="ab-h2">{{ $srv['equipment']['title'] }}</h2>
                        <p class="ab-lead">{{ $srv['equipment']['text'] }}</p>
                    </div>

                    <ul class="ab-srv-equip__list">
                        @foreach ($srv['equipment']['items'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        @include('partials.blocks.lead', [
            'title'  => 'Нужен ремонт или обслуживание?',
            'note'   => 'Опишите, что случилось с техникой, — мастер перезвонит, уточнит детали и назовёт стоимость работ.',
            'points' => [
                'Разберёмся, в чём причина поломки',
                'Скажем, сколько займут работы',
                'Назовём стоимость до начала ремонта',
            ],
            'action' => 'Вызвать мастера',
            'source' => 'Сервис: блок внизу страницы',
        ])
    </main>

    @include('partials.site.footer')
</div>
@endsection
