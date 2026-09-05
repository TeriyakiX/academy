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

                <h1 class="ab-cpage__title">{{ $current->title ?? 'Оборудование для кофеен' }}</h1>
                <p class="ab-cpage__lead">
                    {{ $current->description
                        ?? 'Профессиональные кофемашины, кофемолки и аксессуары — то же оборудование,
                            на котором проходит обучение в Академии.' }}
                </p>
            </div>
        </section>

        <section class="ab-shop">
            <div class="ab-container">
                <div class="ab-shop__filters" role="tablist" aria-label="Категории оборудования">
                    <a class="ab-shop__filter @if (!$current) is-active @endif" href="/shop.html">Все</a>
                    @foreach ($categories as $c)
                        <a class="ab-shop__filter @if ($current && $current->id === $c->id) is-active @endif"
                           href="/shop.html?category={{ $c->slug }}">{{ $c->title }}</a>
                    @endforeach
                </div>

                @if ($products->isEmpty())
                    <p class="ab-shop__empty">
                        В этой категории пока нет позиций.
                        <a href="{{ config('nav.contacts.phone_href') }}">Позвоните нам</a> — подберём под задачу.
                    </p>
                @else
                    <ul class="ab-shop__grid">
                        @foreach ($products as $p)
                            <li class="ab-shop__card ab-reveal">
                                <a class="ab-shop__media" href="{{ $p->url }}">
                                    @if ($p->image)
                                        <img src="{{ $p->image }}" alt="{{ $p->title }}"
                                             loading="lazy" width="360" height="260">
                                    @else
                                        <span class="ab-shop__noimage">{{ $p->brand ?: 'Фото скоро' }}</span>
                                    @endif
                                </a>

                                <div class="ab-shop__body">
                                    @if ($p->brand)
                                        <span class="ab-shop__brand">{{ $p->brand }}</span>
                                    @endif
                                    <h2 class="ab-shop__name">
                                        <a href="{{ $p->url }}">{{ $p->title }}</a>
                                    </h2>
                                    <p class="ab-shop__summary">{{ $p->summary }}</p>

                                    <div class="ab-shop__foot">
                                        <div class="ab-shop__price">
                                            <b>{{ $p->price_label }}</b>
                                            @if ($p->old_price_label)
                                                <s>{{ $p->old_price_label }}</s>
                                            @endif
                                            <span class="ab-shop__stock ab-shop__stock--{{ $p->availability }}">
                                                {{ $p->availability_label }}
                                            </span>
                                        </div>
                                        <a class="ab-btn ab-btn--outline ab-btn--sm" href="{{ $p->url }}">Подробнее</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </section>

        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
