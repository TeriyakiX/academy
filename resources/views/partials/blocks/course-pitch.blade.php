@php $pitch = $course['pitch'] ?? null; @endphp

{{--
    О курсе. Слева — вопросы, справа открывается ответ на выбранный.
    Переключение без скриптов: радиокнопки плюс :has().
--}}
@if ($pitch)
    @php
        $limits = $pitch['limits'] ?? null;

        $tabs = array_values(array_filter([
            ['title' => 'Зачем этот курс',    'text'  => $pitch['why'] ?? null],
            ['title' => 'Кому подойдёт',      'text'  => $pitch['who'] ?? null],
            ['title' => 'Что будет на курсе', 'list'  => $pitch['inside'] ?? null],
            ['title' => 'Как идёт занятие',   'steps' => $pitch['how'] ?? null],
            ['title' => 'С чем уйдёте',       'list'  => $pitch['takeaways'] ?? null],
        ], fn ($t) => !empty($t['text']) || !empty($t['list']) || !empty($t['steps'])));
    @endphp

    @if ($tabs)
        <section class="ab-cwhy ab-reveal">
            <div class="ab-container">
                <div class="ab-cwhy__tabs">
                    @foreach ($tabs as $i => $tab)
                        <input class="ab-cwhy__radio" type="radio" name="ab-cwhy"
                               id="ab-cwhy-{{ $i }}" @if ($i === 0) checked @endif>
                    @endforeach

                    <div class="ab-cwhy__list">
                        @foreach ($tabs as $i => $tab)
                            <label class="ab-cwhy__q" for="ab-cwhy-{{ $i }}">
                                <span>{{ $tab['title'] }}</span>
                            </label>
                        @endforeach

                        @if ($limits)
                            <p class="ab-cwhy__limits"><b>Чего не будет.</b> {{ $limits }}</p>
                        @endif
                    </div>

                    <div class="ab-cwhy__windows">
                        @foreach ($tabs as $i => $tab)
                            <div class="ab-cwhy__win" data-tab="{{ $i }}">
                                <h3 class="ab-cwhy__win-title">{{ $tab['title'] }}</h3>

                                @if (!empty($tab['text']))
                                    <p class="ab-cwhy__text">{{ $tab['text'] }}</p>
                                @elseif (!empty($tab['list']))
                                    <ul class="ab-cwhy__inside">
                                        @foreach ($tab['list'] as $n => $item)
                                            <li style="--i: {{ $n }}">
                                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12 5 5L19 8" /></svg>
                                                {{ $item }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ol class="ab-cwhy__steps">
                                        @foreach ($tab['steps'] as $n => $item)
                                            <li style="--i: {{ $n }}"><span>{{ $n + 1 }}</span>{{ $item }}</li>
                                        @endforeach
                                    </ol>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif
