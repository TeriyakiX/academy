@php
    $doc = config('documents');
    $lic = $doc['items'][0] ?? [];
    /* Показываем свойства свидетельства, кроме тех, что ещё в разработке. */
    $details = collect($doc['details']['items'] ?? [])->reject(fn ($i) => !empty($i['demo']))->values();
@endphp

{{--
    Документ об обучении на странице курса.

    Слева наш собственный бланк — тот же, по которому школа выписывает
    сертификаты выпускникам, с подставленным названием программы.
    Реквизиты лицензии настоящие, из config/documents.php.
--}}
<section class="ab-cdoc ab-reveal">
    <div class="ab-container">
        <div class="ab-cdoc__grid">
            <div class="ab-cdoc__paper">
                @include('partials.certificate-paper', ['program' => $course['title']])
                <span class="ab-cdoc__caption">Образец: так выглядит сертификат Академии</span>
            </div>

            <div class="ab-cdoc__body">
                <h2 class="ab-h2">Сертификат после курса</h2>
                <p class="ab-cdoc__lead">{{ $doc['lead'] }}</p>

                {{-- Подробности про свидетельство раскрываются: сразу развёрнутыми
                     они вытягивали блок на полтора экрана телефона. --}}
                <details class="ab-cdoc__more">
                    <summary>Что в свидетельстве по образовательной лицензии</summary>

                    <ul class="ab-cdoc__list">
                        @foreach ($details as $item)
                            <li>
                                <b>{{ $item['title'] }}</b>
                                <span>{{ $item['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </details>

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
