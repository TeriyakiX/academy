@php $pitch = $course['pitch'] ?? null; @endphp

{{--
    О курсе. Слева — зачем он нужен и кому подойдёт, справа — окна
    с содержанием: что будет на курсе, как идёт занятие, что останется
    после. Окна раскрываются, чтобы блок не был простынёй текста.
--}}
@if ($pitch)
    @php
        $why       = $pitch['why'] ?? null;
        $who       = $pitch['who'] ?? null;
        $inside    = $pitch['inside'] ?? null;
        $takeaways = $pitch['takeaways'] ?? null;
        $how       = $pitch['how'] ?? null;
        $limits    = $pitch['limits'] ?? null;

        /* «3 темы», «5 шагов», «4 пункта» — подпись к окну. */
        $plural = function (int $n, array $forms) {
            $mod100 = $n % 100;
            $mod10 = $n % 10;
            if ($mod100 >= 11 && $mod100 <= 14) return $forms[2];
            if ($mod10 === 1) return $forms[0];
            if ($mod10 >= 2 && $mod10 <= 4) return $forms[1];
            return $forms[2];
        };
    @endphp

    @if ($why || $who || $inside || $takeaways || $how || $limits)
        <section class="ab-cwhy ab-reveal">
            <div class="ab-container">
                <div class="ab-cwhy__layout">
                    {{-- Слева: зачем и кому. --}}
                    <div class="ab-cwhy__side">
                        @if ($why)
                            <div class="ab-cwhy__why">
                                <span class="ab-cwhy__eyebrow">Зачем этот курс</span>
                                <p>{{ $why }}</p>
                            </div>
                        @endif

                        @if ($who)
                            <div class="ab-cwhy__who">
                                <span class="ab-cwhy__eyebrow">Кому подойдёт</span>
                                <p>{{ $who }}</p>
                            </div>
                        @endif

                        @if ($limits)
                            <p class="ab-cwhy__limits"><b>Чего не будет.</b> {{ $limits }}</p>
                        @endif
                    </div>

                    {{-- Справа: окна с содержанием. --}}
                    <div class="ab-cwhy__main">
                        @if ($inside)
                            <details class="ab-cwhy__win" open>
                                <summary>
                                    <b>Что будет на курсе</b>
                                    <span>{{ count($inside) }} {{ $plural(count($inside), ['тема', 'темы', 'тем']) }}</span>
                                </summary>

                                <ul class="ab-cwhy__inside">
                                    @foreach ($inside as $n => $item)
                                        <li style="--i: {{ $n }}">
                                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12 5 5L19 8" /></svg>
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            </details>
                        @endif

                        @if ($how)
                            <details class="ab-cwhy__win">
                                <summary>
                                    <b>Как идёт занятие</b>
                                    <span>{{ count($how) }} {{ $plural(count($how), ['шаг', 'шага', 'шагов']) }}</span>
                                </summary>

                                <ol class="ab-cwhy__steps">
                                    @foreach ($how as $n => $item)
                                        <li style="--i: {{ $n }}"><span>{{ $n + 1 }}</span>{{ $item }}</li>
                                    @endforeach
                                </ol>
                            </details>
                        @endif

                        @if ($takeaways)
                            <details class="ab-cwhy__win">
                                <summary>
                                    <b>С чем уйдёте</b>
                                    <span>{{ count($takeaways) }} {{ $plural(count($takeaways), ['пункт', 'пункта', 'пунктов']) }}</span>
                                </summary>

                                <ul class="ab-cwhy__take-list">
                                    @foreach ($takeaways as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </details>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif
