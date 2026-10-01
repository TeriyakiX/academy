@php $pitch = $course['pitch'] ?? null; @endphp

{{--
    Что за курс. Раньше это были одинаковые серые плитки — читалось как
    анкета. Теперь у каждого куска своя подача: «для кого» — тёмная плашка,
    «что внутри» — список с галочками, «как идёт занятие» — шаги с линией,
    «чего не будет» — приглушённая сноска.
--}}
@if ($pitch)
    @php
        $why       = $pitch['why'] ?? null;
        $who       = $pitch['who'] ?? null;
        $inside    = $pitch['inside'] ?? null;
        $takeaways = $pitch['takeaways'] ?? null;
        $how       = $pitch['how'] ?? null;
        $limits    = $pitch['limits'] ?? null;
    @endphp

    @if ($why || $who || $inside || $takeaways || $how || $limits)
        <section class="ab-cwhy ab-reveal">
            <div class="ab-container">
                @if ($why)
                    <p class="ab-cwhy__big">{{ $why }}</p>
                @endif

                <div class="ab-cwhy__layout">
                    <div class="ab-cwhy__side">
                        @if ($who)
                            <div class="ab-cwhy__who">
                                <span class="ab-cwhy__eyebrow">Для кого</span>
                                <p>{{ $who }}</p>
                            </div>
                        @endif

                        @if ($takeaways)
                            <div class="ab-cwhy__take">
                                <span class="ab-cwhy__eyebrow">С чем уйдёте</span>
                                <ul>
                                    @foreach ($takeaways as $n => $item)
                                        <li style="--i: {{ $n }}">{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($limits)
                            <p class="ab-cwhy__limits">
                                <b>Чего не будет.</b> {{ $limits }}
                            </p>
                        @endif
                    </div>

                    <div class="ab-cwhy__main">
                        @if ($inside)
                            <h3 class="ab-cwhy__h">Что внутри</h3>
                            <ul class="ab-cwhy__inside">
                                @foreach ($inside as $n => $item)
                                    <li style="--i: {{ $n }}">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12 5 5L19 8" /></svg>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if ($how)
                            <h3 class="ab-cwhy__h">Как идёт занятие</h3>
                            <ol class="ab-cwhy__steps">
                                @foreach ($how as $n => $item)
                                    <li style="--i: {{ $n }}"><span>{{ $n + 1 }}</span>{{ $item }}</li>
                                @endforeach
                            </ol>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif
