@php $d = config('documents'); @endphp

<section class="ab-docs ab-reveal">
    <div class="ab-container">
        <div class="ab-docs__head">
            <div>
                <h2 class="ab-h2">{{ $d['title'] }}</h2>
                <p class="ab-lead">{{ $d['lead'] }}</p>
            </div>
            <span class="ab-docs__badge">{{ $d['badge'] }}</span>
        </div>

        {{-- Сами документы: скан слева, описание справа --}}
        <ul class="ab-docs__list">
            @foreach ($d['items'] as $item)
                <li class="ab-docs__item">
                    <div class="ab-docs__preview">
                        @if (!empty($item['image']))
                            <img src="{{ $item['image'] }}"
                                 alt="{{ $item['alt'] ?? $item['title'] }}"
                                 loading="lazy" width="300" height="420">
                        @else
                            {{-- скана ещё нет: иконка вместо пустой рамки --}}
                            <span class="ab-docs__icon">{!! $item['icon'] !!}</span>
                        @endif
                    </div>
                    <div class="ab-docs__body">
                        <h3 class="ab-docs__title">{{ $item['title'] }}</h3>
                        <p class="ab-docs__text">{{ $item['text'] }}</p>
                    </div>
                </li>
            @endforeach
        </ul>

        {{-- Что написано в свидетельстве --}}
        <div class="ab-docs__details">
            <h3 class="ab-docs__sub">{{ $d['details']['title'] }}</h3>
            <ul class="ab-docs__facts">
                @foreach ($d['details']['items'] as $f)
                    <li>
                        <b>{{ $f['title'] }}</b>
                        <span>{{ $f['text'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Условия приёма --}}
        <div class="ab-docs__req">
            <h3 class="ab-docs__req-title">{{ $d['requirements']['title'] }}</h3>
            <ul class="ab-docs__req-list">
                @foreach ($d['requirements']['items'] as $r)
                    <li>
                        <b>{{ $r['title'] }}</b>
                        <span>{{ $r['text'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <p class="ab-docs__note">{{ $d['note'] }}</p>
    </div>
</section>
