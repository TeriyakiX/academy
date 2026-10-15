{{-- Вариант «Афиши»: крупные постеры, текст поверх снимка.
     Минимум слов в плитке — всё остальное на странице встречи. --}}
@php
    $today = now()->format('Y-m-d');
    $all   = \App\Support\Meetings::all();

    $upcoming = $all->filter(fn ($e) => ($e['date'] ?? '') >= $today)->sortBy('date')->values();
    $past     = $all->filter(fn ($e) => ($e['date'] ?? '') < $today)->sortByDesc('date')->values();
@endphp

<ul class="ab-pst">
    @foreach ($upcoming as $i => $e)
        <li class="ab-pst__item @if ($i === 0) is-wide @endif">
            <a href="/events/{{ $e['slug'] }}.html">
                <img src="{{ $e['photo'] ?? '/assets/master-class.webp' }}" alt="{{ $e['title'] }}"
                     width="820" height="620" loading="{{ $i < 2 ? 'eager' : 'lazy' }}" decoding="async">

                <span class="ab-pst__date">
                    <b>{{ $e['day'] }}</b>
                    <i>{{ $e['month'] }}</i>
                </span>

                @if (!empty($e['section']))
                    <span class="ab-pst__section">{{ $e['section'] }}</span>
                @endif

                <span class="ab-pst__body">
                    <b class="ab-pst__title">{{ $e['title'] }}</b>
                    <span class="ab-pst__meta">
                        {{ $e['weekday'] }}, {{ $e['time'] }}
                        · {{ $e['price'] ? number_format($e['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}
                    </span>
                </span>
            </a>
        </li>
    @endforeach
</ul>

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
