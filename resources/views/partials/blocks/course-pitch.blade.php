@php $pitch = $course['pitch'] ?? null; @endphp

{{--
    Что за курс: вступление и карточки.

    Содержимое приходит из методички курса. Раньше это были строки-вопросы
    с раскрытием («Кому подойдёт», «Что будет на курсе») — читалось как
    анкета. Теперь вступление идёт текстом, остальное — карточками.
--}}
@if ($pitch)
    @php
        $why = $pitch['why'] ?? null;

        $cards = array_values(array_filter([
            ['title' => 'Для кого',        'icon' => 'для кого',    'text' => $pitch['who'] ?? null],
            ['title' => 'Что внутри',      'icon' => 'что будет',   'list' => $pitch['inside'] ?? null],
            ['title' => 'С чем уйдёте',    'icon' => 'унесёт',      'list' => $pitch['takeaways'] ?? null],
            ['title' => 'Как идёт занятие','icon' => 'как проходит','list' => $pitch['how'] ?? null],
            ['title' => 'Чего не будет',   'icon' => 'не входит',   'text' => $pitch['limits'] ?? null],
        ], fn ($card) => !empty($card['text']) || !empty($card['list'])));
    @endphp

    @if ($why || $cards)
        <section class="ab-cwhy ab-reveal">
            <div class="ab-container">
                @if ($why)
                    <p class="ab-cwhy__big">{{ $why }}</p>
                @endif

                @if ($cards)
                    <div class="ab-cwhy__cards">
                        @foreach ($cards as $card)
                            <article class="ab-cwhy__card">
                                <span class="ab-cwhy__mark">
                                    @include('partials.icons.fact', ['key' => $card['icon']])
                                </span>
                                <h3 class="ab-cwhy__card-title">{{ $card['title'] }}</h3>

                                @if (!empty($card['text']))
                                    <p class="ab-cwhy__text">{{ $card['text'] }}</p>
                                @else
                                    <ul class="ab-cwhy__points">
                                        @foreach ($card['list'] as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif
@endif
