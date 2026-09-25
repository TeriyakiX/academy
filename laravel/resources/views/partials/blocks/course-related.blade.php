@php
    /* Соседние программы того же направления. Вкладки со всем каталогом
       на странице курса не нужны: человек уже выбрал направление, ему
       полезнее увидеть, что рядом и чем оно отличается. */
    $school = $course['school'] ?? null;
    $schools = config('courses.schools');

    $near = collect($schools[$school] ?? [])
        ->reject(fn ($c) => ($c['url'] ?? '') === ($course['url'] ?? ''));

    /* Если в направлении больше ничего нет, показываем курсы из других. */
    if ($near->count() < 2) {
        $near = collect($schools)
            ->flatMap(fn ($list) => $list)
            ->reject(fn ($c) => ($c['url'] ?? '') === ($course['url'] ?? ''));
    }

    /* Фото для карточки: сначала снимок со страницы курса, иначе
       общий кадр направления. */
    $pages = config('course-pages', []);
    $shots = [
        'Курсы бариста' => '/assets/barista.webp',
        'Мастер-классы' => '/assets/master-class.webp',
        'Барное дело'   => '/assets/barmen.webp',
    ];

    $near = $near->take(3)->map(function ($item) use ($pages, $shots, $schools) {
        $shot = $pages[$item['url']]['gallery'][0] ?? null;

        if (!$shot) {
            $school = collect($schools)->search(fn ($list) => collect($list)->contains('url', $item['url']));
            $shot = $shots[$school] ?? '/assets/barista.webp';
        }

        return $item + ['shot' => $shot];
    });
@endphp

@if ($near->isNotEmpty())
    <section class="ab-near ab-reveal">
        <div class="ab-container">
            <div class="ab-near__head">
                <div>
                    <h2 class="ab-h2">Рядом в этом направлении</h2>
                    <p class="ab-lead">Можно пройти по отдельности или взять вместе со скидкой.</p>
                </div>
                <a class="ab-near__all" href="/courses.html">
                    Все программы
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h13"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>

            <ul class="ab-near__list">
                @foreach ($near as $item)
                    <li class="ab-near__row">
                        <a class="ab-near__media" href="{{ $item['url'] }}" tabindex="-1" aria-hidden="true">
                            <img src="{{ $item['shot'] }}" alt="" width="320" height="200"
                                 loading="lazy" decoding="async">
                        </a>

                        <div class="ab-near__body">
                            <h3 class="ab-near__title">
                                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                            </h3>
                            <p class="ab-near__desc">{{ $item['desc'] ?? '' }}</p>
                        </div>

                        <div class="ab-near__meta">
                            @if (!empty($item['duration']))
                                <span>{{ $item['duration'] }}</span>
                            @endif
                            @if (!empty($item['format']))
                                <span>{{ $item['format'] }}</span>
                            @endif
                        </div>

                        <div class="ab-near__price">
                            @if (!empty($item['old']))
                                <s>{{ number_format($item['old'], 0, ',', ' ') }} ₽</s>
                            @endif
                            @if (!empty($item['price']))
                                <b>{{ number_format($item['price'], 0, ',', ' ') }} ₽</b>
                            @endif
                        </div>

                        <a class="ab-btn ab-btn--outline ab-near__go" href="{{ $item['url'] }}">Подробнее</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif
