@php $promo = config('home.promo'); @endphp

@if (!empty($promo['enabled']))
    {{--
        Всплывающее предложение.

        Появляется само, поэтому обращаемся с ним аккуратно: показываем не
        сразу, закрывается одним нажатием и после этого неделю не возвращается.
        Разметка отдаётся скрытой — если скрипт не загрузился, окно не
        покажется вовсе и ничего не перекроет.
    --}}
    <aside class="ab-promo" data-promo
           data-promo-delay="{{ $promo['delay'] ?? 14 }}"
           data-promo-scroll="{{ $promo['scroll'] ?? 0.3 }}"
           aria-label="Предложение" hidden>

        <button class="ab-promo__close" type="button" data-promo-close aria-label="Закрыть предложение">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6 6l12 12M18 6L6 18" fill="none" stroke="currentColor"
                      stroke-width="2.2" stroke-linecap="round" />
            </svg>
        </button>

        <span class="ab-promo__tag">{{ $promo['tag'] }}</span>
        <b class="ab-promo__title">{{ $promo['title'] }}</b>
        <p class="ab-promo__text">{{ $promo['text'] }}</p>

        <a class="ab-btn ab-btn--primary ab-btn--sm ab-promo__action" href="{{ $promo['href'] }}">
            {{ $promo['action'] }}
        </a>
    </aside>
@endif
