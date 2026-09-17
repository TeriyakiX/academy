@php $s = config('home.schedule'); @endphp

{{--
    Когда идут занятия.

    Раньше здесь были три карточки с полосками-делениями: красиво, но
    человек не понимал, во сколько занятие. Теперь простая таблица:
    формат, время, длительность и кому подходит — читается за пару секунд.
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

        <div class="ab-when__table">
            <div class="ab-when__row ab-when__row--head" aria-hidden="true">
                <span>Формат</span>
                <span>Время занятий</span>
                <span>Сколько длится</span>
                <span>Кому подходит</span>
            </div>

            @foreach ($s['items'] as $item)
                <div class="ab-when__row">
                    <b class="ab-when__mode">{{ $item['title'] }}</b>

                    <div class="ab-when__times" data-label="Время">
                        @if (!empty($item['times']))
                            @foreach ($item['times'] as $time)
                                <span>{{ $time }}</span>
                            @endforeach
                        @else
                            <span class="is-any">любое удобное</span>
                        @endif
                    </div>

                    <span class="ab-when__len" data-label="Длительность">{{ $item['length'] }}</span>
                    <span class="ab-when__for" data-label="Кому">{{ $item['audience'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
