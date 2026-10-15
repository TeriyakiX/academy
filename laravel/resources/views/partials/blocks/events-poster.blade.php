{{-- Вариант «Афиша»: месяц — заголовок, под ним крупные карточки подряд.
     Без фильтров: встреч в месяц немного, и листать проще, чем выбирать. --}}
@php
    $today = now()->format('Y-m-d');
    $months = collect(config('home.events.months', []))
        ->map(fn ($list) => collect($list)->filter(fn ($e) => ($e['date'] ?? '') >= $today)->values())
        ->filter(fn ($list) => $list->isNotEmpty());

    $past = collect(config('home.events.months', []))
        ->flatMap(fn ($list) => $list)
        ->filter(fn ($e) => ($e['date'] ?? '') < $today)
        ->sortByDesc('date')
        ->values();
@endphp

<div class="ab-poster">
    @foreach ($months as $month => $list)
        <section class="ab-poster__month">
            <h2 class="ab-poster__mname">{{ $month }}<span>{{ $list->count() }}</span></h2>

            @foreach ($list as $e)
                <article class="ab-poster__row">
                    <a class="ab-poster__photo" href="/events/{{ $e['slug'] }}.html">
                        <img src="{{ $e['photo'] ?? '/assets/master-class.webp' }}" alt="{{ $e['title'] }}"
                             width="420" height="280" loading="lazy" decoding="async">
                    </a>

                    <div class="ab-poster__body">
                        <div class="ab-poster__top">
                            @if (!empty($e['section']))
                                <span class="ab-poster__section">{{ $e['section'] }}</span>
                            @endif
                            <span class="ab-poster__date">
                                {{ $e['day'] }} {{ $e['month'] }}, {{ $e['weekday'] }}, {{ $e['time'] }}
                            </span>
                        </div>

                        <h3 class="ab-poster__title">
                            <a href="/events/{{ $e['slug'] }}.html">{{ $e['title'] }}</a>
                        </h3>
                        <p class="ab-poster__text">{{ $e['text'] }}</p>

                        <div class="ab-poster__foot">
                            <b>{{ $e['price'] ? number_format($e['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}</b>
                            @if (!empty($e['duration']))
                                <span>{{ $e['duration'] }}</span>
                            @endif
                            @if (!empty($e['seats_total']))
                                <span>группа до {{ $e['seats_total'] }} человек</span>
                            @endif
                            <a class="ab-btn ab-btn--primary" href="/events/{{ $e['slug'] }}.html">Подробнее</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
    @endforeach

    @if ($past->isNotEmpty())
        <section class="ab-poster__month ab-poster__month--past">
            <h2 class="ab-poster__mname">Уже прошли<span>{{ $past->count() }}</span></h2>

            <ul class="ab-poster__past">
                @foreach ($past as $e)
                    <li>
                        <a href="/events/{{ $e['slug'] }}.html">
                            <b>{{ $e['day'] }} {{ $e['month'] }}</b>
                            <span>{{ $e['title'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
</div>
