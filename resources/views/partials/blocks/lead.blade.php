@php
    /* Блок используется на разных страницах, поэтому тексты можно
       передать при подключении: @include('partials.blocks.lead', [...]). */
    $title   = $title   ?? 'Если не знаете, с чего начать';
    $note    = $note    ?? 'Расскажем об обучении, ответим на вопросы и подберём программу под вашу цель и уровень.';
    $points  = $points  ?? [
        'Подберём программу под ваш опыт',
        'Расскажем про даты и свободные места',
        'Посчитаем стоимость со скидкой за объём',
    ];
    $action  = $action  ?? 'Подобрать курс';
    $source  = $source  ?? 'Блок «Если не знаете, с чего начать»';
@endphp

<section class="ab-lead-block ab-reveal">
    <div class="ab-container">
        <div class="ab-lead-block__inner">

            <div class="ab-lead-block__text">
                <h2 class="ab-h2 ab-h2--light">{{ $title }}</h2>
                <p class="ab-lead-block__promise">Оставьте заявку — свяжемся с вами <span>в течение рабочего дня</span></p>
                <p class="ab-lead-block__note">{{ $note }}</p>

                <ul class="ab-lead-block__list">
                    @foreach ($points as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>

                <a class="ab-lead-block__phone" href="{{ config('nav.contacts.phone_href') }}">
                    {{ config('nav.contacts.phone') }}
                    <span>{{ config('nav.contacts.hours') }}</span>
                </a>
            </div>

            <form class="ab-lead-form" method="post" action="/lead">
                @csrf
                @include('partials.form-guard')

                <input type="hidden" name="source" value="{{ $source }}">

                <label class="ab-lead-form__field">
                    <span class="ab-lead-form__label">Как вас зовут</span>
                    <input type="text" name="name" placeholder="Имя" required autocomplete="name">
                </label>

                <label class="ab-lead-form__field">
                    <span class="ab-lead-form__label">Телефон для связи</span>
                    <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required autocomplete="tel">
                </label>

                <button class="ab-btn ab-btn--primary ab-btn--block ab-btn--lg" type="submit">
                    {{ $action }}
                </button>

                <p class="ab-lead-form__note">
                    Нажимая кнопку, вы соглашаетесь с
                    <a href="/privacy-policy.html">политикой конфиденциальности</a>
                </p>
            </form>

        </div>
    </div>
</section>
