@php
    /* Минимальная цена берётся из тех же программ, что и на странице
       сертификатов: выдумывать «от» нельзя, а ориентир человеку нужен. */
    $prices = collect(config('courses.schools'))->flatten(1)->pluck('price')->filter();
    $from   = $prices->isNotEmpty() ? $prices->min() : null;

    $steps = [
        ['n' => '1', 'title' => 'Выберите программы', 'text' => 'Курс, мастер-класс или сразу несколько'],
        ['n' => '2', 'title' => 'Подпишите',          'text' => 'Имя получателя и пожелание'],
        ['n' => '3', 'title' => 'Оставьте контакты',  'text' => 'Перезвоним и оформим сертификат'],
    ];
@endphp

<section class="ab-cert ab-reveal">
    <div class="ab-container">
        <div class="ab-cert__inner">
            <div class="ab-cert__body">
                <span class="ab-cert__tag">Подарочный сертификат</span>
                <h2 class="ab-h2 ab-h2--light">Подарите старт в новой профессии</h2>
                <p class="ab-cert__text">
                    Сертификат в школу бариста — это обучение у практикующих преподавателей.
                    Подойдёт и тем, кто хочет сменить работу, и тем, кто просто любит кофе.
                </p>

                {{-- Те же три шага, что и на странице оформления: видно,
                     что дальше не «оставьте заявку и ждите», а понятный путь. --}}
                <ol class="ab-cert__steps">
                    @foreach ($steps as $s)
                        <li class="ab-cert__step">
                            <span class="ab-cert__step-n">{{ $s['n'] }}</span>
                            <span class="ab-cert__step-body">
                                <b>{{ $s['title'] }}</b>
                                <i>{{ $s['text'] }}</i>
                            </span>
                        </li>
                    @endforeach
                </ol>

                <div class="ab-cert__actions">
                    <a class="ab-btn ab-btn--light ab-btn--lg" href="/sertifikat.html#oformit">
                        Собрать сертификат
                    </a>
                    <a class="ab-cert__more" href="/courses.html">Посмотреть программы</a>
                </div>
            </div>

            {{-- Сертификат нарисован вёрсткой, а не снимком: на прежней
                 картинке была напечатана дата окончания, которая давно прошла,
                 и серая рука со стока на белом фоне. --}}
            <div class="ab-cert__media" aria-hidden="true">
                <div class="ab-giftcard-stack">
                    <span class="ab-giftcard-stack__back"></span>

                    <div class="ab-giftcard">
                        <span class="ab-giftcard__sheen"></span>

                        <img class="ab-giftcard__mark" src="/assets/logo.png" alt=""
                             width="64" height="64" loading="lazy" decoding="async">

                        <span class="ab-giftcard__kicker">Подарочный</span>
                        <strong class="ab-giftcard__word">Сертификат</strong>

                        <span class="ab-giftcard__rule"></span>
                        <span class="ab-giftcard__foot">Академия Бариста · Москва</span>
                    </div>

                    @if ($from)
                        <span class="ab-giftcard__price">от {{ number_format($from, 0, '', ' ') }} ₽</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
