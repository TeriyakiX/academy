@extends('layouts.app')

@push('head')
    @vite(['resources/css/home-blocks.css', 'resources/css/course.css', 'resources/css/shop.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--product">
        <section class="ab-product">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a>
                    <span>/</span>
                    <a href="/shop.html">Оборудование</a>
                    @if ($product->category)
                        <span>/</span>
                        <a href="/shop.html?category={{ $product->category->slug }}">{{ $product->category->title }}</a>
                    @endif
                    <span>/</span>
                    <b>{{ $product->title }}</b>
                </nav>

                <div class="ab-product__grid">
                    <div class="ab-product__media">
                        @if ($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->title }}"
                                 width="640" height="480" loading="eager">
                        @else
                            <span class="ab-shop__noimage" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 8h12v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5V8Z"/>
                                    <path d="M16 9h1.5a2.5 2.5 0 0 1 0 5H16"/>
                                    <path d="M7 3.5c0 1-1 1-1 2M10 3.5c0 1-1 1-1 2M13 3.5c0 1-1 1-1 2"/>
                                    <path d="M3 21h14"/>
                                </svg>
                                <b>{{ $product->brand ?: 'Академия Бариста' }}</b>
                            </span>
                        @endif

                        @if ($product->gallery)
                            <ul class="ab-product__thumbs">
                                @foreach ($product->gallery as $shot)
                                    <li><img src="{{ $shot }}" alt="{{ $product->title }}"
                                             width="120" height="90" loading="lazy"></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="ab-product__body">
                        @if ($product->brand)
                            <span class="ab-shop__brand">{{ $product->brand }}</span>
                        @endif

                        <h1 class="ab-product__title">{{ $product->title }}</h1>

                        {{-- Цветовые исполнения одной модели --}}
                        @if ($variants->count() > 1)
                            <div class="ab-product__colors">
                                <span class="ab-product__colors-label">
                                    Исполнение: <b>{{ $product->color }}</b>
                                </span>
                                <ul class="ab-product__colors-list">
                                    @foreach ($variants as $v)
                                        <li>
                                            @if ($v->id === $product->id)
                                                <span class="ab-product__color is-active">{{ $v->color }}</span>
                                            @else
                                                <a class="ab-product__color" href="{{ $v->url }}">{{ $v->color }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($product->summary)
                            <p class="ab-lead">{{ $product->summary }}</p>
                        @endif

                        <div class="ab-product__pricebox">
                            <div class="ab-product__price">
                                <b>{{ $product->price_label }}</b>
                                @if ($product->old_price_label)
                                    <s>{{ $product->old_price_label }}</s>
                                @endif
                            </div>
                            <span class="ab-shop__stock ab-shop__stock--{{ $product->availability }}">
                                {{ $product->availability_label }}
                                @if ($product->stock)
                                    — {{ $product->stock }} шт.
                                @endif
                            </span>
                        </div>

                        <div class="ab-product__actions">
                            <button class="ab-btn ab-btn--primary ab-btn--lg js-open-modal" type="button"
                                    data-modal-path="consultation">Оставить заявку</button>
                            <a class="ab-btn ab-btn--outline ab-btn--lg"
                               href="{{ config('nav.contacts.phone_href') }}">{{ config('nav.contacts.phone') }}</a>
                        </div>

                        @if ($product->sku)
                            <p class="ab-product__sku">Артикул: {{ $product->sku }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @if ($product->description || $product->specs)
            <section class="ab-product__details">
                <div class="ab-container">
                    <div class="ab-product__details-grid">
                        @if ($product->description)
                            <div>
                                <h2 class="ab-h2">Описание</h2>
                                <p class="ab-product__text">{{ $product->description }}</p>
                            </div>
                        @endif

                        @if ($product->specs)
                            <div>
                                <h2 class="ab-h2">Характеристики</h2>
                                <dl class="ab-product__specs">
                                    @foreach ($product->specs as $row)
                                        <div>
                                            <dt>{{ $row[0] }}</dt>
                                            <dd>{{ $row[1] }}</dd>
                                        </div>
                                    @endforeach
                                </dl>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        {{-- Заявка именно по этому товару: в Telegram придёт название позиции --}}
        <section class="ab-product__order">
            <div class="ab-container">
                <div class="ab-product__order-inner">
                    <div>
                        <h2 class="ab-h2 ab-h2--light">Нужен расчёт под вашу кофейню?</h2>
                        <p class="ab-product__order-note">
                            Подберём конфигурацию, посчитаем доставку и подключение,
                            обучим персонал работе на оборудовании.
                        </p>
                    </div>

                    <form class="ab-lead-form" method="post" action="/lead">
                        @csrf
                        @include('partials.form-guard')

                        <input type="hidden" name="source" value="Товар: {{ $product->title }}">
                        <input type="hidden" name="page" value="{{ $product->url }}">

                        <label class="ab-lead-form__field">
                            <span class="ab-lead-form__label">Как вас зовут</span>
                            <input type="text" name="name" placeholder="Имя" required autocomplete="name">
                        </label>

                        <label class="ab-lead-form__field">
                            <span class="ab-lead-form__label">Телефон для связи</span>
                            <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required autocomplete="tel">
                        </label>

                        <button class="ab-btn ab-btn--primary ab-btn--block ab-btn--lg" type="submit">
                            Получить расчёт
                        </button>

                        <p class="ab-lead-form__note">
                            Нажимая кнопку, вы соглашаетесь с
                            <a href="/privacy-policy.html">политикой конфиденциальности</a>
                        </p>
                    </form>
                </div>
            </div>
        </section>

        @if ($similar->isNotEmpty())
            <section class="ab-shop ab-shop--similar">
                <div class="ab-container">
                    <h2 class="ab-h2">Похожие позиции</h2>
                    <ul class="ab-shop__grid">
                        @foreach ($similar as $p)
                            {{-- Та же карточка, что в каталоге: кликается целиком --}}
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
                                    <h3 class="ab-shop__name">
                                        <a class="ab-shop__link" href="{{ $p->url }}">{{ $p->title }}</a>
                                    </h3>
                                    <div class="ab-shop__foot">
                                        <div class="ab-shop__price">
                                            <b>{{ $p->price_label }}</b>
                                            <span class="ab-shop__stock ab-shop__stock--{{ $p->availability }}">
                                                {{ $p->availability_label }}
                                            </span>
                                        </div>
                                        <span class="ab-shop__more" aria-hidden="true">Подробнее</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif
    </main>

    @include('partials.site.footer')
</div>
@endsection
