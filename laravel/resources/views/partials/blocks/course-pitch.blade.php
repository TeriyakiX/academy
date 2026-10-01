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

                        @if ($limits)
                            <p class="ab-cwhy__limits"><b>Чего не будет.</b> {{ $limits }}</p>
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

                        @if ($how || $takeaways)
                            {{-- Остальное — по запросу: на экране и так много текста. --}}
                            <details class="ab-cwhy__more">
                                <summary>Как проходит занятие и что останется после</summary>

                                @if ($how)
                                    <ol class="ab-cwhy__steps">
                                        @foreach ($how as $n => $item)
                                            <li style="--i: {{ $n }}"><span>{{ $n + 1 }}</span>{{ $item }}</li>
                                        @endforeach
                                    </ol>
                                @endif

                                @if ($takeaways)
                                    <p class="ab-cwhy__take-title">С чем уйдёте</p>
                                    <ul class="ab-cwhy__take-list">
                                        @foreach ($takeaways as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </details>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif
