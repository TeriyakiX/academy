@php
    $h = config('home.hero');
    $teachers = config('home.teachers.items');
@endphp

<section class="ab-hero">

    <div class="ab-container">
        <div class="ab-hero__grid">

            <div class="ab-hero__main">
                <span class="ab-hero__badge ab-in" style="--d:0s">Набор открыт · Москва</span>

                <h1 class="ab-hero__title ab-in" style="--d:.06s">{!! $h['title_html'] ?? e($h['title']) !!}</h1>

                <p class="ab-hero__text ab-in" style="--d:.12s">{{ $h['text'] }}</p>

                <ul class="ab-hero__facts ab-in" style="--d:.18s">
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

                <div class="ab-hero__actions ab-in" style="--d:.24s">
                    <button class="ab-btn ab-btn--primary ab-btn--lg" type="button" data-modal-path="consultation">
                        Оставить заявку
                    </button>
                    <a class="ab-btn ab-btn--outline ab-btn--lg" href="/courses.html">Выбрать курс</a>
                </div>

                {{-- Соцдоказательство: лица тренеров и телефон --}}
                <div class="ab-hero__proof ab-in" style="--d:.3s">
                    <div class="ab-hero__faces">
                        @foreach ($teachers as $t)
                            <img src="{{ $t['photo'] }}" alt="{{ $t['name'] }}" width="44" height="44" loading="lazy">
                        @endforeach
                    </div>
                    <p class="ab-hero__proof-text">
                        <strong>1000+ учеников</strong> уже прошли обучение<br>
                        у практикующих тренеров школы
                    </p>
                    <a class="ab-hero__phone" href="{{ config('nav.contacts.phone_href') }}">
                        {{ config('nav.contacts.phone') }}
                        <span>{{ config('nav.contacts.hours') }}</span>
                    </a>
                </div>
            </div>

            {{-- Направления с живым фото --}}
            <div class="ab-hero__side ab-in" style="--d:.16s"
                 data-island="HeroDirections"
                 data-props="{{ json_encode(['directions' => $h['directions']], JSON_UNESCAPED_UNICODE) }}"></div>

        </div>
    </div>
</section>
