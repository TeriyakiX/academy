@extends('layouts.app')

@push('head')
    @vite(['resources/css/home-blocks.css', 'resources/css/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-thanks">
        <div class="ab-container">
            <div class="ab-thanks__card">
                <div class="ab-thanks__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="m5 12 5 5L19 8" fill="none" stroke="currentColor"
                              stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <h1 class="ab-thanks__title">Заявка отправлена</h1>
                <p class="ab-thanks__text">
                    Спасибо! Менеджер свяжется с вами в рабочее время
                    ({{ config('nav.contacts.hours') }}) и поможет выбрать программу.
                </p>

                <div class="ab-thanks__actions">
                    <a class="ab-btn ab-btn--primary ab-btn--lg" href="/courses.html">Посмотреть курсы</a>
                    <a class="ab-btn ab-btn--outline ab-btn--lg" href="/">На главную</a>
                </div>

                <p class="ab-thanks__phone">
                    Срочный вопрос?
                    <a href="{{ config('nav.contacts.phone_href') }}">{{ config('nav.contacts.phone') }}</a>
                </p>
            </div>
        </div>
    </main>

    @include('partials.site.footer')
</div>
@endsection
