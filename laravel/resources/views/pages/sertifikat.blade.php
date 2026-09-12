@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--cert">
        <section class="ab-cpage__hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a><span>/</span><b>Подарочные сертификаты</b>
                </nav>

                <div class="ab-bus__intro">
                    <div>
                        <span class="ab-cpage__tag">Подарочный сертификат</span>
                        <h1 class="ab-cpage__title">Подарочные сертификаты</h1>
                        <p class="ab-cpage__lead">
                            Подарите близким не просто эмоции, а ценные навыки. Обучение искусству бариста
                            или секретам барного дела — подарок, который останется с человеком надолго.
                        </p>
                        <div class="ab-hero__actions">
                            <button class="ab-btn ab-btn--primary ab-btn--lg" type="button"
                                    data-modal-path="certificate">Купить сертификат</button>
                            <a class="ab-btn ab-btn--outline ab-btn--lg" href="/courses.html">Выбрать программу</a>
                        </div>
                    </div>

                    {{-- Та же карточка, что и на главной. На прежнем снимке была
                         напечатана дата окончания, которая давно прошла. --}}
                    <div class="ab-cert__media ab-cert__media--light" aria-hidden="true">
                        <div class="ab-giftcard">
                            <span class="ab-giftcard__sheen"></span>

                            <img class="ab-giftcard__mark" src="/assets/logo.png" alt=""
                                 width="64" height="64" loading="eager" decoding="async">

                            <span class="ab-giftcard__kicker">Подарочный</span>
                            <strong class="ab-giftcard__word">Сертификат</strong>

                            <span class="ab-giftcard__rule"></span>
                            <span class="ab-giftcard__foot">Академия Бариста · Москва</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ab-programs ab-reveal">
            <div class="ab-container">
                <h2 class="ab-h2">На какие программы</h2>
                <p class="ab-lead">Сертификат можно оформить на любой курс или мастер-класс — выберите направление.</p>
                <div data-island="CourseTabs"
                     data-props="{{ json_encode(['schools' => config('courses.schools')], JSON_UNESCAPED_UNICODE) }}"></div>
            </div>
        </section>

        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
