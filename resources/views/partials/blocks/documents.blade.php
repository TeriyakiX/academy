@php $d = config('documents'); @endphp

<section class="ab-docs ab-reveal">
    <div class="ab-container">
        <div class="ab-docs__head">
            <div>
                <h2 class="ab-h2">{{ $d['title'] }}</h2>
                <p class="ab-lead">{{ $d['lead'] }}</p>
            </div>
            <span class="ab-docs__badge">Квалификация «бармен 3–4 разряда»</span>
        </div>

        <ul class="ab-docs__list">
            @foreach ($d['items'] as $item)
                <li class="ab-docs__item">
                    <div class="ab-docs__preview">
                        @if (!empty($item['image']))
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}"
                                 loading="lazy" width="320" height="230">
                        @else
                            <span class="ab-docs__placeholder">Образец документа</span>
                        @endif
                    </div>
                    <h3 class="ab-docs__title">{{ $item['title'] }}</h3>
                    <p class="ab-docs__text">{{ $item['text'] }}</p>
                </li>
            @endforeach
        </ul>

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
