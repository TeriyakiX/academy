<section class="ab-lead-block ab-reveal">
    <div class="ab-container">
        <div class="ab-lead-block__inner">

            <div class="ab-lead-block__text">
                <h2 class="ab-h2 ab-h2--light">Поможем выбрать курс</h2>
                <p class="ab-lead-block__promise"><span>15 минут</span> — среднее время ответа менеджера</p>
                <p class="ab-lead-block__note">
                    Расскажем про программы, сроки и стоимость, подберём вариант под вашу цель и уровень.
                </p>

                <ul class="ab-lead-block__list">
                    <li>Подберём программу под ваш опыт</li>
                    <li>Расскажем про даты и свободные места</li>
                    <li>Посчитаем стоимость со скидкой за объём</li>
                </ul>

                <a class="ab-lead-block__phone" href="{{ config('nav.contacts.phone_href') }}">
                    {{ config('nav.contacts.phone') }}
                    <span>{{ config('nav.contacts.hours') }}</span>
                </a>
            </div>

            <form class="ab-lead-form" method="post" action="/lead">
                @csrf
                <input type="hidden" name="source" value="Блок «Поможем выбрать курс»">

                <label class="ab-lead-form__field">
                    <span class="ab-lead-form__label">Как вас зовут</span>
                    <input type="text" name="name" placeholder="Имя" required autocomplete="name">
                </label>

                <label class="ab-lead-form__field">
                    <span class="ab-lead-form__label">Телефон для связи</span>
                    <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required autocomplete="tel">
                </label>

                <button class="ab-btn ab-btn--primary ab-btn--block ab-btn--lg" type="submit">
                    Оставить заявку
                </button>

                <p class="ab-lead-form__note">
                    Нажимая кнопку, вы соглашаетесь с
                    <a href="/privacy-policy.html">политикой конфиденциальности</a>
                </p>
            </form>

        </div>
    </div>
</section>
