<section class="ab-dirs ab-reveal">
    <div class="ab-container">
        <h2 class="ab-h2">Основные направления обучения</h2>
        <p class="ab-lead">Все программы школы — можно перейти сразу к нужной.</p>

        <ul class="ab-dirs__list">
            @foreach (config('courses.schools') as $school => $courses)
                <li class="ab-dirs__group">
                    <span class="ab-dirs__group-title">{{ $school }}</span>
                    <ul class="ab-dirs__tags">
                        @foreach ($courses as $c)
                            <li><a href="{{ $c['url'] }}">{{ $c['title'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</section>
