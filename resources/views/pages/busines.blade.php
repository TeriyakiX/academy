@extends('layouts.app')

@push('head')
    @vite(['resources/css/home-blocks.css', 'resources/css/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main>
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
                        <li><b>4 года</b><span>в кофейном бизнесе</span></li>
                        <li><b>8</b><span>услуг для бизнеса</span></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="ab-bus ab-reveal">
            <div class="ab-container">
                <h2 class="ab-h2">Что мы делаем</h2>
                <p class="ab-lead">Выберите услугу — расскажем подробнее и посчитаем под ваш проект.</p>

                <div data-island="BusinessServices"
                     data-props="{{ json_encode(['items' => config('home.business.items')], JSON_UNESCAPED_UNICODE) }}"></div>
            </div>
        </section>

        @include('partials.blocks.stats')
        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
