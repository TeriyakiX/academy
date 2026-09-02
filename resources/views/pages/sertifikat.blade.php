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

                    <div class="ab-cert__media">
                        <img src="/assets/certificate.webp" alt="Подарочный сертификат Академии Бариста"
                             loading="eager" width="520" height="360">
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
