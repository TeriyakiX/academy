@php $pitch = $course['pitch'] ?? null; @endphp

{{--
    «Зачем и кому» — раскрывающиеся строки после шапки.

    Содержимое приходит из методички курса: коротко о курсе, для кого,
    что будет на занятиях, что участник уносит с собой, что не входит
    в программу и как устроено обучение. Открыт только первый ответ.
--}}
@if ($pitch)
    @php
        $rows = array_values(array_filter([
            ['title' => 'Зачем этот курс',       'text' => $pitch['why'] ?? null],
            ['title' => 'Кому подойдёт',          'text' => $pitch['who'] ?? null],
            ['title' => 'Что будет на курсе',     'list' => $pitch['inside'] ?? null],
            ['title' => 'Что вы унесёте с собой', 'list' => $pitch['takeaways'] ?? null],
            ['title' => 'Что не входит в курс',   'text' => $pitch['limits'] ?? null],
            ['title' => 'Как проходит обучение',  'list' => $pitch['how'] ?? null],
        ], fn ($row) => !empty($row['text']) || !empty($row['list'])));
    @endphp

    @if ($rows)
        <section class="ab-cwhy ab-reveal">
            <div class="ab-container">
                <div class="ab-cwhy__list">
                    @foreach ($rows as $i => $row)
                        <details class="ab-cwhy__item" @if ($i === 0) open @endif>
                            <summary>{{ $row['title'] }}</summary>

                            @if (!empty($row['text']))
                                <p class="ab-cwhy__text">{{ $row['text'] }}</p>
                            @else
                                <ul class="ab-cwhy__points">
                                    @foreach ($row['list'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endif
