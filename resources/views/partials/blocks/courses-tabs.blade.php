<section class="ab-programs ab-reveal">
    <div class="ab-container">
        <div class="ab-programs__head">
            <div>
                <h2 class="ab-h2">Программы и курсы</h2>
                <p class="ab-lead">
                    От первого дня за кофемашиной до управления кофейней.
                    Выберите направление — и мы подберём программу под ваш уровень.
                </p>
            </div>
        </div>

        <div data-island="CourseTabs"
             data-props="{{ json_encode(['schools' => config('courses.schools')], JSON_UNESCAPED_UNICODE) }}"></div>
    </div>
</section>
