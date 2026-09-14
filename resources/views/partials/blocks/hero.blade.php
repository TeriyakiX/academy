@php
    $h = config('home.hero');
    $schools = config('courses.schools');

    /* «от …» берём из реальных цен программ направления, а не придумываем. */
    $priceFrom = function (?string $school) use ($schools) {
        $prices = collect($schools[$school] ?? [])->pluck('price')->filter();

        return $prices->isNotEmpty() ? $prices->min() : null;
    };
@endphp

<section class="ab-hero">
    {{-- Фото занимает весь первый экран: это школа, а не текстовая страница. --}}
    <div class="ab-hero__bg" aria-hidden="true">
        <img src="{{ $h['directions'][0]['photo'] }}" alt="" width="1600" height="900"
             fetchpriority="high" decoding="async">
    </div>

    <div class="ab-container">
        <div class="ab-hero__main">
            <span class="ab-hero__kicker ab-in" style="--d:.04s">Академия Бариста · Москва</span>

            <h1 class="ab-hero__title ab-in" style="--d:.08s">{!! $h['title_html'] ?? e($h['title']) !!}</h1>

            <p class="ab-hero__text ab-in" style="--d:.14s">{{ $h['text'] }}</p>

            <ul class="ab-hero__facts ab-in" style="--d:.2s">
                @foreach ($h['facts'] as $fact)
                    <li>
                        <svg class="ab-hero__check" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m5 12 5 5L19 8" fill="none" stroke="currentColor"
                                  stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        {{ $fact }}
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Вместо карусели — выбор направления. Человек сразу говорит, зачем
             пришёл, и видит цену и кнопку именно своего направления.
             Переключает он сам, ничего не двигается само по себе. --}}
        <div class="ab-hero__picker ab-in" style="--d:.26s" data-picker>
            <span class="ab-hero__picker-label">С чего начнём?</span>

            <div class="ab-hero__tabs" role="tablist">
                @foreach ($h['directions'] as $i => $d)
                    <button class="ab-hero__tab{{ $i === 0 ? ' is-active' : '' }}" type="button"
                            role="tab" id="dir-tab-{{ $i }}" aria-controls="dir-{{ $i }}"
                            aria-selected="{{ $i === 0 ? 'true' : 'false' }}" data-picker-tab="{{ $i }}">
                        {{ $d['short'] }}
                    </button>
                @endforeach
            </div>

            @foreach ($h['directions'] as $i => $d)
                @php $from = $priceFrom($d['school'] ?? null); @endphp

                <div class="ab-hero__panel" id="dir-{{ $i }}" role="tabpanel"
                     aria-labelledby="dir-tab-{{ $i }}" data-picker-panel="{{ $i }}" @if ($i > 0) hidden @endif>

                    <div class="ab-hero__panel-text">
                        <b class="ab-hero__panel-title">{{ $d['title'] }}</b>
                        <p class="ab-hero__panel-note">{{ $d['text'] }}</p>

                        <span class="ab-hero__panel-price">
                            @if ($from)
                                от {{ number_format($from, 0, '', ' ') }} ₽
                            @else
                                стоимость обсуждаем индивидуально
                            @endif
                        </span>

                        <span class="ab-hero__panel-actions">
                            <a class="ab-btn ab-btn--primary" href="{{ $d['href'] }}">{{ $d['link'] }}</a>
                            <button class="ab-btn ab-btn--outline" type="button" data-modal-path="consultation">
                                Оставить заявку
                            </button>
                        </span>
                    </div>

                    <img class="ab-hero__panel-photo" src="{{ $d['photo'] }}" alt="{{ $d['title'] }}"
                         width="573" height="470" loading="{{ $i === 0 ? 'eager' : 'lazy' }}" decoding="async">
                </div>
            @endforeach
        </div>
    </div>
</section>
