@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    {{-- Временная заглушка для страниц, которые готовятся. Вёрстка и тексты
         самой страницы остаются в проекте: адрес возвращают через список
         в routes/web.php. --}}
    <main class="ab-thanks">
        <div class="ab-container">
            <div class="ab-thanks__card">
                <h1 class="ab-thanks__title">{{ $heading ?? 'Страница в разработке' }}</h1>
                <p class="ab-thanks__text">
                    {{ $text ?? 'Готовим раздел — скоро здесь появятся подробности.' }}
                    Позвоните или напишите нам: ответим на вопросы и поможем
                    в рабочее время ({{ config('nav.contacts.hours') }}).
                </p>

                <div class="ab-thanks__actions">
                    <a class="ab-btn ab-btn--primary ab-btn--lg"
                       href="{{ config('nav.contacts.phone_href') }}">Позвонить</a>
                    <a class="ab-btn ab-btn--outline ab-btn--lg" href="/">На главную</a>
                </div>

                <p class="ab-thanks__phone">
                    <a href="{{ config('nav.contacts.phone_href') }}">{{ config('nav.contacts.phone') }}</a>
                </p>
            </div>
        </div>
    </main>

    @include('partials.site.footer')
</div>
@endsection
