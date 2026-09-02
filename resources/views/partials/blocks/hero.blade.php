@php $h = config('home.hero'); @endphp

<section class="ab-hero">
    <div class="ab-container">

        {{-- Вкладки направлений: человек сразу выбирает, зачем пришёл --}}
        <nav class="ab-hero__dirs" aria-label="Направления обучения">
            @foreach ($h['directions'] as $d)
                <a class="ab-hero__dir" href="{{ $d['href'] }}">{{ $d['title'] }}</a>
            @endforeach
        </nav>

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
                    <button class="ab-btn ab-btn--primary ab-btn--lg js-open-modal" type="button" data-modal-path="consultation">
                        Оставить заявку
                    </button>
                    <a class="ab-btn ab-btn--ghost-light ab-btn--lg" href="/constructor.html">Собрать свой курс</a>
                </div>
            </div>

            {{-- Карточка с тем, что получает ученик --}}
            <aside class="ab-hero__card">
                <h2 class="ab-hero__card-title">{{ $h['card']['title'] }}</h2>
                <ul class="ab-hero__card-list">
                    @foreach ($h['card']['items'] as $item)
                        <li>
                            <strong>{{ $item['title'] }}</strong>
                            <span>{{ $item['text'] }}</span>
                        </li>
                    @endforeach
                </ul>
                <a class="ab-hero__card-link" href="{{ $h['card']['href'] }}">{{ $h['card']['link'] }} &rarr;</a>
            </aside>
        </div>

        {{-- Оценки площадок --}}
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
