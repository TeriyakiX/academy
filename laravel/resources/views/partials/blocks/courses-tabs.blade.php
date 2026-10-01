@php
    /* Направления из каталога плюс услуги для бизнеса: клиент просил
       показывать их в том же блоке, отдельной вкладкой. У услуг свои
       снимки, поэтому карточка берёт фото из данных. */
    $schools = config('courses.schools');

    $schools['Для бизнеса'] = collect(config('business.items', []))
        ->map(fn ($item) => [
            'id'       => $item['slug'],
            'title'    => $item['title'],
            'desc'     => $item['text'] ?? ($item['short'] ?? ''),
            'price'    => $item['price'] ?? null,
            'url'      => $item['url'],
            'duration' => $item['duration'] ?? null,
            'format'   => 'Услуга для заведения',
            'photo'    => $item['image'] ?? null,
        ])
        ->values()
        ->all();
@endphp

<section class="ab-programs ab-reveal">
    <div class="ab-container">
        <div class="ab-programs__head">
            <div>
                <h2 class="ab-h2">Ваши задачи — наши курсы</h2>
                <p class="ab-lead">
                    От первого дня за кофемашиной до управления кофейней. Обновляем курсы так же быстро,
                    как меняется рынок. Внутри учебных программ — реальные кейсы и задачи в HoReCa.
                </p>
            </div>
        </div>

        <div data-island="CourseTabs"
             data-props="{{ json_encode(['schools' => $schools], JSON_UNESCAPED_UNICODE) }}"></div>
    </div>
</section>
