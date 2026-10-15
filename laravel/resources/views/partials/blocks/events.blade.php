<section class="ab-events ab-reveal">
    <div class="ab-container">
        <div class="ab-events__head">
            <div>
                <h2 class="ab-h2">Приходите на встречи</h2>
                <p class="ab-lead">
                    Окунитесь в атмосферу Академии на мастер-классе
                    или просто <a href="#contacts">приходите на экскурсию</a>.
                </p>
            </div>
            <a class="ab-btn ab-btn--outline" href="/events.html">Расписание встреч</a>
        </div>

        <div data-island="EventsSchedule"
             data-props="{{ json_encode(['months' => \App\Support\Meetings::months()], JSON_UNESCAPED_UNICODE) }}"></div>
    </div>
</section>
