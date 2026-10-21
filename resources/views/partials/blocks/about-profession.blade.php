{{--
    Профессия бариста: куда можно расти.

    Блок предложен заказчиком (октябрь 2026). Говорим о возможностях,
    а не о заработке и трудоустройстве: гарантий по ним школа не даёт.
--}}
@php
    $block = config('home.about_profession');
@endphp

<section class="ab-aprof ab-reveal">
    <div class="ab-container">
        <h2 class="ab-h2">{{ $block['title'] }}</h2>
        <p class="ab-lead">{{ $block['lead'] }}</p>

        <div class="ab-aprof__grid">
            @foreach ($block['items'] as $card)
                <article>
                    <h3>{{ $card['title'] }}</h3>
                    <p>{{ $card['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
