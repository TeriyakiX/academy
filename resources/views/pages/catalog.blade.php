@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--catalog">
        <section class="ab-cpage__hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a>
                    <span>/</span>
                    <b>{{ $catalog['h1'] }}</b>
                </nav>

                {{-- Текст слева, фото направления справа: без картинки шапка
                     выглядела пустой полосой над вкладками. --}}
                @php
                    /* Цифры каталога: сколько программ, с какой цены начинаются
                       и сколько направлений. Считаем по тем же карточкам,
                       что показаны ниже, — расхождений не будет. */
                    $all = collect($catalog['schools'])->flatMap(fn ($list) => $list);
                    $from = $all->filter(fn ($c) => !empty($c['price']))->min('price');
                    $count = $all->count();
                    $word = ($count % 10 === 1 && $count % 100 !== 11) ? 'программа'
                        : (($count % 10 >= 2 && $count % 10 <= 4 && ($count % 100 < 10 || $count % 100 >= 20)) ? 'программы' : 'программ');
                @endphp

                <div class="ab-cpage__split">
                    <div>
                        <h1 class="ab-cpage__title">{{ $catalog['h1'] }}</h1>
                        <p class="ab-cpage__lead">{{ $catalog['lead'] }}</p>

                        <ul class="ab-cpage__nums">
                            <li><b>{{ $count }}</b><span>{{ $word }}</span></li>
                            @if ($from)
                                <li><b>от {{ number_format($from, 0, ',', ' ') }} ₽</b><span>за обучение</span></li>
                            @endif
                            <li><b>{{ count($catalog['schools']) }}</b><span>{{ count($catalog['schools']) === 1 ? 'направление' : 'направления' }}</span></li>
                            <li><b>очно</b><span>в Москве, малые группы</span></li>
                        </ul>
                    </div>

                    @if (!empty($catalog['image']))
                        <div class="ab-cpage__media">
                            <img src="{{ $catalog['image'] }}" alt="{{ $catalog['h1'] }}"
                                 width="573" height="470" loading="eager" decoding="async">
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- Ступени роста: среди тринадцати программ иначе непонятно,
             с чего начинать. Показываем до карточек. --}}
        @include('partials.blocks.course-path')

        <section class="ab-programs">
            <div class="ab-container">
                <div data-island="CourseTabs"
                     data-props="{{ json_encode(['schools' => $catalog['schools']], JSON_UNESCAPED_UNICODE) }}"></div>
            </div>
        </section>

        @include('partials.blocks.constructor-cta')
        @include('partials.blocks.reviews')
        @include('partials.blocks.faq')
        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
