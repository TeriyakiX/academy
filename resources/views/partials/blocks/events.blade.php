<section class="ab-events ab-reveal">
    <div class="ab-container">
        <div class="ab-events__head">
            <div>
                <h2 class="ab-h2">Расписание мероприятий</h2>
                <p class="ab-lead">Открытые мастер-классы и встречи — можно прийти без записи на курс.</p>
            </div>
            <a class="ab-btn ab-btn--outline" href="{{ config('nav.contacts.phone_href') }}">Узнать даты</a>
        </div>

        <div data-island="EventsSchedule"
             data-props="{{ json_encode(['months' => config('home.events.months')], JSON_UNESCAPED_UNICODE) }}"></div>
    </div>
</section>
