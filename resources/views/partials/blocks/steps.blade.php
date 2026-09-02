@php $s = config('home.steps'); @endphp

<section class="ab-steps ab-reveal">
    <div class="ab-container">
        <h2 class="ab-h2">{{ $s['title'] }}</h2>
        <p class="ab-lead">{{ $s['lead'] }}</p>

        <ol class="ab-steps__list">
            @foreach ($s['items'] as $item)
                <li class="ab-steps__item">
                    <span class="ab-steps__n">{{ $item['n'] }}</span>
                    <h3 class="ab-steps__title">{{ $item['title'] }}</h3>
                    <p class="ab-steps__text">{{ $item['text'] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
