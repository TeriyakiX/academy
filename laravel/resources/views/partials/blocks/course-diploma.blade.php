@php
    $doc = config('documents');
    $lic = $doc['items'][0] ?? [];
    /* Показываем свойства свидетельства, кроме тех, что ещё в разработке. */
    $details = collect($doc['details']['items'] ?? [])->reject(fn ($i) => !empty($i['demo']))->values();

    /* Мастер-класс — не программа повышения квалификации: разряд по нему
       не присваивают, поэтому этот пункт показывать нельзя. */
    $details = $details->reject(fn ($i) => ($course['school'] ?? '') === 'Мастер-классы'
        && str_contains(mb_strtolower($i['title']), 'квалификац'))->values();

    /*
     | Документ зависит от программы.
     |
     | Курсы идут по образовательной лицензии: выпускник получает
     | свидетельство о повышении квалификации на типографском бланке,
     | сразу в двух версиях — русской и английской.
     |
     | Мастер-класс — не программа повышения квалификации, по нему
     | выдаётся свидетельство о прохождении обучения. Обещать здесь
     | повышение квалификации нельзя.
     */
    $isClass = ($course['school'] ?? '') === 'Мастер-классы';

    $papers = $isClass
        ? [['src' => '/assets/docs/svidetelstvo-mk.jpg', 'caption' => 'Свидетельство о прохождении обучения']]
        : [
            ['src' => '/assets/docs/svidetelstvo-ru.jpg', 'caption' => 'Русская версия'],
            ['src' => '/assets/docs/svidetelstvo-en.jpg', 'caption' => 'Английская версия'],
        ];

    $heading = $isClass ? 'Свидетельство о прохождении обучения' : 'Свидетельство о повышении квалификации';

    $lead = $isClass
        ? 'После мастер-класса выдаём свидетельство о прохождении обучения на типографском бланке — '
          . 'с названием программы, датами и количеством часов.'
        : 'После курса выдаём свидетельство о повышении квалификации на типографском бланке — '
          . 'сразу в двух версиях, на русском и английском языке. Английская нужна тем, кто '
          . 'планирует работать за границей: имя и фамилия в ней пишутся в международной транслитерации.';
@endphp

{{--
    Документ об обучении на странице курса.

    Слева — снимки настоящих бланков школы (образцы, без данных).
    Реквизиты лицензии настоящие, из config/documents.php.
--}}
<section class="ab-cdoc ab-reveal">
    <div class="ab-container">
        <div class="ab-cdoc__grid">
            <div @class(['ab-cdoc__papers', 'is-pair' => count($papers) > 1])>
                @foreach ($papers as $paper)
                    <figure class="ab-cdoc__paper">
                        {{-- Бланк накрыт прозрачным слоем: правый клик попадает
                             на него, а не на снимок, поэтому в меню браузера нет
                             «Сохранить картинку». Снимок остаётся <img> — ради
                             alt и отложенной загрузки. --}}
                        <span class="ab-cdoc__shot">
                            <img src="{{ $paper['src'] }}" alt="{{ $heading }} — {{ $paper['caption'] }}"
                                 width="760" height="1102" loading="lazy" decoding="async"
                                 draggable="false">
                            <span class="ab-cdoc__shield" aria-hidden="true"></span>
                        </span>

                        <figcaption class="ab-cdoc__caption">{{ $paper['caption'] }}</figcaption>
                    </figure>
                @endforeach
            </div>

            <div class="ab-cdoc__body">
                <h2 class="ab-h2">{{ $heading }}</h2>
                <p class="ab-cdoc__lead">{{ $lead }}</p>

                {{-- Раскрывающийся список убран: при раскрытии реквизиты под
                     ним съезжали вниз и блок прыгал. Пунктов два, они короткие —
                     показываем сразу. --}}
                <div class="ab-cdoc__more">
                    <b class="ab-cdoc__more-title">
                        {{ $isClass ? 'Что это за документ' : 'Что в свидетельстве по образовательной лицензии' }}
                    </b>

                    <ul class="ab-cdoc__list">
                        @foreach ($details as $item)
                            <li>
                                <b>{{ $item['title'] }}</b>
                                <span>{{ $item['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if (!empty($lic['meta']))
                    <dl class="ab-cdoc__meta">
                        @foreach (array_slice($lic['meta'], 0, 2, true) as $key => $value)
                            <div>
                                <dt>{{ $key }}</dt>
                                <dd>{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                @endif

                <p class="ab-cdoc__note">
                    На снимках — образцы бланков без данных.
                    @if (!empty($lic['file']))
                        <a href="{{ $lic['file'] }}" target="_blank" rel="noopener">Выписка из реестра лицензий</a>
                    @endif
                </p>
            </div>
        </div>
    </div>
</section>
