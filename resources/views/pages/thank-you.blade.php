@extends('layouts.app')

@section('content')
<div class="wrapper">
<div class="mobile-menu__overlay">
</div>
<div class="mobile-menu">
<div class="mobile-menu__inner">
<div class="mobile-menu__head">
<a class="mobile-menu__logo logo" href="/">
<img src="/assets/logo.png" alt="Логотип">
</a>
<button class="mobile-menu__close">
<svg role="presentation" width="23px" height="23px" viewbox="0 0 23 23" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<g stroke="none" stroke-width="1" fill="#fff" fill-rule="evenodd">
<rect transform="translate(11.313708, 11.313708) rotate(-45.000000) translate(-11.313708, -11.313708) " x="10.3137085" y="-3.6862915" width="2" height="30">
</rect>
<rect transform="translate(11.313708, 11.313708) rotate(-315.000000) translate(-11.313708, -11.313708) " x="10.3137085" y="-3.6862915" width="2" height="30">
</rect>
</g>
</svg>
</button>
</div>
<nav class="mobile-menu__nav">
<ul class="mobile-menu__nav-list">
<li class="mobile-menu__nav-item">
<a class="mobile-menu__nav-link text-medium" href="/">Главная</a>
</li>
<li class="mobile-menu__nav-item">
<a class="mobile-menu__nav-link text-medium" href="/coming-soon.html">О нас</a>
</li>
<li class="mobile-menu__nav-item">
<a class="mobile-menu__nav-link text-medium" href="/courses.html">Курсы</a>
</li>
<li class="mobile-menu__nav-item">
<a class="mobile-menu__nav-link text-medium" href="/busines.html">Для бизнеса</a>
</li>
<li class="mobile-menu__nav-item">
<a class="mobile-menu__nav-link text-medium" href="/sertifikat.html">Сертификат</a>
</li>
<li class="mobile-menu__nav-item">
<a class="mobile-menu__nav-link text-medium" href="/blog.html">Блог</a>
</li>
<li class="mobile-menu__nav-item">
<a class="mobile-menu__nav-link text-medium" href="/contact.html">Контакты</a>
</li>
</ul>
</nav>
<nav class="mobile-menu__submenu">
<ul class="mobile-menu__submenu-list">
<li class="mobile-menu__submenu-item">
<div class="mobile-menu__submenu-switch mobile-menu__submenu-switch--barista">
<span class="text-medium">Курсы для Бариста</span>
<svg class="mobile-menu__submenu-switch-icon" width="14" height="8" viewbox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 1L7 7L13 1" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
</path>
</svg>
</div>
<ul class="mobile-menu__submenu-dropdown">
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/courses/barista-base.html">Бариста базовый</a>
</li>
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/courses/barista-advanced.html">Бариста
                                продвинутый</a>
</li>
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/courses/barista-technician.html">Бариста техник</a>
</li>
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/courses/barista-professional.html">Бариста
                                Professional</a>
</li>
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/courses/upravlyayushchiy-kofeyni.html">Управляющий
                                кофейни</a>
</li>
</ul>
</li>
<li class="mobile-menu__submenu-item">
<div class="mobile-menu__submenu-switch mobile-menu__submenu-switch--master">
<span class="text-medium">Мастер Класс</span>
<svg class="mobile-menu__submenu-switch-icon" width="14" height="8" viewbox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 1L7 7L13 1" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
</path>
</svg>
</div>
<ul class="mobile-menu__submenu-dropdown">
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/master-class/latte-art.html">Латте-Арт</a>
</li>
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/master-class/young-barista.html">Юный Бариста</a>
</li>
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/master-class/domashnyaya-kofeynya.html">Домашняя
                                кофейня</a>
</li>
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/master-class/barista-v-take-away.html">Бариста в
                                Take away</a>
</li>
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/master-class/domashniy-barista.html">Домашний
                                бариста</a>
</li>
</ul>
</li>
<li class="mobile-menu__submenu-item">
<div class="mobile-menu__submenu-switch mobile-menu__submenu-switch--bar">
<span class="text-medium">Барное дело</span>
<svg class="mobile-menu__submenu-switch-icon" width="14" height="8" viewbox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 1L7 7L13 1" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
</path>
</svg>
</div>
<ul class="mobile-menu__submenu-dropdown">
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/barnoe-delo/metod-ctir.html">Вкус и стиль: метод
                                Стир</a>
</li>
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/barnoe-delo/koktel-metodom-bild.html">Просто и
                                изысканно: Коктель методом "Билд"</a>
</li>
<li class="mobile-menu__submenu-dropdown-item">
<a class="mobile-menu__submenu-dropdown-link text-medium" href="/barnoe-delo/vstryakhni-i-poday.html">Магия
                                коктелей:<br>Встряхни и подай</a>
</li>
</ul>
</li>
</ul>
</nav>
<div class="mobile-menu__information">
<address class="mobile-menu__information-address">
<svg class="mobile-menu__information-address-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.5599 20.8207C12.2247 21.0598 11.7753 21.0598 11.4401 20.8207C6.61138 17.3773 1.48557 10.2971 6.6667 5.18128C8.08118 3.78463 9.99963 3 12 3C14.0004 3 15.9188 3.78463 17.3333 5.18128C22.5144 10.2971 17.3886 17.3773 12.5599 20.8207Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
</path>
<path d="M12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
</path>
</svg>
<span class="mobile-menu__information-address-text text-small">г.Москва, Фридриха Энгельса, 25с7</span>
</address>
<a class="mobile-menu__information-tel" href="tel:+7%20(925)%20152-28-66">
<svg class="mobile-menu__information-tel-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.6002 14.5215C13.2052 17.0421 7.09606 10.9878 9.50019 8.45753C10.9681 6.91263 9.30988 5.14707 8.39205 3.84934C6.66948 1.41378 2.88796 4.77641 3.0028 6.91544C3.36497 13.6609 10.6618 21.6546 17.7278 20.9574C19.9383 20.7393 22.4781 16.7471 19.9426 15.2882C18.6747 14.5587 16.9345 13.1172 15.6002 14.5215Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
</path>
<path d="M14 3C15.8565 3 17.637 3.7375 18.9497 5.05025C20.2625 6.36301 21 8.14348 21 10" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
</path>
<path d="M14 7C14.7956 7 15.5587 7.31607 16.1213 7.87868C16.6839 8.44129 17 9.20435 17 10" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
</path>
</svg>
<span class="mobile-menu__information-tel-number text-small">+7 (925) 152-28-66</span>
</a>
<a class="mobile-menu__information-email" href="mailto:consulting@academy-barista.ru">
<svg class="mobile-menu__information-email-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z" stroke="#DFDFEC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
</path>
<path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="#DFDFEC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
</path>
</svg>
<span class="mobile-menu__information-email-address text-small">consulting@academy-barista.ru</span>
</a>
</div>
<ul class="mobile-menu__social">
<li class="mobile-menu__social-item">
<a class="mobile-menu__social-link" href="https://t.me/academybarista" target="_blank">
<svg class="mobile-menu__social-icon" width="36" height="36" viewbox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="36" height="36" rx="18" fill="#33373E">
</rect>
<path fill-rule="evenodd" clip-rule="evenodd" d="M10.0996 16.5964C14.3931 14.7618 17.2561 13.5523 18.6886 12.968C22.7788 11.2995 23.6287 11.0097 24.1826 11.0001C24.3045 10.998 24.5769 11.0276 24.7533 11.1681C25.0151 11.3764 25.0166 11.8286 24.9875 12.1278C24.7659 14.4119 23.8068 19.9545 23.3189 22.5127C23.1124 23.5951 22.7059 23.9581 22.3124 23.9936C21.4571 24.0707 20.8076 23.4392 19.9792 22.9067C18.683 22.0733 17.9507 21.5545 16.6924 20.7414C15.2383 19.8016 16.1809 19.2851 17.0096 18.4409C17.2265 18.22 20.9949 14.8583 21.0678 14.5534C21.077 14.5152 21.0854 14.373 20.9993 14.298C20.9132 14.223 20.7861 14.2486 20.6944 14.269C20.5644 14.2979 18.4936 15.6403 14.482 18.2961C13.8942 18.6919 13.3618 18.8848 12.8848 18.8747C12.3589 18.8636 11.3474 18.5831 10.5954 18.3434C9.67309 18.0493 8.94002 17.8938 9.00388 17.3945C9.03713 17.1343 9.40234 16.8683 10.0996 16.5964Z" fill="white">
</path>
</svg>
</a>
<a class="mobile-menu__social-link" href="https://Wa.me/79251522866" target="_blank">
<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 50 50" width="30px" height="30px">
<path fill="#6b5a53" d="M25,2C12.318,2,2,12.318,2,25c0,3.96,1.023,7.854,2.963,11.29L2.037,46.73c-0.096,0.343-0.003,0.711,0.245,0.966 C2.473,47.893,2.733,48,3,48c0.08,0,0.161-0.01,0.24-0.029l10.896-2.699C17.463,47.058,21.21,48,25,48c12.682,0,23-10.318,23-23 S37.682,2,25,2z M36.57,33.116c-0.492,1.362-2.852,2.605-3.986,2.772c-1.018,0.149-2.306,0.213-3.72-0.231 c-0.857-0.27-1.957-0.628-3.366-1.229c-5.923-2.526-9.791-8.415-10.087-8.804C15.116,25.235,13,22.463,13,19.594 s1.525-4.28,2.067-4.864c0.542-0.584,1.181-0.73,1.575-0.73s0.787,0.005,1.132,0.021c0.363,0.018,0.85-0.137,1.329,1.001 c0.492,1.168,1.673,4.037,1.819,4.33c0.148,0.292,0.246,0.633,0.05,1.022c-0.196,0.389-0.294,0.632-0.59,0.973 s-0.62,0.76-0.886,1.022c-0.296,0.291-0.603,0.606-0.259,1.19c0.344,0.584,1.529,2.493,3.285,4.039 c2.255,1.986,4.158,2.602,4.748,2.894c0.59,0.292,0.935,0.243,1.279-0.146c0.344-0.39,1.476-1.703,1.869-2.286 s0.787-0.487,1.329-0.292c0.542,0.194,3.445,1.604,4.035,1.896c0.59,0.292,0.984,0.438,1.132,0.681 C37.062,30.587,37.062,31.755,36.57,33.116z">
</path>
</svg>
</a>
<a class="mobile-menu__social-link" href="https://vk.com/academybarista1" target="_blank">
<svg class="mobile-menu__social-icon" width="36" height="36" viewbox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="36" height="36" rx="18" fill="#282020">
</rect>
<path d="M18.7145 23C13.2479 23 10.1299 19.2462 10 13H12.7383C12.8282 17.5846 14.8469 19.5265 16.4459 19.9269V13H19.0244V16.954C20.6034 16.7838 22.2622 14.982 22.8218 13H25.4003C24.9705 15.4424 23.1717 17.2442 21.8925 17.985C23.1717 18.5856 25.2205 20.1572 26 23H23.1617C22.5521 21.0981 21.0332 19.6266 19.0244 19.4264V23H18.7145Z" fill="white">
</path>
</svg>
</a>
<a class="mobile-menu__social-link" href="https://youtube.com/@academybarista" target="_blank">
<svg class="mobile-menu__social-icon" xmlns="http://www.w3.org/2000/svg" fill="#6b5a53" width="800px" height="800px" viewbox="0 0 20 20">
<path d="M11.603 9.833L9.357 8.785C9.161 8.694 9 8.796 9 9.013v1.974c0 .217.161.319.357.228l2.245-1.048c.197-.092.197-.242.001-.334zM10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6 9.6-4.298 9.6-9.6S15.302.4 10 .4zm0 13.5c-4.914 0-5-.443-5-3.9s.086-3.9 5-3.9 5 .443 5 3.9-.086 3.9-5 3.9z">
</path>
</svg>
</a>
</li>
</ul>
<button class="mobile-menu__button button button-brown open-modal" type="button">Оставить заявку
                <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
</path>
</svg>
</button>
</div>
</div>
<main class="main">
<section class="thank-you main-section">
<div class="thank-you__container container">
<div class="thank-you__card">
<div class="thank-you__info">
<h1 class="thank-you__title heading-title-section">Заявка успешно
                        отправлена !</h1>
<p class="thank-you__description text-medium">Наш менеджер свяжется с вами в ближайшее время и
                            ответит<br>на все интересующие вас вопросы.</p>
</div>
<div class="thank-you__social">
<h3 class="thank-you__social-title heading-title-name">А пока
                        подпишитесь на наши соц.сети,<br>чтобы всегдя быть на связи:</h3>
<ul class="thank-you__social-list">
<li class="thank-you__social-item">
<a class="thank-you__social-link" href="https://t.me/academybarista" target="_blank" title="https://t.me/academybarista">
<svg class="thank-you__social-icon" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 496 512">
<path d="M248 8C111 8 0 119 0 256S111 504 248 504 496 393 496 256 385 8 248 8zM363 176.7c-3.7 39.2-19.9 134.4-28.1 178.3-3.5 18.6-10.3 24.8-16.9 25.4-14.4 1.3-25.3-9.5-39.3-18.7-21.8-14.3-34.2-23.2-55.3-37.2-24.5-16.1-8.6-25 5.3-39.5 3.7-3.8 67.1-61.5 68.3-66.7 .2-.7 .3-3.1-1.2-4.4s-3.6-.8-5.1-.5q-3.3 .7-104.6 69.1-14.8 10.2-26.9 9.9c-8.9-.2-25.9-5-38.6-9.1-15.5-5-27.9-7.7-26.8-16.3q.8-6.7 18.5-13.7 108.4-47.2 144.6-62.3c68.9-28.6 83.2-33.6 92.5-33.8 2.1 0 6.6 .5 9.6 2.9a10.5 10.5 0 0 1 3.5 6.7A43.8 43.8 0 0 1 363 176.7z">
</path>
</svg>
</a>
</li>
<li class="thank-you__social-item">
<a class="thank-you__social-link" href="https://t.me/academybarista" target="_blank" title="https://t.me/academybarista">
<svg class="thank-you__social-icon" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
<path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z">
</path>
</svg>
</a>
</li>
<li class="thank-you__social-item">
<a class="thank-you__social-link" href="https://t.me/academybarista" target="_blank" title="https://t.me/academybarista">
<svg class="thank-you__social-icon" xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 24 24">
<path fill="currentColor" d="M23.456 5.784a8.605 8.605 0 0 1-1.09 2.259l.019-.03q-.672 1.12-1.605 2.588q-.8 1.159-.847 1.2a1.28 1.28 0 0 0-.267.618l-.001.007a.897.897 0 0 0 .268.535l.4.446q3.21 3.299 3.611 4.548a.89.89 0 0 1-.112.829l.002-.003a.965.965 0 0 1-.784.289h.004h-2.636c-.337 0-.647-.118-.89-.314l.003.002a6.928 6.928 0 0 1-.951-.948l-.009-.012q-.691-.781-1.226-1.315q-1.782-1.694-2.63-1.694a.788.788 0 0 0-.516.135l.003-.002a.767.767 0 0 0-.16.584v-.004a12.532 12.532 0 0 0-.038 1.403v-.017v1.159a.78.78 0 0 1-.266.757l-.001.001a3.179 3.179 0 0 1-1.617.267l.013.001a8.323 8.323 0 0 1-4.275-1.268l.035.02A11.931 11.931 0 0 1 4.176 14.3l-.027-.042a26.36 26.36 0 0 1-2.471-3.992l-.07-.154A24.657 24.657 0 0 1 .375 7.31l-.06-.185a6.646 6.646 0 0 1-.31-1.535l-.002-.025q0-.758.892-.758h2.63a1.058 1.058 0 0 1 .739.225l-.002-.002c.2.219.348.488.421.788l.003.012a25.422 25.422 0 0 0 1.587 3.615l-.067-.137a14.56 14.56 0 0 0 1.623 2.576l-.023-.031q.8.982 1.248.982l.032.001a.4.4 0 0 0 .347-.2l.001-.002a1.783 1.783 0 0 0 .111-.787v.006v-3.879a3.211 3.211 0 0 0-.32-1.267l.008.019a2.956 2.956 0 0 0-.45-.695l.003.004a1.099 1.099 0 0 1-.311-.619l-.001-.006c0-.17.078-.323.2-.423l.001-.001a.678.678 0 0 1 .46-.178h4.154a.634.634 0 0 1 .559.222l.001.001a1.36 1.36 0 0 1 .159.763v-.005v5.173a.993.993 0 0 0 .136.584l-.002-.004a.401.401 0 0 0 .333.178h.001a.946.946 0 0 0 .471-.162l-.003.002c.272-.187.506-.4.709-.641l.004-.005a15.606 15.606 0 0 0 1.655-2.25l.039-.07c.344-.57.716-1.272 1.053-1.993l.062-.147l.446-.892a1.122 1.122 0 0 1 1.117-.759h-.003h2.631q1.066 0 .8.981z">
</path>
</svg>
</a>
</li>
</ul>
</div>
<a class="thank-you__link text-medium" href="/">вернуться на главную</a>
</div>
</div>
</section>
</main>
<div class="modal">
<div class="modal__overlay">
<div class="modal__inner">
<div class="modal__window">
<div class="modal__title heading-title-section">Оставьте заявку</div>
<button class="modal__close">
<svg role="presentation" class="t-popup__close-icon" width="23px" height="23px" viewbox="0 0 23 23" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<g stroke="none" stroke-width="1" fill="#fff" fill-rule="evenodd">
<rect transform="translate(11.313708, 11.313708) rotate(-45.000000) translate(-11.313708, -11.313708) " x="10.3137085" y="-3.6862915" width="2" height="30">
</rect>
<rect transform="translate(11.313708, 11.313708) rotate(-315.000000) translate(-11.313708, -11.313708) " x="10.3137085" y="-3.6862915" width="2" height="30">
</rect>
</g>
</svg>
</button>
<form class="modal__form form" action="">
<label class="modal__form-label form__label" for="">
<input class="modal__form-input form__input form-name" name="Имя" type="text" placeholder="Ваше имя">
</label>
<label class="modal__form-label form__label" for="">
<input class="modal__form-input form__input form-phone" name="Телефон" type="tel" placeholder="Телефон">
</label>
<label class="modal__form-label form__label" for="">
<input class="modal__form-input form__input form-email" name="Email" type="email" placeholder="Email">
</label>
<textarea class="modal__form-textarea form__textarea" placeholder="Ваше сообщение" name="Сообщение">
</textarea>
<button class="modal__form-button form__button button button-brown" type="submit">Оставить
                            заявку
                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
</path>
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
<input type="hidden" class="form-purpose" value="Тип заявки: Главная страница">
</form>
</div>
</div>
</div>
</div>
</div>
@endsection
