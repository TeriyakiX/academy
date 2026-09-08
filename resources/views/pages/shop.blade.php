@extends('layouts.app')

@push('head')
    @vite(['resources/css/home-blocks.css', 'resources/css/course.css', 'resources/css/shop.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--shop">
        <section class="ab-cpage__hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a>
                    <span>/</span>
                    @if ($current)
                        <a href="/shop.html">Оборудование</a>
                        <span>/</span>
                        <b>{{ $current->title }}</b>
                    @else
                        <b>Оборудование</b>
                    @endif
                </nav>

                <h1 class="ab-cpage__title">
                    {{ $current->title ?? 'Оборудование для кофеен' }}@if ($brand) <span class="ab-cpage__title-brand">{{ $brand }}</span>@endif
                </h1>
                <p class="ab-cpage__lead">
                    {{ $current->description
                        ?? 'Профессиональные кофемашины, кофемолки и аксессуары — то же оборудование,
                            на котором проходит обучение в Академии.' }}
                </p>
            </div>
        </section>

        <section class="ab-shop">
            <div class="ab-container">
                {{-- Выбор идёт сверху вниз: сначала производитель, потом тип
                     оборудования. Оба фильтра работают вместе, поэтому ссылки
                     сохраняют уже выбранное значение соседнего фильтра. --}}
                @php
                    $link = function (?string $brandSlug, ?string $catSlug) {
                        $q = array_filter(['brand' => $brandSlug, 'category' => $catSlug]);
                        return '/shop.html' . ($q ? '?' . http_build_query($q) : '');
                    };
                @endphp

                {{-- На узком экране фильтры показываем списками: девять кнопок
                     во всю ширину отодвигали товары почти на экран вниз. --}}
                <div class="ab-shop__selects">
                    @if ($brands->count() > 1)
                        <label class="ab-shop__select">
                            <span>Производитель</span>
                            <select data-filter-go>
                                <option value="{{ $link(null, $current?->slug) }}" @selected(!$brand)>
                                    Все производители ({{ $allCount }})
                                </option>
                                @foreach ($brands as $b)
                                    <option value="{{ $link($b, $current?->slug) }}" @selected($brand === $b)>
                                        {{ $b }} ({{ $brandCounts[$b] }})
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    @endif

                    <label class="ab-shop__select">
                        <span>Тип оборудования</span>
                        <select data-filter-go>
                            <option value="{{ $link($brand, null) }}" @selected(!$current)>
                                Всё оборудование ({{ $allCount }})
                            </option>
                            @foreach ($categories as $c)
                                <option value="{{ $link($brand, $c->slug) }}"
                                        @selected($current && $current->id === $c->id)>
                                    {{ $c->title }} ({{ $catCounts[$c->slug] }})
                                </option>
                            @endforeach
                        </select>
                    </label>

                    @if ($brand || $current)
                        <a class="ab-shop__reset" href="/shop.html">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
                            Сбросить фильтры
                        </a>
                    @endif
                </div>

                <div class="ab-shop__filters-panel">
                    @if ($brands->count() > 1)
                        <div class="ab-shop__filter-group">
                            <span class="ab-shop__filter-label">Производитель</span>
                            <div class="ab-shop__filters" role="tablist" aria-label="Производители">
                                <a class="ab-shop__filter @if (!$brand) is-active @endif"
                                   href="{{ $link(null, $current?->slug) }}">
                                    Все <b>{{ $allCount }}</b>
                                </a>
                                @foreach ($brands as $b)
                                    <a class="ab-shop__filter @if ($brand === $b) is-active @endif"
                                       href="{{ $link($b, $current?->slug) }}">
                                        {{ $b }} <b>{{ $brandCounts[$b] }}</b>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="ab-shop__filter-group">
                        <span class="ab-shop__filter-label">Тип оборудования</span>
                        <div class="ab-shop__filters" role="tablist" aria-label="Категории оборудования">
                            <a class="ab-shop__filter @if (!$current) is-active @endif"
                               href="{{ $link($brand, null) }}">
                                Все <b>{{ $allCount }}</b>
                            </a>
                            @foreach ($categories as $c)
                                <a class="ab-shop__filter @if ($current && $current->id === $c->id) is-active @endif"
                                   href="{{ $link($brand, $c->slug) }}">
                                    {{ $c->title }} <b>{{ $catCounts[$c->slug] }}</b>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @if ($brand || $current)
                        <a class="ab-shop__reset" href="/shop.html">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
                            Сбросить фильтры
                        </a>
                    @endif
                </div>
                @if ($products->isEmpty())
                    <p class="ab-shop__empty">
                        В этой категории пока нет позиций.
                        <a href="{{ config('nav.contacts.phone_href') }}">Позвоните нам</a> — подберём под задачу.
                    </p>
                @else
                    <ul class="ab-shop__grid" id="tovary">
                        @foreach ($products as $p)
                            {{-- Карточка кликабельна целиком: ссылка на названии
                                 растянута на всю карточку, поэтому попасть можно
                                 куда угодно, а в разметке остаётся одна ссылка. --}}
                            <li class="ab-shop__card">
                                <div class="ab-shop__media">
                                    @if ($p->image)
                                        <img src="{{ $p->image }}" alt="{{ $p->title }}"
                                             loading="lazy" width="360" height="260">
                                    @else
                                        <span class="ab-shop__noimage" aria-hidden="true">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 8h12v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5V8Z"/>
                                                <path d="M16 9h1.5a2.5 2.5 0 0 1 0 5H16"/>
                                                <path d="M7 3.5c0 1-1 1-1 2M10 3.5c0 1-1 1-1 2M13 3.5c0 1-1 1-1 2"/>
                                                <path d="M3 21h14"/>
                                            </svg>
                                            <b>{{ $p->brand ?: 'Академия Бариста' }}</b>
                                        </span>
                                    @endif

                                </div>

                                <div class="ab-shop__body">
                                    @if ($p->brand)
                                        <span class="ab-shop__brand">{{ $p->brand }}</span>
                                    @endif
                                    <h2 class="ab-shop__name">
                                        <a class="ab-shop__link" href="{{ $p->url }}">{{ $p->title }}</a>
                                    </h2>
                                    @if ($p->chips)
                                        <ul class="ab-shop__chips">
                                            @foreach ($p->chips as $chip)
                                                <li>{{ $chip }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <div class="ab-shop__foot">
                                        <div class="ab-shop__price">
                                            <b>{{ $p->price_label }}</b>
                                            @if ($p->old_price_label)
                                                <s>{{ $p->old_price_label }}</s>
                                            @endif
                                        </div>
                                        <span class="ab-shop__more" aria-hidden="true">Подробнее</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    @if ($shown < $total)
                        <div class="ab-shop__more-wrap">
                            <span class="ab-shop__counter">Показано {{ $shown }} из {{ $total }}</span>
                            <a class="ab-btn ab-btn--outline"
                               href="{{ request()->fullUrlWithQuery(['show' => $shown + $perPage]) }}#tovary">
                                Показать ещё
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </section>

        @include('partials.blocks.lead', [
            'title'  => 'Не знаете, что выбрать?',
            'note'   => 'Подберём оборудование под вашу точку, посчитаем доставку и подключение.',
            'points' => [
                'Подберём модель под поток и меню',
                'Посчитаем доставку и подключение',
                'Обучим персонал работе на оборудовании',
            ],
            'action' => 'Получить подбор',
            'source' => 'Каталог оборудования',
        ])
    </main>

    @include('partials.site.footer')
</div>
@endsection
