@php $t = config('home.teachers'); @endphp

{{--
    Преподаватели.

    Раньше был тёмный слайдер: тренеров всего трое, а листать их
    приходилось по одному. Теперь светлый блок, все на виду сразу —
    и оформление не повторяет чужие сайты.
--}}
<section class="ab-team ab-reveal">
    <div class="ab-container">
        <h2 class="ab-h2">{{ $t['title'] }}</h2>
        <p class="ab-lead">{{ $t['lead'] }}</p>

        <ul class="ab-team__grid">
            @foreach ($t['items'] as $person)
                <li class="ab-team__card">
                    <img class="ab-team__photo" src="{{ $person['photo'] }}" alt="{{ $person['name'] }}"
                         width="360" height="440" loading="lazy" decoding="async">

                    <div class="ab-team__body">
                        <h3 class="ab-team__name">{{ $person['name'] }}</h3>
                        <p class="ab-team__role">{{ $person['role'] }}</p>

                        @if (!empty($person['experience']))
                            <p class="ab-team__exp">{{ $person['experience'] }}</p>
                        @endif

                        @if (!empty($person['skills']))
                            <ul class="ab-team__skills">
                                @foreach ($person['skills'] as $skill)
                                    <li>{{ $skill }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>
