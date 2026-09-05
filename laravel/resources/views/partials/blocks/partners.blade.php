@php
    // Логотипы берём из исходной секции партнёров сайта (data:-изображения).
    $logos = config('home.partners.items');
@endphp

<section class="ab-partners ab-reveal">
    <div class="ab-container">
        <h2 class="ab-h2">Наши партнёры</h2>
        <p class="ab-lead">
            Учим на профессиональном оборудовании и премиальных ингредиентах —
            тех же, с которыми вы встретитесь на реальной работе.
        </p>
    </div>

    {{-- Бесконечная лента: дублируем список, чтобы прокрутка была без стыка --}}
    <div class="ab-marquee">
        <div class="ab-marquee__track">
            @foreach (array_merge($logos, $logos) as $logo)
                <div class="ab-marquee__item">
                    <img src="{{ $logo['src'] }}" alt="{{ $logo['alt'] }}" loading="lazy" width="150" height="50">
                </div>
            @endforeach
        </div>
    </div>
</section>
