{{-- Афиши встреч: крупный снимок, текст поверх него. Подробности —
     на странице встречи, поэтому в плитке только главное.

     Параметры подключения: limit — сколько ближайших показать,
     withPast — выводить ли список прошедших. --}}
@php
    $today = now()->format('Y-m-d');
    $all   = \App\Support\Meetings::all();

    $limit    = $limit ?? null;
    $withPast = $withPast ?? true;

    $upcoming = $all->filter(fn ($e) => $e['date'] >= $today)->sortBy('date')->values();
    $past     = $all->filter(fn ($e) => $e['date'] < $today)->sortByDesc('date')->values();

    if ($limit) {
        $upcoming = $upcoming->take($limit);
    }

    /* «Через 3 дня» рядом с датой: так видно, что встреча скоро,
       без подсчётов в уме. */
    $soon = function (array $e) {
        $n = (int) now()->startOfDay()->diffInDays(\Illuminate\Support\Carbon::parse($e['date']), false);

        if ($n === 0) return 'Сегодня';
        if ($n === 1) return 'Завтра';
        if ($n > 30)  return '';

        $tail = ($n % 10 === 1 && $n % 100 !== 11) ? 'день'
            : (($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20)) ? 'дня' : 'дней');

        return "Через {$n} {$tail}";
    };
@endphp

@if ($upcoming->isEmpty())
    <p class="ab-ev__empty">
        Ближайшие даты уточняются. Позвоните нам — подскажем, когда будет
        следующая встреча.
    </p>
@else
    <ul class="ab-pst">
        @foreach ($upcoming as $i => $e)
            <li class="ab-pst__item @if ($i === 0 && !$limit) is-wide @endif">
                <a href="/events/{{ $e['slug'] }}.html">
                    <img src="{{ $e['photo'] }}" alt="{{ $e['title'] }}"
                         width="820" height="620"
                         loading="{{ $i < 2 ? 'eager' : 'lazy' }}" decoding="async">

                    <span class="ab-pst__date">
                        <b>{{ $e['day'] }}</b>
                        <i>{{ $e['month'] }}</i>
                    </span>

                    <span class="ab-pst__tags">
                        @if ($soon($e))
                            <span class="ab-pst__soon">{{ $soon($e) }}</span>
                        @endif
                        @if ($e['section'])
                            <span class="ab-pst__section">{{ $e['section'] }}</span>
                        @endif
                    </span>

                    <span class="ab-pst__body">
                        <b class="ab-pst__title">{{ $e['title'] }}</b>

                        <span class="ab-pst__meta">
                            <span>{{ $e['weekday'] }}, {{ $e['time'] }}</span>
                            <span class="ab-pst__price">
                                {{ $e['price'] ? number_format($e['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}
                            </span>
                        </span>

                        @if ($e['seats_total'])
                            <span class="ab-pst__seats">
                                {{ $e['seats_left']
                                    ? 'осталось ' . $e['seats_left'] . ' из ' . $e['seats_total'] . ' мест'
                                    : 'мест нет' }}
                            </span>
                        @endif
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
@endif

@if ($withPast && $past->isNotEmpty())
    <div class="ab-pst__pastwrap">
        <h2 class="ab-pst__pasthead">Уже прошли</h2>

        <ul class="ab-pst ab-pst--past">
            @foreach ($past as $e)
                <li class="ab-pst__item">
                    <a href="/events/{{ $e['slug'] }}.html">
                        <img src="{{ $e['photo'] }}" alt="{{ $e['title'] }}"
                             width="420" height="320" loading="lazy" decoding="async">

                        <span class="ab-pst__date">
                            <b>{{ $e['day'] }}</b>
                            <i>{{ $e['month'] }}</i>
                        </span>

                        <span class="ab-pst__body">
                            <b class="ab-pst__title">{{ $e['title'] }}</b>
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
