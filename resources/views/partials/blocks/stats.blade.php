@php $s = config('home.stats'); @endphp

<section class="ab-stats ab-reveal">
    <div class="ab-container">
        <div class="ab-stats__head">
            <h2 class="ab-h2 ab-h2--light">{{ $s['title'] }}</h2>
            <p class="ab-stats__lead">{{ $s['lead'] }}</p>
        </div>

        <div data-island="StatsCounter"
             data-props="{{ json_encode(['items' => $s['items']], JSON_UNESCAPED_UNICODE) }}"></div>

        {{-- Оценки на внешних площадках --}}
        <ul class="ab-stats__ratings">
            @foreach (config('home.ratings.items') as $r)
                <li>
                    @if ($r['href'])
                        <a href="{{ $r['href'] }}" target="_blank" rel="noopener">
                    @else
                        <div>
                    @endif
                        <span class="ab-stats__rating-name">{{ $r['title'] }}</span>
                        <span class="ab-stats__rating-count">{{ $r['count'] }}</span>
                        <b class="ab-stats__rating-score">{{ $r['score'] }}</b>
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
