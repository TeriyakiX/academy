@php $s = config('home.schedule'); @endphp

<section class="ab-schedule ab-reveal">
    <div class="ab-container">
        <h2 class="ab-h2">{{ $s['title'] }}</h2>
        <p class="ab-lead">{{ $s['lead'] }}</p>

        <ul class="ab-schedule__list">
            @foreach ($s['items'] as $i => $item)
                <li class="ab-schedule__card">
                    <h3 class="ab-schedule__title">{{ $item['title'] }}</h3>

                    <div class="ab-schedule__visual">
                        @if (count($item['slots']))
                            @foreach ($item['slots'] as $k => $slot)
                                <div class="ab-schedule__row">
                                    <span class="ab-schedule__slot">{{ $slot }}</span>
                                    <div class="ab-schedule__bars">
                                        @for ($b = 0; $b < count($item['slots']); $b++)
                                            <span class="ab-schedule__bar @if ($b === $k) is-on @endif"></span>
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{-- Двенадцать делений по кругу — как часовой циферблат:
                                 время занятия выбирается любое. --}}
                            <div class="ab-schedule__free" aria-hidden="true">
                                <svg viewBox="0 0 120 120">
                                    @for ($i = 0; $i < 12; $i++)
                                        <line class="ab-schedule__tick" x1="60" y1="16" x2="60" y2="27"
                                              transform="rotate({{ $i * 30 }} 60 60)"
                                              style="--i: {{ $i }}"/>
                                    @endfor
                                </svg>
                            </div>
                        @endif
                    </div>

                    <p class="ab-schedule__summary">{{ $item['summary'] }}</p>
                    <p class="ab-schedule__note">{{ $item['note'] }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
