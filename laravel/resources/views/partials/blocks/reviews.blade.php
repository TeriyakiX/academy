<section class="ab-reviews ab-reveal">
    <div class="ab-container">
        <div class="ab-reviews__head">
            <div>
                <h2 class="ab-h2">Отзывы учеников</h2>
                <p class="ab-lead">Реальные отзывы с Яндекс Карт — от тех, кто уже прошёл обучение.</p>
            </div>
            <a class="ab-btn ab-btn--outline" href="https://yandex.ru/maps/org/39301833905/reviews"
               target="_blank" rel="noopener">Все отзывы на Картах</a>
        </div>

        <div data-island="Reviews"
             data-props="{{ json_encode(['reviews' => config('home.reviews.items')], JSON_UNESCAPED_UNICODE) }}"></div>
    </div>
</section>
