@php $s = config('home.schedule'); @endphp

<section class="ab-schedule ab-reveal">
    <div class="ab-container">
        <h2 class="ab-h2">{{ $s['title'] }}</h2>
        <p class="ab-lead">{{ $s['lead'] }}</p>

        {{-- Раньше в карточках стояли абстрактные полоски и кольцо: красиво,
             но ничего не сообщали. Теперь видно сам график — время занятий
             перечислено словами. --}}
        <ul class="ab-schedule__list">
            @foreach ($s['items'] as $item)
                <li class="ab-schedule__card">
                    @if (!empty($item['icon']))
                        <span class="ab-schedule__icon" aria-hidden="true">{!! $item['icon'] !!}</span>
                    @endif

                    <h3 class="ab-schedule__title">{{ $item['title'] }}</h3>

                    @if (count($item['slots']))
                        <ul class="ab-schedule__slots">
                            @foreach ($item['slots'] as $slot)
                                <li>{{ $slot }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <p class="ab-schedule__summary">{{ $item['summary'] }}</p>
                    <p class="ab-schedule__note">{{ $item['note'] }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
