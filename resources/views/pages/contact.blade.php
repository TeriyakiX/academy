@extends('layouts.app')
@section('content')



<div class="wrapper">
    @include('partials.site.header')
    
    
    <div class="bread-crumbs">
        <div class="bread-crumbs__container container">
            <nav class="bread-crumbs__nav">
                <ul class="bread-crumbs__nav-list">
                    <li class="bread-crumbs__nav-item"><a class="bread-crumbs__nav-link text-regular text-link" href="/">Главная</a></li>
                    <span class="bread-crumbs__nav-arrow text-regular">&gt;</span>
                    <li class="bread-crumbs__nav-item"><a class="bread-crumbs__nav-link bread-crumbs__nav-link-is-active text-regular" href="/contact.html">Контакты</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <main class="body">
        <section class="hero">
            <div class="hero__container container"><h1 class="hero__title heading-title-general">Контакты</h1>
                <div class="hero__content">
                    <div class="hero__left">
                        <div class="hero__card"><h3 class="hero__card-title heading-title-name">Всегда на связи!</h3>
                            <ul class="hero__list">
                                <li class="hero__item"><span class="hero__label text-medium">Телефон</span> <a class="hero__link text-regular" href="#">+7 (925) 152-28-66</a></li>
                                <li class="hero__item"><span class="hero__label text-medium">Whatsapp</span> <a class="hero__link text-regular" href="https://Wa.me/79251522866">+7 (925)
                                    152-28-66</a></li>
                                <li class="hero__item"><span class="hero__label text-medium">E-mail</span> <a class="hero__link text-regular" href="#">consulting@academy-barista.ru</a></li>
                                <li class="hero__item"><span class="hero__label text-medium">Адрес</span>
                                    <p class="hero__description text-regular">г.Москва, Фридриха Энгельса, 25с7</p></li>
                                <li class="hero__item"><span class="hero__label text-medium">Время работы</span> <a class="hero__link text-regular" href="#">Пн-Вс 10:00 – 20:00</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="hero__maps" id="map"></div>
                </div>
            </div>
        </section>
        <section class="social main-section">
            <div class="social__container container">
                <div class="social__card"><h2 class="social__title heading-title-section">Не забудь подписаться на
                    социальные сети !</h2>
                    <div class="social__slider splide">
                        <div class="social__track splide__track">
                            <div class="social__content splide__list">
                                <div class="social__col splide__slide"><img width="400" src="/assets/12.png" alt="">
                                    <div class="social__col-info"><h3 class="social__col-name text-medium">Ютуб
                                        канал</h3>
                                        <p class="social__col-description">Для тех, кто уже в индустрии — владельцев
                                            кофеен, кафе, кондитерских, бариста, управляющих, тренеров, обжарщиков и
                                            маркетологов.</p><a class="social__col-link button button-white" href="https://www.youtube.com/@academybarista" target="_blank">Подписаться</a></div>
                                </div>
                                <div class="social__col splide__slide"><img width="400" src="/assets/22.png" alt="">
                                    <div class="social__col-info"><h3 class="social__col-name text-medium">Телеграм
                                        канал</h3>
                                        <p class="social__col-description">Для тех, кто уже в индустрии — владельцев
                                            кофеен, кафе, кондитерских, бариста, управляющих, тренеров, обжарщиков и
                                            маркетологов.</p><a class="social__col-link button button-white" href="https://t.me/academybarista" target="_blank">Подписаться</a>
                                    </div>
                                </div>
                                <div class="social__col splide__slide"><img width="400" src="/assets/32.png" alt="">
                                    <div class="social__col-info"><h3 class="social__col-name text-medium">Группа
                                        Вконтакте</h3>
                                        <p class="social__col-description">Для тех, кто уже в индустрии — владельцев
                                            кофеен, кафе, кондитерских, бариста, управляющих, тренеров, обжарщиков и
                                            маркетологов.</p><a class="social__col-link button button-white" href="https://vk.com/academybarista1" target="_blank">Подписаться</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('partials.site.footer')
    <div class="modal">
        <div class="modal__overlay">
            <div class="modal__inner">
                <div class="modal__window">
                    <div class="modal__title heading-title-section">Оставьте заявку</div>
                    <button class="modal__close">
                        <svg role="presentation" class="t-popup__close-icon" width="23px" height="23px" viewbox="0 0 23 23" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g stroke="none" stroke-width="1" fill="#fff" fill-rule="evenodd">
                                <rect transform="translate(11.313708, 11.313708) rotate(-45.000000) translate(-11.313708, -11.313708) " x="10.3137085" y="-3.6862915" width="2" height="30"></rect>
                                <rect transform="translate(11.313708, 11.313708) rotate(-315.000000) translate(-11.313708, -11.313708) " x="10.3137085" y="-3.6862915" width="2" height="30"></rect>
                            </g>
                        </svg>
                    </button>
                    <form class="modal__form form" action=""><label class="modal__form-label form__label" for=""><input class="modal__form-input form__input form-name" name="Имя" type="text" placeholder="Ваше имя"></label> <label class="modal__form-label form__label" for=""><input class="modal__form-input form__input form-phone" name="Телефон" type="tel" placeholder="Телефон"></label> <label class="modal__form-label form__label" for=""><input class="modal__form-input form__input form-email" name="Email" type="email" placeholder="Email"></label> <textarea class="modal__form-textarea form__textarea" placeholder="Ваше сообщение" name="Сообщение"></textarea>
                        <button class="modal__form-button form__button button button-brown" type="submit">Оставить
                            заявку
                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <div class="contact__form-chek form__chek">
                            <div>
                                <input class="contact__form-checkbox form__chek-chekbox" type="checkbox" required>
                                <span class="contact__form-text form__chek-text text-regular">
                                Согласен на обработку
                                <a href="/privacy-policy.html">персональных данных</a>
                            </span>
                            </div>
                        </div>
                        <input type="hidden" class="form-purpose" value="Тип заявки: Страница контакты"></form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
