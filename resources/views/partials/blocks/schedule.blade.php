@php $s = config('home.schedule'); @endphp

{{--
    Когда идут занятия.

    Была таблица: читалась быстро, но выглядела как выгрузка из отчёта
    и повторяла оформление соседних блоков. Теперь три колонки без рамок,
    разделённые тонкой линией: формат, время крупно, под ним длительность
    и кому подходит.
--}}
<section class="ab-when ab-reveal">
    <div class="ab-container">
        <div class="ab-when__head">
            <div>
                <h2 class="ab-h2">{{ $s['title'] }}</h2>
                <p class="ab-lead">{{ $s['lead'] }}</p>
            </div>

            @if (!empty($s['note']))
                <p class="ab-when__hint">{{ $s['note'] }}</p>
            @endif
        </div>

        <ul class="ab-when__grid">
            @foreach ($s['items'] as $item)
                <li class="ab-when__col">
                    <b class="ab-when__mode">{{ $item['title'] }}</b>

                    <div class="ab-when__times">
                        @if (!empty($item['times']))
                            @foreach ($item['times'] as $time)
                                <span>{{ $time }}</span>
                            @endforeach
                        @else
                            <span class="is-any">время выбираете сами</span>
                        @endif
                    </div>

                    <dl class="ab-when__meta">
                        <div>
                            <dt>Сколько длится</dt>
                            <dd>{{ $item['length'] }}</dd>
                        </div>
                        <div>
                            <dt>Кому подходит</dt>
                            <dd>{{ $item['audience'] }}</dd>
                        </div>
                    </dl>
                </li>
            @endforeach
        </ul>
    </div>
</section>
