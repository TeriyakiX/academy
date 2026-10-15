{{-- Вариант «Список и просмотр»: слева даты, справа подробности выбранной.
     Переключение на радиокнопках, без скрипта. --}}
@php
    $today = now()->format('Y-m-d');
    $list  = \App\Support\Meetings::all()
        ->filter(fn ($e) => !empty($e['date']))
        ->sortBy(fn ($e) => [$e['date'] < $today, $e['date']])
        ->values();
@endphp

<div class="ab-split">
    {{-- Переключатели лежат рядом со списком и панелями: от них идут
         соседние селекторы к выбранной строке и её панели. --}}
    @foreach ($list as $i => $e)
        <input class="ab-split__radio" type="radio" name="ab-split" id="ab-split-{{ $i }}"
               @checked($i === 0)>
    @endforeach

    <div class="ab-split__nav">
        @foreach ($list as $i => $e)
            @php $past = $e['date'] < $today; @endphp
            <label class="ab-split__row @if ($past) is-past @endif" for="ab-split-{{ $i }}">
                <span class="ab-split__date">
                    <b>{{ $e['day'] }}</b>
                    <i>{{ $e['month'] }}</i>
                </span>
                <span class="ab-split__name">
                    {{ $e['title'] }}
                    <em>{{ $e['weekday'] }}, {{ $e['time'] }}@if ($past) · прошла @endif</em>
                </span>
            </label>
        @endforeach
    </div>

    <div class="ab-split__panes">
        @foreach ($list as $i => $e)
            @php $past = $e['date'] < $today; @endphp
            <article class="ab-split__pane" data-pane="{{ $i }}">
                <img src="{{ $e['photo'] ?? '/assets/master-class.webp' }}" alt="{{ $e['title'] }}"
                     width="720" height="420" loading="lazy" decoding="async">

                <div class="ab-split__text">
                    @if (!empty($e['section']))
                        <span class="ab-split__tag">{{ $e['section'] }}</span>
                    @endif

                    <h3>{{ $e['title'] }}</h3>
                    <p>{{ $e['text'] }}</p>

                    <ul class="ab-split__facts">
                        <li><b>{{ $e['day'] }} {{ $e['month'] }}, {{ $e['time'] }}</b><span>{{ $e['weekday'] }}</span></li>
                        @if (!empty($e['duration']))
                            <li><b>{{ $e['duration'] }}</b><span>длительность</span></li>
                        @endif
                        <li>
                            <b>{{ $e['price'] ? number_format($e['price'], 0, ',', ' ') . ' ₽' : 'Бесплатно' }}</b>
                            <span>участие</span>
                        </li>
                        @if (!empty($e['seats_total']))
                            <li>
                                <b>{{ $past || !$e['seats_left'] ? 'мест нет' : 'осталось ' . $e['seats_left'] }}</b>
                                <span>группа до {{ $e['seats_total'] }}</span>
                            </li>
                        @endif
                    </ul>

                    <a class="ab-btn @if ($past) ab-btn--outline @else ab-btn--primary @endif ab-btn--lg"
                       href="/events/{{ $e['slug'] }}.html">
                        {{ $past ? 'Посмотреть встречу' : 'Подробнее и запись' }}
                    </a>
                </div>
            </article>
        @endforeach
    </div>
</div>
