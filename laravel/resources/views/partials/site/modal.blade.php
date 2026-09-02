{{-- Единая модалка заявки. Подключается в layout, поэтому доступна на всех страницах.
     Кнопки открывают её через data-modal-path="consultation". --}}
<div class="ab-modal" data-modal-target="consultation" hidden>
    <div class="ab-modal__overlay" data-modal-close></div>

    <div class="ab-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="ab-modal-title">
        <button class="ab-modal__close" type="button" data-modal-close aria-label="Закрыть">&times;</button>

        <h2 class="ab-modal__title" id="ab-modal-title">Оставить заявку</h2>
        <p class="ab-modal__text">
            Перезвоним в течение 15 минут в рабочее время и поможем выбрать программу.
        </p>

        <form class="ab-modal__form" method="post" action="/lead">
            @csrf
            <input type="hidden" name="source" value="Модальное окно">
            <input type="hidden" name="page" value="{{ request()->getPathInfo() }}">

            <label class="ab-modal__field">
                <span>Как вас зовут</span>
                <input type="text" name="name" placeholder="Имя" required autocomplete="name">
            </label>

            <label class="ab-modal__field">
                <span>Телефон для связи</span>
                <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required autocomplete="tel">
            </label>

            <label class="ab-modal__field">
                <span>Комментарий <i>— необязательно</i></span>
                <textarea name="comment" rows="2" placeholder="Какой курс интересует"></textarea>
            </label>

            <button class="ab-btn ab-btn--primary ab-btn--block ab-btn--lg" type="submit">Отправить</button>

            <p class="ab-modal__note">
                Нажимая кнопку, вы соглашаетесь с
                <a href="/privacy-policy.html" target="_blank">политикой конфиденциальности</a>
            </p>
        </form>
    </div>
</div>
