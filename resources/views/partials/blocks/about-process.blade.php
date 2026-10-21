{{--
    Как проходит занятие — четыре шага.

    Структура и формулировки предложены заказчиком (октябрь 2026).
    Те же четыре шага повторяются в методичках в разделе
    «Как проходит обучение», поэтому они верны для всех программ.
--}}
@php
    $block = config('home.about_process');
@endphp

<section class="ab-aprocess ab-reveal">
    <div class="ab-container">
        <h2 class="ab-h2">{{ $block['title'] }}</h2>
        <p class="ab-lead">{{ $block['lead'] }}</p>

        <ol class="ab-aprocess__grid">
            @foreach ($block['items'] as $i => $step)
                <li>
                    <b class="ab-aprocess__n">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</b>
                    <h3>{{ $step['title'] }}</h3>
                    <p>{{ $step['text'] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
