@php $pitch = $course['pitch'] ?? null; @endphp

{{--
    «Зачем и кому» — первый блок после шапки.

    Человек, открывший страницу курса, решает один вопрос: это про меня
    или нет. Поэтому сначала задача, потом аудитория, потом три главных
    навыка. Всё опирается на программу ниже, обещаний сверх неё нет.
--}}
@if ($pitch)
    <section class="ab-cwhy ab-reveal">
        <div class="ab-container">
            <div class="ab-cwhy__grid">
                @if (!empty($pitch['why']))
                    <div class="ab-cwhy__card">
                        <span class="ab-cwhy__label">Зачем этот курс</span>
                        <p class="ab-cwhy__text">{{ $pitch['why'] }}</p>
                    </div>
                @endif

                @if (!empty($pitch['who']))
                    <div class="ab-cwhy__card ab-cwhy__card--who">
                        <span class="ab-cwhy__label">Кому подойдёт</span>
                        <p class="ab-cwhy__text">{{ $pitch['who'] }}</p>
                    </div>
                @endif
            </div>

            @if (!empty($pitch['points']))
                <ul class="ab-cwhy__points">
                    @foreach ($pitch['points'] as $point)
                        <li>
                            <b>{{ $point['title'] }}</b>
                            <span>{{ $point['text'] }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
@endif
