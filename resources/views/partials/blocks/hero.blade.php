@php $h = config('home.hero'); @endphp

<section class="ab-hero">
    <div class="ab-container">
        <div class="ab-hero__grid">

            <div class="ab-hero__main">
                <h1 class="ab-hero__title">{{ $h['title'] }}</h1>
                <p class="ab-hero__text">{{ $h['text'] }}</p>

                <ul class="ab-hero__facts">
                    @foreach ($h['facts'] as $fact)
                        <li>
                            <svg class="ab-hero__check" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="m5 12 5 5L19 8" fill="none" stroke="currentColor"
                                      stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $fact }}
                        </li>
                    @endforeach
                </ul>

                <div class="ab-hero__actions">
                    <button class="ab-btn ab-btn--primary ab-btn--lg" type="button" data-modal-path="consultation">
                        Оставить заявку
                    </button>
                    <a class="ab-btn ab-btn--outline ab-btn--lg" href="/constructor.html">Собрать свой курс</a>
                </div>
            </div>

            {{-- Направления с живым фото --}}
            <div class="ab-hero__side"
                 data-island="HeroDirections"
                 data-props="{{ json_encode(['directions' => $h['directions']], JSON_UNESCAPED_UNICODE) }}"></div>

        </div>

        {{-- Оценки на площадках --}}
        <ul class="ab-hero__ratings">
            @foreach (config('home.ratings.items') as $r)
                <li>
                    @if ($r['href'])
                        <a href="{{ $r['href'] }}" target="_blank" rel="noopener">
                    @else
                        <div>
                    @endif
                        <span class="ab-hero__rating-name">{{ $r['title'] }}</span>
                        <span class="ab-hero__rating-count">{{ $r['count'] }}</span>
                        <b class="ab-hero__rating-score">{{ $r['score'] }}</b>
                    @if ($r['href'])
                        </a>
                    @else
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</section>
