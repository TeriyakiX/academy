@php
    /*
     | Путь от новичка до управляющего.
     |
     | В каталоге тринадцать программ, и человеку со стороны непонятно,
     | с чего начинать и чем курсы отличаются. Здесь они выстроены в
     | порядке роста: длительность и цена берутся из каталога, поэтому
     | блок не расходится с карточками.
     */
    /* Ступени — про курсы бариста: на странице мастер-классов
       или барного дела блок не показываем. */
    $hasBarista = array_key_exists('Курсы бариста', $catalog['schools'] ?? config('courses.schools'));

    $byId = collect(config('courses.schools'))
        ->flatMap(fn ($list) => $list)
        ->keyBy('id');

    $steps = collect(config('courses.path', []))
        ->map(fn ($step) => $step + ($byId[$step['id']] ?? []))
        ->filter(fn ($step) => !empty($step['url']))
        ->values();
@endphp

@if ($hasBarista && $steps->count() > 1)
    <section class="ab-path ab-reveal">
        <div class="ab-container">
            <div class="ab-path__head">
                <div>
                    <h2 class="ab-h2">С чего начать и куда расти</h2>
                    <p class="ab-lead">
                        Программы идут ступенями: каждая следующая опирается на предыдущую.
                        Начать можно с любой, но так путь короче.
                    </p>
                </div>

                @if (!empty(config('courses.path_note')))
                    <p class="ab-path__note">{{ config('courses.path_note') }}</p>
                @endif
            </div>

            <ol class="ab-path__list">
                @foreach ($steps as $i => $step)
                    <li class="ab-path__step">
                        <span class="ab-path__n">{{ $i + 1 }}</span>

                        <h3 class="ab-path__title">
                            <a href="{{ $step['url'] }}">{{ $step['title'] }}</a>
                        </h3>

                        <p class="ab-path__text">{{ $step['note'] }}</p>

                        <span class="ab-path__meta">
                            @if (!empty($step['duration'])) <span>{{ $step['duration'] }}</span> @endif
                            @if (!empty($step['price'])) <b>{{ number_format($step['price'], 0, ',', ' ') }} ₽</b> @endif
                        </span>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>
@endif
