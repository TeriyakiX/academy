@extends('layouts.app')

@push('head')
    @vite(['resources/css/home-blocks.css', 'resources/css/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--contact">
        <section class="ab-cpage__hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a><span>/</span><b>Контакты</b>
                </nav>

                <h1 class="ab-cpage__title">Контакты</h1>
                <p class="ab-cpage__lead">
                    Ждём вас на занятиях по адресу {{ config('nav.contacts.address') }}.
                    Звоните или пишите — поможем выбрать программу.
                </p>
            </div>
        </section>

        <section class="ab-contacts ab-reveal">
            <div class="ab-container">
                <div class="ab-contacts__grid">
                    <div class="ab-contacts__info">
                        <ul class="ab-contacts__list">
                            <li>
                                <span>Телефон</span>
                                <a href="{{ config('nav.contacts.phone_href') }}">{{ config('nav.contacts.phone') }}</a>
                            </li>
                            <li>
                                <span>E-mail</span>
                                <a href="mailto:{{ config('nav.contacts.email') }}">{{ config('nav.contacts.email') }}</a>
                            </li>
                            <li>
                                <span>Адрес</span>
                                <b>{{ config('nav.contacts.address') }}</b>
                            </li>
                            <li>
                                <span>Время работы</span>
                                <b>{{ config('nav.contacts.hours') }}</b>
                            </li>
                        </ul>

                        <p class="ab-contacts__social-title">Мы в социальных сетях</p>
                        <ul class="ab-contacts__social">
                            @foreach (config('nav.socials') as $s)
                                <li>
                                    <a class="site-social" href="{{ $s['href'] }}" target="_blank"
                                       rel="noopener" aria-label="{{ $s['title'] }}">
                                        <svg class="site-icon"><use href="#i-{{ $s['icon'] }}"></use></svg>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="ab-contacts__map">
                        <iframe
                            class="lazy-map"
                            data-src="https://yandex.ru/map-widget/v1/?ll=37.684367%2C55.773872&z=16&pt=37.684075,55.773560,pm2rdm"
                            title="Академия Бариста на карте"
                            width="100%" height="460" frameborder="0" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </section>

        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
