@php $r = config('home.reasons'); @endphp

<section class="ab-reasons ab-reveal">
    <div class="ab-container">
        <h2 class="ab-h2">{{ $r['title'] }}</h2>
        <p class="ab-lead">{{ $r['lead'] }}</p>

        <ul class="ab-reasons__list">
            @foreach ($r['items'] as $i => $item)
                <li class="ab-reasons__item">
                    <span class="ab-reasons__n">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="ab-reasons__title">{{ $item['title'] }}</h3>
                    <p class="ab-reasons__text">{{ $item['text'] }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
