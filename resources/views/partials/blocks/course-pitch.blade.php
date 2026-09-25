@php $pitch = $course['pitch'] ?? null; @endphp

{{--
    «Зачем и кому» — первый блок после шапки.

    Раньше два абзаца целиком занимали экран телефона. Теперь это
    раскрывающиеся строки: открыт только первый ответ, остальное
    человек открывает сам. Работает без JavaScript.
--}}
@if ($pitch)
    <section class="ab-cwhy ab-reveal">
        <div class="ab-container">
            <div class="ab-cwhy__list">
                @if (!empty($pitch['why']))
                    <details class="ab-cwhy__item" open>
                        <summary>Зачем этот курс</summary>
                        <p class="ab-cwhy__text">{{ $pitch['why'] }}</p>
                    </details>
                @endif

                @if (!empty($pitch['who']))
                    <details class="ab-cwhy__item">
                        <summary>Кому подойдёт</summary>
                        <p class="ab-cwhy__text">{{ $pitch['who'] }}</p>
                    </details>
                @endif

                @foreach ($pitch['points'] ?? [] as $point)
                    <details class="ab-cwhy__item">
                        <summary>{{ $point['title'] }}</summary>
                        <p class="ab-cwhy__text">{{ $point['text'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>
@endif
