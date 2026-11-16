{{--
    Нижняя панель на телефоне: позвонить и записаться.

    Шапка закреплена, но до её кнопок палец тянется через весь экран.
    Внизу они под большим пальцем, поэтому две главные точки — звонок
    и заявка — вынесены сюда. На широких экранах панели нет: там
    хватает закреплённой шапки.

    Панель скрыта от чтения с экрана как повтор: те же действия уже
    есть в шапке, дважды озвучивать их незачем.
--}}
<div class="ab-bar" data-mobile-bar>
    <a class="ab-bar__btn ab-bar__btn--call" href="{{ config('nav.contacts.phone_href') }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6.6 10.8a15 15 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25c1.1.37 2.3.57 3.6.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.3.2 2.5.57 3.6a1 1 0 0 1-.25 1l-2.2 2.2Z"/>
        </svg>
        Позвонить
    </a>

    <button class="ab-bar__btn ab-bar__btn--lead js-open-modal" type="button" data-modal-path="consultation">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 5v14M5 12h14"/>
        </svg>
        Записаться
    </button>
</div>
