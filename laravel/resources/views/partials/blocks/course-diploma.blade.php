@php
    $doc = config('documents');
    $lic = $doc['items'][0] ?? [];
    /* Показываем свойства свидетельства, кроме тех, что ещё в разработке. */
    $details = collect($doc['details']['items'] ?? [])->reject(fn ($i) => !empty($i['demo']))->values();
@endphp

{{--
    Документ об обучении на странице курса.

    Сканы свидетельства нет, и рисовать похожий на настоящий нельзя,
    поэтому слева схема бланка: что в нём написано. Реквизиты лицензии
    и ссылка на выписку — настоящие, из config/documents.php.
--}}
<section class="ab-cdoc ab-reveal">
    <div class="ab-container">
        <div class="ab-cdoc__grid">
            <div class="ab-cdoc__paper" aria-hidden="true">
                <span class="ab-cdoc__paper-tag">Свидетельство</span>
                <b class="ab-cdoc__paper-title">о профессии рабочего,<br>должности служащего</b>
                <span class="ab-cdoc__paper-line ab-cdoc__paper-line--name"></span>
                <span class="ab-cdoc__paper-note">присвоена квалификация</span>
                <span class="ab-cdoc__paper-line"></span>
                <span class="ab-cdoc__paper-line ab-cdoc__paper-line--short"></span>
                <span class="ab-cdoc__paper-seal"></span>
            </div>

            <div class="ab-cdoc__body">
                <h2 class="ab-h2">После курса — документ, а не картинка</h2>
                <p class="ab-cdoc__lead">{{ $doc['lead'] }}</p>

                <ul class="ab-cdoc__list">
                    @foreach ($details as $item)
                        <li>
                            <b>{{ $item['title'] }}</b>
                            <span>{{ $item['text'] }}</span>
                        </li>
                    @endforeach
                </ul>

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
                    {{ $doc['note'] }}
                    @if (!empty($lic['file']))
                        <a href="{{ $lic['file'] }}" target="_blank" rel="noopener">Выписка из реестра лицензий</a>
                    @endif
                </p>
            </div>
        </div>
    </div>
</section>
