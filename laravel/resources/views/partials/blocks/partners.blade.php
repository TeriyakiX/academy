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

        {{-- Что именно за чем стоит: по просьбе заказчика рядом с логотипами
             поясняем, для чего каждая группа партнёров нужна на занятии. --}}
        @if (!empty($withRoles))
            <ul class="ab-partners__roles">
                <li><b>Carimali, Elektra</b><span>Кофемашины и кофемолки для практики</span></li>
                <li><b>Gravitas, Tasty Coffee</b><span>Зерно для настройки и работы со вкусом</span></li>
                <li><b>Pinch Drop</b><span>Сиропы и ингредиенты для напитков</span></li>
                <li><b>Petmol</b><span>Молоко для отработки молочных напитков</span></li>
            </ul>
        @endif
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
