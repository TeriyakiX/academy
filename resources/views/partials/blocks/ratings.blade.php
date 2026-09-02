<section class="ab-ratings ab-reveal">
    <div class="ab-container">
        <ul class="ab-ratings__list">
            @foreach (config('home.ratings.items') as $r)
                <li class="ab-rating">
                    @if ($r['href'])
                        <a class="ab-rating__link" href="{{ $r['href'] }}" target="_blank" rel="noopener">
                    @else
                        <div class="ab-rating__link">
                    @endif
                        <div class="ab-rating__info">
                            <span class="ab-rating__title">{{ $r['title'] }}</span>
                            <span class="ab-rating__count">{{ $r['count'] }}</span>
                        </div>
                        <span class="ab-rating__score">{{ $r['score'] }}</span>
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
