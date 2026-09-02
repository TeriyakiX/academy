<section class="ab-dirs ab-reveal">
    <div class="ab-container">
        <div class="ab-dirs__head">
            <h2 class="ab-h2">Все программы школы</h2>
            <a class="ab-btn ab-btn--outline ab-btn--sm" href="/courses.html">Открыть каталог</a>
        </div>

        <div class="ab-dirs__cols">
            @foreach (config('courses.schools') as $school => $courses)
                <div class="ab-dirs__col">
                    <h3 class="ab-dirs__col-title">{{ $school }}</h3>
                    <ul class="ab-dirs__links">
                        @foreach ($courses as $c)
                            <li>
                                <a href="{{ $c['url'] }}">
                                    <span>{{ $c['title'] }}</span>
                                    <b>{{ number_format($c['price'], 0, ',', ' ') }} ₽</b>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
