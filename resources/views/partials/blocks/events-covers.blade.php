{{-- Вариант «Обложки»: крупный снимок сверху, под ним дата, название
     и цена. Сетка по две в ряд, без фильтров — всё видно сразу. --}}
@php
    $today = now()->format('Y-m-d');
    $all   = \App\Support\Meetings::all();

    $upcoming = $all->filter(fn ($e) => ($e['date'] ?? '') >= $today)->sortBy('date')->values();
    $past     = $all->filter(fn ($e) => ($e['date'] ?? '') < $today)->sortByDesc('date')->values();

    $days = function (array $e) {
        $n = (int) now()->startOfDay()->diffInDays(\Illuminate\Support\Carbon::parse($e['date']), false);

        if ($n === 0) return 'Сегодня';
        if ($n === 1) return 'Завтра';
        if ($n > 30)  return '';

        $tail = ($n % 10 === 1 && $n % 100 !== 11) ? 'день'
            : (($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20)) ? 'дня' : 'дней');

        return "Через {$n} {$tail}";
    };
@endphp

<ul class="ab-cov">
    @foreach ($upcoming as $e)
        <li class="ab-cov__card">
            <a class="ab-cov__photo" href="/events/{{ $e['slug'] }}.html">
                <img src="{{ $e['photo'] ?? '/assets/master-class.webp' }}" alt="{{ $e['title'] }}"
                     width="640" height="430" loading="lazy" decoding="async">

                <span class="ab-cov__day">
                    <b>{{ $e['day'] }}</b>
                    <i>{{ $e['month'] }}</i>
                </span>

                @if ($days($e))
                    <span class="ab-cov__soon">{{ $days($e) }}</span>
                @endif
            </a>

            <div class="ab-cov__body">
                @if (!empty($e['section']))
                    <span class="ab-cov__section">{{ $e['section'] }}</span>
                @endif

                <h3 class="ab-cov__title">
                    <a href="/events/{{ $e['slug'] }}.html">{{ $e['title'] }}</a>
                </h3>

                <p class="ab-cov__when">
                    {{ $e['weekday'] }}, {{ $e['time'] }}@if (!empty($e['duration'])) · {{ $e['duration'] }}@endif
                </p>

                <p class="ab-cov__text">{{ $e['text'] }}</p>

                <div class="ab-cov__foot">
                    <b>{{ $e['price'] ? number_format($e['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}</b>
                    @if (!empty($e['seats_total']))
                        <span>{{ $e['seats_left'] ? 'осталось ' . $e['seats_left'] . ' из ' . $e['seats_total'] : 'мест нет' }}</span>
                    @endif
                </div>

                <a class="ab-btn ab-btn--primary ab-cov__btn" href="/events/{{ $e['slug'] }}.html">
                    Подробнее и запись
                </a>
            </div>
        </li>
    @endforeach
</ul>

@if ($past->isNotEmpty())
    <div class="ab-cov__pastwrap">
        <h2 class="ab-h2">Уже прошли</h2>

        <ul class="ab-cov ab-cov--past">
            @foreach ($past as $e)
                <li class="ab-cov__card">
                    <a class="ab-cov__photo" href="/events/{{ $e['slug'] }}.html">
                        <img src="{{ $e['photo'] ?? '/assets/master-class.webp' }}" alt="{{ $e['title'] }}"
                             width="640" height="430" loading="lazy" decoding="async">
                        <span class="ab-cov__day">
                            <b>{{ $e['day'] }}</b>
                            <i>{{ $e['month'] }}</i>
                        </span>
                    </a>

                    <div class="ab-cov__body">
                        <h3 class="ab-cov__title">
                            <a href="/events/{{ $e['slug'] }}.html">{{ $e['title'] }}</a>
                        </h3>
                        <p class="ab-cov__when">встреча прошла</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif
