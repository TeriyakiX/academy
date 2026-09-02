@php $r = config('home.reasons'); @endphp

<section class="ab-reasons ab-reveal">
    <div class="ab-container">
        <div class="ab-reasons__grid">
            <div class="ab-reasons__intro">
                <h2 class="ab-h2">{{ $r['title'] }}</h2>
                <p class="ab-lead">{{ $r['lead'] }}</p>
                <a class="ab-btn ab-btn--primary" href="/courses.html">Выбрать курс</a>
            </div>

            <ul class="ab-reasons__list">
                @foreach ($r['items'] as $i => $item)
                    <li class="ab-reasons__item">
                        <span class="ab-reasons__n">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="ab-reasons__title">{{ $item['title'] }}</h3>
                            <p class="ab-reasons__text">{{ $item['text'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
