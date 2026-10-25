@php $cookies = config('home.cookies'); @endphp

@if (!empty($cookies['enabled']))
    {{--
        Уведомление об использовании cookie.

        Требование закона о персональных данных: посетителя нужно
        предупредить до того, как сайт начнёт собирать данные о нём.
        Поэтому плашка показывается один раз, согласие запоминается
        в браузере, и больше она не появляется.

        Разметка отдаётся скрытой: без скрипта плашка не покажется и
        ничего не перекроет.
    --}}
    <aside class="ab-cookies" data-cookies
           data-cookies-years="{{ $cookies['years'] ?? 1 }}"
           aria-label="Использование cookie" hidden>
        <p class="ab-cookies__text">
            {{ $cookies['text'] }}
            @if (!empty($cookies['href']))
                <a href="{{ $cookies['href'] }}">{{ $cookies['link'] ?? 'Политика конфиденциальности' }}</a>.
            @endif
        </p>

        <div class="ab-cookies__actions">
            <button class="ab-btn ab-btn--primary ab-btn--sm" type="button" data-cookies-accept>
                {{ $cookies['action'] ?? 'Принимаю' }}
            </button>
        </div>
    </aside>
@endif
