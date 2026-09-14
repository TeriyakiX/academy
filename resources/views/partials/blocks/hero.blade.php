@php
    $h = config('home.hero');
    $schools = config('courses.schools');

    /* «от …» берём из реальных цен программ направления, а не придумываем. */
    $priceFrom = function (?string $school) use ($schools) {
        $prices = collect($schools[$school] ?? [])->pluck('price')->filter();

        return $prices->isNotEmpty() ? $prices->min() : null;
    };
@endphp

<section class="ab-hero">
    {{-- Фото занимает весь первый экран: это школа, а не текстовая страница. --}}
    <div class="ab-hero__bg" aria-hidden="true">
        <img src="{{ $h['directions'][0]['photo'] }}" alt="" width="1600" height="900"
             fetchpriority="high" decoding="async">
    </div>

    <div class="ab-container">
        <div class="ab-hero__grid">
            <div class="ab-hero__main">
                <span class="ab-hero__kicker ab-in" style="--d:.04s">Академия Бариста · Москва</span>

                <h1 class="ab-hero__title ab-in" style="--d:.08s">{!! $h['title_html'] ?? e($h['title']) !!}</h1>

                <p class="ab-hero__text ab-in" style="--d:.14s">{{ $h['text'] }}</p>

                <ul class="ab-hero__facts ab-in" style="--d:.2s">
                    @foreach ($h['facts'] as $fact)
                        <li>
                            <svg class="ab-hero__check" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="m5 12 5 5L19 8" fill="none" stroke="currentColor"
                                      stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $fact }}
                        </li>
                    @endforeach
                </ul>

                {{-- Направления с ценой: человек сразу видит, что здесь есть
                     и сколько стоит, без переключений и раскрытий. --}}
                <ul class="ab-hero__dirs ab-in" style="--d:.26s">
                    @foreach ($h['directions'] as $d)
                        @php $from = $priceFrom($d['school'] ?? null); @endphp

                        <li>
                            <a class="ab-hero__dir" href="{{ $d['href'] }}">
                                <b>{{ $d['short'] }}</b>
                                <i>{{ $from ? 'от ' . number_format($from, 0, '', ' ') . ' ₽' : 'по запросу' }}</i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Заявка прямо в первом экране: раньше до неё надо было
                 пролистать всю страницу. Полей два — чем короче форма,
                 тем чаще её дозаполняют. --}}
            <form class="ab-hero__form ab-in" style="--d:.3s" method="post" action="/lead">
                @csrf
                @include('partials.form-guard')

                <input type="hidden" name="source" value="Первый экран">
                <input type="hidden" name="page" value="{{ request()->getPathInfo() }}">

                <span class="ab-hero__form-badge">Ответим в течение рабочего дня</span>

                <b class="ab-hero__form-title">Подберём программу</b>
                <p class="ab-hero__form-note">
                    Оставьте номер — перезвоним, расскажем про даты, места и стоимость.
                </p>

                <label class="ab-hero__field">
                    <span>Как вас зовут</span>
                    <input type="text" name="name" placeholder="Имя" required autocomplete="name">
                </label>

                <label class="ab-hero__field">
                    <span>Телефон</span>
                    <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required autocomplete="tel">
                </label>

                <button class="ab-btn ab-btn--primary ab-btn--block ab-btn--lg" type="submit">
                    Оставить заявку
                </button>

                {{-- Кому удобнее позвонить самому — пусть звонит, а не ищет номер. --}}
                <a class="ab-hero__form-phone" href="{{ config('nav.contacts.phone_href') }}">
                    {{ config('nav.contacts.phone') }}
                    <i>{{ config('nav.contacts.hours') }}</i>
                </a>

                <p class="ab-hero__form-legal">
                    Нажимая кнопку, вы соглашаетесь с
                    <a href="/privacy-policy.html">политикой конфиденциальности</a>
                </p>
            </form>
        </div>
    </div>
</section>
