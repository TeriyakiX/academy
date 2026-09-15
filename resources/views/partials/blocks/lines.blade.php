@php $lines = config('home.lines'); @endphp

@if (!empty($lines['items']))
    {{-- Чем занимается школа кроме курсов: оборудование и запуск кофеен.
         Раньше об этом можно было узнать только из меню. --}}
    <section class="ab-lines ab-reveal">
        <div class="ab-container">
            <div class="ab-lines__head">
                <h2 class="ab-h2">{{ $lines['title'] }}</h2>
                <p class="ab-lead">{{ $lines['lead'] }}</p>
            </div>

            <ul class="ab-lines__list">
                @foreach ($lines['items'] as $item)
                    <li class="ab-lines__item">
                        <a class="ab-lines__card" href="{{ $item['href'] }}">
                            <span class="ab-lines__tag">{{ $item['tag'] }}</span>

                            <b class="ab-lines__title">{{ $item['title'] }}</b>
                            <span class="ab-lines__text">{{ $item['text'] }}</span>

                            <span class="ab-lines__foot">
                                <i>{{ $item['note'] }}</i>
                                <span class="ab-lines__go">
                                    Перейти
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M5 12h13m-5-6 6 6-6 6" fill="none" stroke="currentColor"
                                              stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif
