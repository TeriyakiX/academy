{{-- Вариант «Ближайшая крупно»: одна встреча занимает экран целиком,
     остальные идут компактными строками. Расчёт на то, что человек
     чаще всего идёт на ближайшую, а не выбирает из десятка. --}}
@php
    $today = now()->format('Y-m-d');
    $all   = \App\Support\Meetings::all();

    $upcoming = $all->filter(fn ($e) => ($e['date'] ?? '') >= $today)->sortBy('date')->values();
    $past     = $all->filter(fn ($e) => ($e['date'] ?? '') < $today)->sortByDesc('date')->values();

    $main = $upcoming->first();
    $rest = $upcoming->slice(1)->values();

    $days = $main ? now()->startOfDay()->diffInDays(\Illuminate\Support\Carbon::parse($main['date']), false) : null;
@endphp

@if ($main)
    <article class="ab-evhero">
        <div class="ab-evhero__photo">
            <img src="{{ $main['photo'] ?? '/assets/master-class.webp' }}" alt="{{ $main['title'] }}"
                 width="820" height="560" loading="eager" decoding="async">
        </div>

        <div class="ab-evhero__body">
            <span class="ab-evhero__when">
                @if ($days === 0) Сегодня
                @elseif ($days === 1) Завтра
                @else Через {{ $days }} {{ $days % 10 === 1 && $days % 100 !== 11 ? 'день' : (($days % 10 >= 2 && $days % 10 <= 4 && ($days % 100 < 10 || $days % 100 >= 20)) ? 'дня' : 'дней') }}
                @endif
            </span>

            <h2 class="ab-evhero__title">{{ $main['title'] }}</h2>
            <p class="ab-evhero__text">{{ $main['text'] }}</p>

            <dl class="ab-evhero__facts">
                <div><dt>Когда</dt><dd>{{ $main['day'] }} {{ $main['month'] }}, {{ $main['weekday'] }}, {{ $main['time'] }}</dd></div>
                @if (!empty($main['duration']))
                    <div><dt>Сколько идёт</dt><dd>{{ $main['duration'] }}</dd></div>
                @endif
                <div><dt>Участие</dt><dd>{{ $main['price'] ? number_format($main['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}</dd></div>
                @if (!empty($main['seats_total']))
                    <div>
                        <dt>Места</dt>
                        <dd>{{ $main['seats_left'] ? 'осталось ' . $main['seats_left'] . ' из ' . $main['seats_total'] : 'мест нет' }}</dd>
                    </div>
                @endif
            </dl>

            <div class="ab-evhero__actions">
                <a class="ab-btn ab-btn--primary ab-btn--lg" href="/events/{{ $main['slug'] }}.html">
                    Подробнее и запись
                </a>
                <a class="ab-evhero__call" href="{{ config('nav.contacts.phone_href') }}">
                    {{ config('nav.contacts.phone') }}
                </a>
            </div>
        </div>
    </article>
@endif

@if ($rest->isNotEmpty())
    <div class="ab-evnext">
        <h2 class="ab-h2">Дальше в расписании</h2>

        <ul class="ab-evnext__list">
            @foreach ($rest as $e)
                <li>
                    <a href="/events/{{ $e['slug'] }}.html">
                        <span class="ab-evnext__date">{{ $e['day'] }} {{ $e['month'] }}</span>
                        <span class="ab-evnext__title">{{ $e['title'] }}</span>
                        <span class="ab-evnext__meta">
                            {{ $e['weekday'] }}, {{ $e['time'] }}
                            @if (!empty($e['section'])) · {{ $e['section'] }} @endif
                        </span>
                        <span class="ab-evnext__price">
                            {{ $e['price'] ? number_format($e['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

@if ($past->isNotEmpty())
    <details class="ab-evtab__past">
        <summary>Уже прошли ({{ $past->count() }})</summary>
        <ul>
            @foreach ($past as $e)
                <li>
                    <a href="/events/{{ $e['slug'] }}.html">
                        <b>{{ $e['day'] }} {{ $e['month'] }}</b> {{ $e['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </details>
@endif
