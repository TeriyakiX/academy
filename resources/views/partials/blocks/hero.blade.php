@php $h = config('home.hero'); @endphp

<section class="ab-hero">
    <div class="ab-container">
        <div class="ab-hero__grid">

            <div class="ab-hero__main">
                <span class="ab-hero__badge">Набор открыт · Москва</span>

                <h1 class="ab-hero__title">{{ $h['title'] }}</h1>
                <p class="ab-hero__text">{{ $h['text'] }}</p>

                <ul class="ab-hero__facts">
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

                <div class="ab-hero__actions">
                    <button class="ab-btn ab-btn--primary ab-btn--lg" type="button" data-modal-path="consultation">
                        Подобрать курс
                    </button>
                    <a class="ab-btn ab-btn--outline ab-btn--lg" href="/constructor.html">Собрать свой курс</a>

                    <a class="ab-hero__phone" href="{{ config('nav.contacts.phone_href') }}">
                        {{ config('nav.contacts.phone') }}
                        <span>{{ config('nav.contacts.hours') }}</span>
                    </a>
                </div>
            </div>

            {{-- Направления с живым фото --}}
            <div class="ab-hero__side"
                 data-island="HeroDirections"
                 data-props="{{ json_encode(['directions' => $h['directions']], JSON_UNESCAPED_UNICODE) }}"></div>

        </div>
    </div>
</section>
