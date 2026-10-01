@php
    /*
     | Доверие в шапке курса: оценка на картах, две цифры школы и живой
     | отзыв. Это то, чего на странице больше нигде нет, — в отличие от
     | характеристик, которые дублировали сводку у программы.
     */
    $rating = config('home.ratings.items.0');
    $stats  = collect(config('home.stats.items', []))->take(2);

    /* Отзыв берём по направлению курса, иначе первый свежий. */
    $reviews = collect(config('home.reviews.items', []));
    $needle  = mb_strtolower($course['title'] ?? '');
    $review  = $reviews->first(function ($r) use ($needle) {
        $words = array_filter(explode(' ', $needle), fn ($w) => mb_strlen($w) > 5);
        foreach ($words as $w) {
            if (mb_stripos($r['text'] ?? '', $w) !== false) {
                return true;
            }
        }
        return false;
    }) ?? $reviews->first();
@endphp

@if ($rating || $stats->count())
    <div class="ab-trust ab-reveal">
        @if ($rating)
            <a class="ab-trust__rating" href="{{ $rating['href'] }}" target="_blank" rel="noopener nofollow">
                <b>{{ $rating['score'] }}</b>
                <span class="ab-trust__stars" aria-hidden="true">
                    @for ($i = 0; $i < 5; $i++)
                        <svg viewBox="0 0 24 24"><path d="m12 3 2.6 5.6 6.1.8-4.5 4.2 1.2 6L12 16.8 6.6 19.6l1.2-6L3.3 9.4l6.1-.8L12 3Z"/></svg>
                    @endfor
                </span>
                <i>{{ $rating['title'] }}, {{ $rating['count'] }}</i>
            </a>
        @endif

        @foreach ($stats as $i => $stat)
            <div class="ab-trust__stat" style="--i: {{ $i }}">
                <b>{{ $stat['value'] }}{{ $stat['suffix'] ?? '' }}</b>
                <span>{{ $stat['label'] }}</span>
            </div>
        @endforeach

        @if ($review)
            <figure class="ab-trust__quote">
                <blockquote>{{ \Illuminate\Support\Str::limit($review['text'], 150) }}</blockquote>
                <figcaption>{{ $review['name'] }}, выпускник</figcaption>
            </figure>
        @endif
    </div>
@endif
