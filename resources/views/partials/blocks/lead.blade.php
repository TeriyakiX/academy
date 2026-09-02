<section class="ab-lead-block">
    <div class="ab-container">
        <div class="ab-lead-block__inner">

            {{-- Превью входящего звонка --}}
            <div class="ab-lead-block__phone" aria-hidden="true">
                <div class="ab-phone">
                    <div class="ab-phone__top">9:41</div>
                    <div class="ab-phone__caller">
                        <img src="/assets/logo.png" alt="" width="44" height="44">
                        <div>
                            <strong>Академия Бариста</strong>
                            <span>входящий звонок</span>
                        </div>
                    </div>
                    <div class="ab-phone__actions">
                        <span class="ab-phone__btn ab-phone__btn--decline">✕</span>
                        <span class="ab-phone__btn ab-phone__btn--accept">✆</span>
                    </div>
                </div>
            </div>

            <div class="ab-lead-block__form">
                <h2 class="ab-h2 ab-h2--light">Не знаете, что выбрать?</h2>
                <p class="ab-lead-block__promise">
                    Перезвоним в течение 15 минут<br>
                    ежедневно с {{ str_replace('Пн-Вс ', '', config('nav.contacts.hours')) }}
                </p>
                <p class="ab-lead-block__text">
                    Расскажем про программы, сроки и стоимость, поможем подобрать курс под вашу цель.
                </p>

                <form class="ab-lead-form" method="post" action="/lead">
                    @csrf
                    <input type="hidden" name="source" value="Главная — блок «Не знаете, что выбрать»">
                    <label class="ab-lead-form__field">
                        <span class="ab-visually-hidden">Имя</span>
                        <input type="text" name="name" placeholder="Имя" required autocomplete="name">
                    </label>
                    <label class="ab-lead-form__field">
                        <span class="ab-visually-hidden">Телефон</span>
                        <input type="tel" name="phone" placeholder="Телефон" required autocomplete="tel">
                    </label>
                    <button class="ab-btn ab-btn--accent" type="submit">Отправить</button>
                    <p class="ab-lead-form__note">
                        Нажимая кнопку, вы соглашаетесь с
                        <a href="/privacy-policy.html">политикой конфиденциальности</a>
                    </p>
                </form>
            </div>

        </div>
    </div>
</section>
