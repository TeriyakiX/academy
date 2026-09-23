{{--
    Изображение сертификата — бумажный документ, а не пластиковая карта.

    Нарисован вёрсткой: так он чёткий на любом экране, а текст на нём
    можно менять без дизайнера. Размеры текста привязаны к ширине самого
    листа, поэтому на телефоне он уменьшается целиком, не разваливаясь.

    Параметры:
      $price   — цена «от …» на ярлыке рядом с листом, необязательно;
      $program — название программы в строке «Программа», необязательно;
      $to      — имя в строке «Выдан», необязательно.
--}}
@php
    $price   = $price ?? null;
    $program = $program ?? null;
    $to      = $to ?? null;
    /* У каждой печати свой идентификатор: лист может встретиться на странице дважды. */
    $sealId = 'ab-seal-' . \Illuminate\Support\Str::random(6);
@endphp

<div class="ab-certdoc-stack">
    <span class="ab-certdoc-stack__back"></span>

    <div class="ab-certdoc">
        <div class="ab-certdoc__frame">
            <span class="ab-certdoc__corner ab-certdoc__corner--tl"></span>
            <span class="ab-certdoc__corner ab-certdoc__corner--tr"></span>
            <span class="ab-certdoc__corner ab-certdoc__corner--bl"></span>
            <span class="ab-certdoc__corner ab-certdoc__corner--br"></span>

            {{-- Логотип целиком: надпись «Академия Бариста» уже внутри него. --}}
            <img class="ab-certdoc__logo" src="/assets/logo.svg" alt="Академия Бариста"
                 width="80" height="81" loading="lazy" decoding="async">

            <strong class="ab-certdoc__title">Сертификат</strong>
            <span class="ab-certdoc__subtitle">на обучение в Академии Бариста</span>

            <span class="ab-certdoc__label">Выдан</span>
            <span class="ab-certdoc__line">
                @if ($to) {{ $to }} @else <i>имя получателя</i> @endif
            </span>

            <span class="ab-certdoc__label">Программа</span>
            <span class="ab-certdoc__line">
                @if ($program) {{ $program }} @else <i>выбранные курсы и мастер-классы</i> @endif
            </span>

            <span class="ab-certdoc__foot">
                <span class="ab-certdoc__meta">
                    <span>Москва</span>
                    <span>№ 0001</span>
                </span>

                {{-- Печать: круговая надпись вокруг знака. --}}
                <svg class="ab-certdoc__seal" viewBox="0 0 100 100" aria-hidden="true">
                    <defs>
                        <path id="{{ $sealId }}" d="M50 50 m-36 0 a36 36 0 1 1 72 0 a36 36 0 1 1 -72 0" />
                    </defs>
                    <circle cx="50" cy="50" r="47" fill="none" stroke="currentColor" stroke-width="2" />
                    <circle cx="50" cy="50" r="27" fill="none" stroke="currentColor" stroke-width="1.4" />
                    <text font-size="9.4" letter-spacing="1.6" fill="currentColor">
                        <textPath href="#{{ $sealId }}">АКАДЕМИЯ БАРИСТА · МОСКВА ·</textPath>
                    </text>
                    <text x="50" y="47" text-anchor="middle" font-size="9" font-weight="700" fill="currentColor">С 2019</text>
                    <text x="50" y="58" text-anchor="middle" font-size="7" fill="currentColor">ГОДА</text>
                </svg>

                <span class="ab-certdoc__sign">
                    <span class="ab-certdoc__sign-line"></span>
                    <span>Руководитель школы</span>
                </span>
            </span>
        </div>
    </div>

    @if ($price)
        <span class="ab-certdoc__price">от {{ number_format($price, 0, '', ' ') }} ₽</span>
    @endif
</div>
