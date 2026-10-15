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
            <a class="ab-btn ab-btn--outline" href="/events.html">Все встречи</a>
        </div>

        {{-- Тот же вид афиш, что и на странице встреч: на главной показываем
             только ближайшие, прошедшие там ни к чему. --}}
        @include('partials.blocks.events-posters', ['limit' => 3, 'withPast' => false])
    </div>
</section>