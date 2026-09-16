@php
    /* Минимальная цена берётся из тех же программ, что и на странице
       сертификатов: выдумывать «от» нельзя, а ориентир человеку нужен. */
    $schools = config('courses.schools');

    $programs = collect($schools)
        ->flatMap(fn ($courses, $school) => collect($courses)->map(fn ($c) => $c + ['school' => $school]))
        ->filter(fn ($c) => !empty($c['price']))
        ->values();

    $from = $programs->min('price');

    $steps = [
        ['n' => '1', 'title' => 'Выберите программы', 'text' => 'Курс, мастер-класс или сразу несколько'],
        ['n' => '2', 'title' => 'Заполните данные',   'text' => 'Кому дарите и куда вам перезвонить'],
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

                {{-- Те же два шага, что и на странице оформления: видно,
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

                    {{-- Раньше отсюда уводило на страницу курсов. Теперь программы
                         открываются лентой прямо здесь — человек не уходит с главной. --}}
                    <button class="ab-cert__more" type="button"
                            data-rail-toggle aria-expanded="false" aria-controls="cert-programs">
                        <span>Посмотреть программы</span>
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor"
                                  stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Сертификат — бумажный документ, нарисованный вёрсткой. --}}
            <div class="ab-cert__media" aria-hidden="true">
                @include('partials.certificate-paper', ['price' => $from])
            </div>

            {{-- Лента программ занимает всю ширину карточки. Без скрипта она
                 просто видна и листается пальцем; скрипт добавляет
                 сворачивание и стрелки. --}}
            <div class="ab-cert__rail" id="cert-programs" data-rail>
                <ul class="ab-cert__rail-track" data-rail-track>
                    @foreach ($programs as $p)
                        <li>
                            <a class="ab-cert__prog" href="{{ $p['url'] }}">
                                <span class="ab-cert__prog-school">{{ $p['school'] }}</span>
                                <span class="ab-cert__prog-title">{{ $p['title'] }}</span>
                                <span class="ab-cert__prog-meta">{{ $p['duration'] ?? '' }}</span>
                                <span class="ab-cert__prog-price">{{ number_format($p['price'], 0, '', ' ') }} ₽</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="ab-cert__rail-nav">
                    <button class="ab-cert__rail-btn" type="button" data-rail-prev aria-label="Предыдущие программы">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M15 5 8 12l7 7" fill="none" stroke="currentColor"
                                  stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button class="ab-cert__rail-btn" type="button" data-rail-next aria-label="Следующие программы">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m9 5 7 7-7 7" fill="none" stroke="currentColor"
                                  stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
