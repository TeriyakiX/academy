@php $h = config('home.hero'); @endphp

<section class="ab-hero">

    <div class="ab-container">
        <div class="ab-hero__grid">

            <div class="ab-hero__main">
                <h1 class="ab-hero__title ab-in" style="--d:.06s">{!! $h['title_html'] ?? e($h['title']) !!}</h1>

                <p class="ab-hero__text ab-in" style="--d:.12s">{{ $h['text'] }}</p>

                <ul class="ab-hero__facts ab-in" style="--d:.18s">
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

                <div class="ab-hero__actions ab-in" style="--d:.24s">
                    <button class="ab-btn ab-btn--primary ab-btn--lg" type="button" data-modal-path="consultation">
                        Оставить заявку
                    </button>
                    <a class="ab-btn ab-btn--outline ab-btn--lg" href="/courses.html">Выбрать курс</a>
                </div>
            </div>

            {{-- Направления: все четыре сразу.
                 Раньше здесь была карусель — она показывала одно направление,
                 переключалась сама и уводила внимание с заголовка. --}}
            <ul class="ab-hero__tiles ab-in" style="--d:.16s">
                @foreach ($h['directions'] as $i => $d)
                    <li class="ab-tile">
                        <a class="ab-tile__link" href="{{ $d['href'] }}">
                            <img class="ab-tile__photo" src="{{ $d['photo'] }}" alt="{{ $d['title'] }}"
                                 width="573" height="470" loading="{{ $i < 2 ? 'eager' : 'lazy' }}" decoding="async">

                            <span class="ab-tile__body">
                                <span class="ab-tile__title">{{ $d['title'] }}</span>
                                <span class="ab-tile__arrow" aria-hidden="true">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M7 17 17 7M9 7h8v8" fill="none" stroke="currentColor"
                                              stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
</section>
