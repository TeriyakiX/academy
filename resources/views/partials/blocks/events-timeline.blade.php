{{-- Вариант «Лента времени»: вертикальная линия, даты точками.
     Видно последовательность: что было, что скоро, что потом. --}}
@php
    $today = now()->format('Y-m-d');
    $all   = \App\Support\Meetings::all()
        ->filter(fn ($e) => !empty($e['date']))
        ->sortBy('date')
        ->values();

    $showPast = request('past') === '1';
    $list = $showPast ? $all : $all->filter(fn ($e) => $e['date'] >= $today)->values();
    $pastCount = $all->filter(fn ($e) => $e['date'] < $today)->count();
@endphp

<div class="ab-tl">
    @if ($pastCount)
        <div class="ab-tl__switch">
            <a class="@if (!$showPast) is-active @endif" href="/events.html?v=f">Впереди</a>
            <a class="@if ($showPast) is-active @endif" href="/events.html?v=f&past=1">
                Показать и прошедшие <b>{{ $pastCount }}</b>
            </a>
        </div>
    @endif

    <ol class="ab-tl__line">
        @php $lastMonth = null; @endphp

        @foreach ($list as $e)
            @php
                $past = $e['date'] < $today;
                $monthName = \Illuminate\Support\Carbon::parse($e['date'])->locale('ru')->translatedFormat('F Y');
            @endphp

            @if ($monthName !== $lastMonth)
                <li class="ab-tl__month">{{ mb_convert_case($monthName, MB_CASE_TITLE, 'UTF-8') }}</li>
                @php $lastMonth = $monthName; @endphp
            @endif

            <li class="ab-tl__item @if ($past) is-past @endif">
                <span class="ab-tl__dot" aria-hidden="true"></span>

                <div class="ab-tl__date">
                    <b>{{ $e['day'] }}</b>
                    <span>{{ $e['month'] }}</span>
                    <em>{{ $e['weekday'] }}</em>
                </div>

                <div class="ab-tl__card">
                    <div class="ab-tl__text">
                        <div class="ab-tl__top">
                            <span class="ab-tl__time">{{ $e['time'] }}</span>
                            @if (!empty($e['section']))
                                <span class="ab-tl__section">{{ $e['section'] }}</span>
                            @endif
                        </div>

                        <h3><a href="/events/{{ $e['slug'] }}.html">{{ $e['title'] }}</a></h3>
                        <p>{{ $e['text'] }}</p>

                        <div class="ab-tl__foot">
                            <b>{{ $e['price'] ? number_format($e['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}</b>
                            @if ($past)
                                <span class="ab-tl__done">встреча прошла</span>
                            @elseif (!empty($e['seats_total']))
                                <span>осталось {{ $e['seats_left'] }} из {{ $e['seats_total'] }} мест</span>
                            @endif

                            <a class="ab-btn @if ($past) ab-btn--outline @else ab-btn--primary @endif"
                               href="/events/{{ $e['slug'] }}.html">
                                {{ $past ? 'Как это было' : 'Записаться' }}
                            </a>
                        </div>
                    </div>

                    <a class="ab-tl__photo" href="/events/{{ $e['slug'] }}.html">
                        <img src="{{ $e['photo'] ?? '/assets/master-class.webp' }}" alt="{{ $e['title'] }}"
                             width="320" height="240" loading="lazy" decoding="async">
                    </a>
                </div>
            </li>
        @endforeach
    </ol>
</div>
