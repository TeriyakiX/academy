@extends('layouts.app')
@section('content')



<div class="wrapper">
    @include('partials.site.header')
    
    
    <main class="main">
        <section class="thank-you main-section">
            <div class="thank-you__container container">
                <div class="thank-you__card">
                    <div class="thank-you__info"><h1 class="thank-you__title heading-title-section">Заявка успешно
                        отправлена !</h1>
                        <p class="thank-you__description text-medium">Наш менеджер свяжется с вами в ближайшее время и
                            ответит<br>на все интересующие вас вопросы.</p></div>
                    <div class="thank-you__social"><h3 class="thank-you__social-title heading-title-name">А пока
                        подпишитесь на наши соц.сети,<br>чтобы всегдя быть на связи:</h3>
                        <ul class="thank-you__social-list">
                            <li class="thank-you__social-item"><a class="thank-you__social-link" href="https://t.me/academybarista" target="_blank" title="https://t.me/academybarista">
                                <svg class="thank-you__social-icon" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 496 512">
                                    <path d="M248 8C111 8 0 119 0 256S111 504 248 504 496 393 496 256 385 8 248 8zM363 176.7c-3.7 39.2-19.9 134.4-28.1 178.3-3.5 18.6-10.3 24.8-16.9 25.4-14.4 1.3-25.3-9.5-39.3-18.7-21.8-14.3-34.2-23.2-55.3-37.2-24.5-16.1-8.6-25 5.3-39.5 3.7-3.8 67.1-61.5 68.3-66.7 .2-.7 .3-3.1-1.2-4.4s-3.6-.8-5.1-.5q-3.3 .7-104.6 69.1-14.8 10.2-26.9 9.9c-8.9-.2-25.9-5-38.6-9.1-15.5-5-27.9-7.7-26.8-16.3q.8-6.7 18.5-13.7 108.4-47.2 144.6-62.3c68.9-28.6 83.2-33.6 92.5-33.8 2.1 0 6.6 .5 9.6 2.9a10.5 10.5 0 0 1 3.5 6.7A43.8 43.8 0 0 1 363 176.7z"></path>
                                </svg>
                            </a></li>
                            <li class="thank-you__social-item"><a class="thank-you__social-link" href="https://t.me/academybarista" target="_blank" title="https://t.me/academybarista">
                                <svg class="thank-you__social-icon" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                                    <path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"></path>
                                </svg>
                            </a></li>
                            <li class="thank-you__social-item"><a class="thank-you__social-link" href="https://t.me/academybarista" target="_blank" title="https://t.me/academybarista">
                                <svg class="thank-you__social-icon" xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 24 24">
                                    <path fill="currentColor" d="M23.456 5.784a8.605 8.605 0 0 1-1.09 2.259l.019-.03q-.672 1.12-1.605 2.588q-.8 1.159-.847 1.2a1.28 1.28 0 0 0-.267.618l-.001.007a.897.897 0 0 0 .268.535l.4.446q3.21 3.299 3.611 4.548a.89.89 0 0 1-.112.829l.002-.003a.965.965 0 0 1-.784.289h.004h-2.636c-.337 0-.647-.118-.89-.314l.003.002a6.928 6.928 0 0 1-.951-.948l-.009-.012q-.691-.781-1.226-1.315q-1.782-1.694-2.63-1.694a.788.788 0 0 0-.516.135l.003-.002a.767.767 0 0 0-.16.584v-.004a12.532 12.532 0 0 0-.038 1.403v-.017v1.159a.78.78 0 0 1-.266.757l-.001.001a3.179 3.179 0 0 1-1.617.267l.013.001a8.323 8.323 0 0 1-4.275-1.268l.035.02A11.931 11.931 0 0 1 4.176 14.3l-.027-.042a26.36 26.36 0 0 1-2.471-3.992l-.07-.154A24.657 24.657 0 0 1 .375 7.31l-.06-.185a6.646 6.646 0 0 1-.31-1.535l-.002-.025q0-.758.892-.758h2.63a1.058 1.058 0 0 1 .739.225l-.002-.002c.2.219.348.488.421.788l.003.012a25.422 25.422 0 0 0 1.587 3.615l-.067-.137a14.56 14.56 0 0 0 1.623 2.576l-.023-.031q.8.982 1.248.982l.032.001a.4.4 0 0 0 .347-.2l.001-.002a1.783 1.783 0 0 0 .111-.787v.006v-3.879a3.211 3.211 0 0 0-.32-1.267l.008.019a2.956 2.956 0 0 0-.45-.695l.003.004a1.099 1.099 0 0 1-.311-.619l-.001-.006c0-.17.078-.323.2-.423l.001-.001a.678.678 0 0 1 .46-.178h4.154a.634.634 0 0 1 .559.222l.001.001a1.36 1.36 0 0 1 .159.763v-.005v5.173a.993.993 0 0 0 .136.584l-.002-.004a.401.401 0 0 0 .333.178h.001a.946.946 0 0 0 .471-.162l-.003.002c.272-.187.506-.4.709-.641l.004-.005a15.606 15.606 0 0 0 1.655-2.25l.039-.07c.344-.57.716-1.272 1.053-1.993l.062-.147l.446-.892a1.122 1.122 0 0 1 1.117-.759h-.003h2.631q1.066 0 .8.981z"></path>
                                </svg>
                            </a></li>
                        </ul>
                    </div>
                    <a class="thank-you__link text-medium" href="/">вернуться на главную</a>
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
                        <input type="hidden" class="form-purpose" value="Тип заявки: Главная страница"></form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
