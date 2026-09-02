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
                    <li class="bread-crumbs__nav-item"><a class="bread-crumbs__nav-link bread-crumbs__nav-link-is-active text-regular" href="/sertifikat.html">Подарочный сертификат</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <main class="main">
        <section class="hero">
            <div class="hero__container container">
                <div class="hero__top">
                    <div class="hero__info"><h1 class="hero__title heading-title-general">Подарочные сертификаты</h1>
                        <p class="hero__description text-medium">Подарите близким не просто эмоции, а ценные навыки!
                            Обучение искусству бариста или секретам успешного открытия кофейни — знания, которые откроют
                            новые возможности и останутся с ними навсегда!</p>
                        <div class="hero__social"><p class="hero__social-label text-medium">Открой для себя нашу школу
                            ближе —<br>следи за нами в социальных сетях !</p>
                            <ul class="header__social hero__social-list">
                                <li class="header__social-item hero__social-item"><a class="header__social-link hero__social-link" href="https://t.me/academybarista" target="_blank" title="https://t.me/academybarista">
                                    <svg class="header__social-icon hero__social-icon" width="36" height="36" viewbox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="36" height="36" rx="18" fill="#33373E"></rect>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0996 16.5964C14.3931 14.7618 17.2561 13.5523 18.6886 12.968C22.7788 11.2995 23.6287 11.0097 24.1826 11.0001C24.3045 10.998 24.5769 11.0276 24.7533 11.1681C25.0151 11.3764 25.0166 11.8286 24.9875 12.1278C24.7659 14.4119 23.8068 19.9545 23.3189 22.5127C23.1124 23.5951 22.7059 23.9581 22.3124 23.9936C21.4571 24.0707 20.8076 23.4392 19.9792 22.9067C18.683 22.0733 17.9507 21.5545 16.6924 20.7414C15.2383 19.8016 16.1809 19.2851 17.0096 18.4409C17.2265 18.22 20.9949 14.8583 21.0678 14.5534C21.077 14.5152 21.0854 14.373 20.9993 14.298C20.9132 14.223 20.7861 14.2486 20.6944 14.269C20.5644 14.2979 18.4936 15.6403 14.482 18.2961C13.8942 18.6919 13.3618 18.8848 12.8848 18.8747C12.3589 18.8636 11.3474 18.5831 10.5954 18.3434C9.67309 18.0493 8.94002 17.8938 9.00388 17.3945C9.03713 17.1343 9.40234 16.8683 10.0996 16.5964Z" fill="white"></path>
                                    </svg>
                                </a></li>
                                <li class="header__social-item hero__social-item"><a class="header__social-link hero__social-link" href="https://vk.com/academybarista1" target="_blank" title="https://vk.com/academybarista1">
                                    <svg class="header__social-icon hero__social-icon" width="36" height="36" viewbox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="36" height="36" rx="18" fill="#282020"></rect>
                                        <path d="M18.7145 23C13.2479 23 10.1299 19.2462 10 13H12.7383C12.8282 17.5846 14.8469 19.5265 16.4459 19.9269V13H19.0244V16.954C20.6034 16.7838 22.2622 14.982 22.8218 13H25.4003C24.9705 15.4424 23.1717 17.2442 21.8925 17.985C23.1717 18.5856 25.2205 20.1572 26 23H23.1617C22.5521 21.0981 21.0332 19.6266 19.0244 19.4264V23H18.7145Z" fill="white"></path>
                                    </svg>
                                </a></li>
                                <li class="header__social-item hero__social-item"><a class="header__social-link hero__social-link" href="https://youtube.com/@academybarista" target="_blank" title="https://youtube.com/@academybarista">
                                    <svg class="header__social-icon hero__social-icon" xmlns="http://www.w3.org/2000/svg" fill="#6b5a53" width="800px" height="800px" viewbox="0 0 20 20">
                                        <path d="M11.603 9.833L9.357 8.785C9.161 8.694 9 8.796 9 9.013v1.974c0 .217.161.319.357.228l2.245-1.048c.197-.092.197-.242.001-.334zM10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6 9.6-4.298 9.6-9.6S15.302.4 10 .4zm0 13.5c-4.914 0-5-.443-5-3.9s.086-3.9 5-3.9 5 .443 5 3.9-.086 3.9-5 3.9z"></path>
                                    </svg>
                                </a></li>
                            </ul>
                        </div>
                        <div class="hero__btn">
                            <button class="hero__button button button-brown open-modal" type="button">Оставить заявку
                                <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <a class="hero__button button button button-transparent" href="https://Wa.me/79251522866">Написать
                                в Whatsapp</a></div>
                    </div>
                    <div class="hero__image"><img src="/assets/16.png" alt="Купить подарочный сертификат на курсы бариста"></div>
                </div>
            </div>
        </section>
        <section class="courses main-section">
            <div class="courses__container container">
                <div class="courses__top"><h2 class="courses__title heading-title-section">Программы и курсы</h2>
                    <nav class="courses__nav">
                        <button class="courses__nav-button text-small courses__nav-button-is-active" data-course="barista">Курсы Бариста
                        </button>
                        <button class="courses__nav-button text-small" data-course="master-class">Мастер Класс</button>
                        <button class="courses__nav-button text-small" data-course="barnoe-delo">Барное Дело</button>
                    </nav>
                </div>
                <div class="courses__body">
                    <div class="courses__body-content courses__body-content-is-active barista-slider splide" data-course="barista">
                        <div class="courses__body-track splide__track">
                            <div class="courses__body-list splide__list">
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/1.jpeg" alt="Бариста Базовый"></div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Бариста базовый</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">14 000 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">2 дня по 4 часа</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Отличный вариант для тех,
                                                кто хочет освоить базовые основы профессии бариста. Курс составлен
                                                специалистами с богатым опытом работы в кофейнях.</p></div>
                                        <a class="courses__card-button button button-brown" href="/courses/barista-base.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/2.jpg" alt="Бариста Продвинутый"></div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Бариста продвинутый</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">19 000 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">3 дня по 4 часа</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Курс подойдет как для
                                                новичков, так и для более опытных бариста. Обучаться также могут бармены
                                                и другие сотрудники общественных заведений, которые занимаются
                                                приготовлением кофе.</p></div>
                                        <a class="courses__card-button button button-brown" href="/courses/barista-advanced.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/3.png" alt="Бариста Professional"></div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Бариста Professional</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">27 500 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">3 дня по 5 часов</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Курс подойдет как для
                                                бариста разного класса, так и для управленцев в сфере ХоРеКа, а также
                                                владельцев и администраторов кофеен. Вы углубитесь не только в
                                                приготовление кофейных напитков, но и в менеджмент кофейного
                                                бизнеса.</p></div>
                                        <a class="courses__card-button button button-brown" href="/courses/barista-professional.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/14.png" alt="Управляющий кофейни"></div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Управляющий кофейни</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">30 000 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">3 дня по 5 часов</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Курс «Управляющий кофейни» —
                                                самый объемный обучающий блок, включающий в себя исчерпывающую
                                                информацию по всей работе кофейни.</p></div>
                                        <a class="courses__card-button button button-brown" href="/courses/upravlyayushchiy-kofeyni.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="courses__body-content master-class-slider splide" data-course="master-class">
                        <div class="courses__body-track splide__track">
                            <div class="courses__body-list splide__list">
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/5.jpg" alt="Бариста в Take away"></div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Бариста в Take away</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">9 000 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">4 часа</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Подойдет бариста, владельцам
                                                кофеен, управленцам и любителям кофе, стремящимся улучшить навыки работы
                                                в формате take away и оптимизировать обслуживание.</p></div>
                                        <a class="courses__card-button button button-brown" href="/master-class/barista-v-take-away.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/6.jpg" alt="Юный Бариста"></div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Юный Бариста</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">9 000 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">4 часа</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Погрузите ребенка в мир
                                                кофе! На курсе он познакомится с основами бариста, научится готовить
                                                напитки и приобретет полезные навыки на будущее.</p></div>
                                        <a class="courses__card-button button button-brown" href="/master-class/young-barista.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/7.jpg" alt="Латте-Арт"></div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Латте-Арт</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">9 000 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">3 часа</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Откройте искусство
                                                латте-арта на нашем мастер-классе! Курс подходит как новичкам, так и
                                                опытным бариста, желающим освоить техники рисунков на кофе. Вы изучите
                                                основные приемы и секреты создания идеального молочного крема.</p></div>
                                        <a class="courses__card-button button button-brown" href="/master-class/latte-art.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/8.jpg" alt="Домашняя кофейня"></div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Домашняя кофейня</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">9 000 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">3 часа</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Мастер-класс включает в себя
                                                теоретическую и практическую информацию об основных способах домашнего
                                                приготовления кофе: френч-пресс, чашка, турка, гейзер, кофеварки
                                                капельного типа.</p></div>
                                        <a class="courses__card-button button button-brown" href="/master-class/domashnyaya-kofeynya.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="courses__body-content barnoe-delo-slider splide" data-course="barnoe-delo">
                        <div class="courses__body-track splide__track">
                            <div class="courses__body-list splide__list">
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/9.png" alt="Магия коктейлей: Встряхни и подай"></div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Магия коктейлей: Встряхни
                                            и подай</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">10 000 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">4 часа</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Погрузитесь в мир
                                                барменского искусства! Освойте пять легендарных коктейлей, технику шейка
                                                и секреты подачи. Узнайте, как делать вечеринки незабываемыми и удивлять
                                                гостей!</p></div>
                                        <a class="courses__card-button button button-brown" href="/barnoe-delo/vstryakhni-i-poday.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/10.png" alt="Вкус и стиль: метод Стир"></div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Вкус и стиль: метод
                                            Стир</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">10 000 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">4 часа</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Погрузитесь в мир
                                                барменского искусства! Освойте пять легендарных коктейлей, технику
                                                шейка, секреты подачи и дегустации. Узнайте, как сделать вечеринки
                                                незабываемыми и впечатлять гостей. Обретите новое хобби!</p></div>
                                        <a class="courses__card-button button button-brown" href="/barnoe-delo/metod-ctir.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                                <article class="courses__card splide__slide">
                                    <div class="courses__card-image"><img loading="lazy" src="/assets/11.png" alt="Просто и изысканно: Коктейль методом Билд">
                                    </div>
                                    <div class="courses__card-body">
                                        <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">Просто и изысканно:
                                            Коктейль методом Билд</h3>
                                            <div class="courses__card-row">
                                                <h4 class="courses__card-prise">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                    </svg>
                                                    <span class="text-small">10 000 ₽</span></h4>
                                                <h4 class="courses__card-prise">
                                                    <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="text-small">4 часа</span></h4>
                                            </div>
                                            <p class="courses__card-description text-small">Откройте метод "Билд" —
                                                технику смешивания ингредиентов прямо в бокале. На мастер-классе вы
                                                освоите культовые коктейли, узнаете секреты выбора ингредиентов и
                                                брендов, а также технику подачи и украшения.</p></div>
                                        <a class="courses__card-button button button-brown" href="/barnoe-delo/koktel-metodom-bild.html">Подробнее
                                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a></div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="give main-section">
            <div class="give__container container">
                <div class="give__left"><h2 class="give__title heading-title-section">Заполните форму</h2>
                    <form class="give__form form-give" action=""><label class="give__form-label form__label" for=""><input class="give__form-input form__input form-name" name="Имя" type="text" placeholder="Ваше имя"></label> <label class="give__form-label form__label" for=""><input class="give__form-input form__input form-phone" name="Телефон" type="tel" placeholder="Телефон"></label> <label class="give__form-label custom-select form__label" for="" name="Программа"><select class="give__form-select form-select" name="Программа">
                        <option class="give__form-option form-option" value="">Выберите программу</option>
                        <option class="give__form-option form-option" value="Бариста Базовый">Бариста Базовый</option>
                        <option class="give__form-option form-option" value="Бариста Продвинутый">Бариста Продвинутый
                        </option>
                        <option class="give__form-option form-option" value="Бариста Professional">Бариста
                            Professional
                        </option>
                        <option class="give__form-option form-option" value="Управляющий кофейни">Управляющий кофейни
                        </option>
                        <option class="give__form-option form-option" value="Бариста В Take Away">Бариста В Take Away
                        </option>
                        <option class="give__form-option form-option" value="Юный Бариста">Юный Бариста</option>
                        <option class="give__form-option form-option" value="Латте-Арт">Латте-Арт</option>
                        <option class="give__form-option form-option" value="Домашняя кофейня">Домашняя кофейня</option>
                        <option class="give__form-option form-option" value="Магия коктейлей: Встряхни и подай">Магия
                            коктейлей: Встряхни и подай
                        </option>
                        <option class="give__form-option form-option" value="Вкус и стиль: метод Стир">Вкус и стиль:
                            метод Стир
                        </option>
                        <option class="give__form-option form-option" value="Просто и изысканно: Коктейль методом Билд">
                            Просто и изысканно: Коктейль методом Билд
                        </option>
                    </select></label> <label class="give__form-label form__label" for=""><input class="give__form-input form__input form-full-name" name="Имя" type="text" placeholder="ФИО для кого сертификат"></label> <label class="give__form-label form__label" for=""><input class="give__form-input form__input form-email" name="Email" type="email" placeholder="Email для отправки сертификата"></label>
                        <button class="give__form-button form__button button button-brown" type="submit">Оставить заявку
                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <div class="give__form-chek form__chek">
                            <div><input class="give__form-checkbox form__chek-chekbox" type="checkbox" required> <span class="give__form-text form__chek-text text-regular">Согласен на обработку <a href="/docs/%D0%A1%D0%BE%D0%B3%D0%BB%D0%B0%D1%81%D0%B8%D0%B5_%D0%BE%D0%B1%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%BA%D0%B8_%D0%9F%D0%94_%D0%90%D0%BA%D0%B0%D0%B4%D0%B5%D0%BC%D0%B8%D0%B8_%D0%B1%D0%B0%D1%80%D0%B8%D1%81%D1%82%D0%B0.pdf">персональных данных</a></span>
                            </div>
                        </div>
                        <input type="hidden" class="form-purpose" value="Тип заявки: Подарок Сертификата"></form>
                </div>
                <div class="give__image"><img src="/assets/certificate.webp" alt=""></div>
            </div>
        </section>
        <section class="reviews main-section">
            <div class="reviews__container container">
                <div class="reviews__top">
                    <div class="reviews__info"><h2 class="reviews__title heading-title-section">Отзывы учеников</h2>
                    </div>
                    <div class="reviews__slider splide">
                        <div class="reviews__slider-track splide__track">
                            <ul class="reviews__slider-list splide__list">
                                <li class="reviews__slider-slide splide__slide">
                                    <div class="reviews__slider-head">
                                        <div class="reviews__slider-person">
                                            <div class="reviews__slider-avatar">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 448 512">
                                                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"></path>
                                                </svg>
                                            </div>
                                            <h4 class="reviews__slider-name text-medium">Кира Сурогина</h4></div>
                                        <a class="reviews__slider-link" target="_blank" href="https://yandex.ru/maps/org/39301833905/reviews?reviews%5BpublicId%5D=xkt24kpew4yqebjd2g33g6dnhg&amp;si=5rm3pv9jexuu3gvw5nwcr7vc2c&amp;utm_source=review"><img width="150" loading="lazy" src="data:image/svg+xml,%3c?xml%20version='1.0'%20encoding='UTF-8'?%3e%3csvg%20xmlns='http://www.w3.org/2000/svg'%20id='Layer_2'%20data-name='Layer%202'%20viewBox='0%200%20199.88%2028.18'%3e%3cdefs%3e%3cstyle%3e%20.cls-1,%20.cls-2,%20.cls-3%20{%20fill-rule:%20evenodd;%20stroke-width:%200px;%20}%20.cls-2%20{%20fill:%20%23fff;%20}%20.cls-3%20{%20fill:%20%23f43;%20}%20%3c/style%3e%3c/defs%3e%3cg%20id='_%D0%A1%D0%BB%D0%BE%D0%B9_1'%20data-name='%D0%A1%D0%BB%D0%BE%D0%B9%201'%3e%3cg%3e%3cg%3e%3cpath%20class='cls-3'%20d='m104.6,0c-6.12,0-11.08,4.96-11.08,11.08,0,3.06,1.24,5.83,3.24,7.83,2.01,2.01,6.73,4.91,7.01,7.96.04.46.37.83.83.83s.79-.37.83-.83c.28-3.05,5-5.95,7.01-7.96,2-2.01,3.24-4.78,3.24-7.83,0-6.12-4.96-11.08-11.08-11.08Z'%3e%3c/path%3e%3cpath%20class='cls-2'%20d='m104.6,14.96c2.14,0,3.88-1.74,3.88-3.88s-1.74-3.88-3.88-3.88-3.88,1.74-3.88,3.88,1.74,3.88,3.88,3.88Z'%3e%3c/path%3e%3c/g%3e%3cpath%20class='cls-1'%20d='m188.83,21.04h-1.65v-4.81h1.73c1.53,0,2.42.69,2.42,2.42s-.99,2.39-2.51,2.39h0Zm7.49-12.22v15.03h3.56v-15.03h-3.56Zm-12.69,0v15.03h5.41c3.5,0,5.97-1.79,5.97-5.32,0-3.35-2.21-5.11-5.92-5.11h-1.91v-4.6h-3.55Zm-2.09,2.81v-2.81h-11.92v2.81h4.18v12.22h3.55v-12.22h4.18Zm-19.26,9.71c-1.88,0-2.85-1.52-2.85-4.98s1.02-5.01,3.02-5.01,2.89,1.52,2.89,4.98-1.02,5.01-3.07,5.01h0Zm-3.11-12.51h-3.29v19.35h3.55v-6.09c.9,1.34,2.21,2.05,3.74,2.05,3.46,0,5.85-2.77,5.85-7.82s-2.33-7.79-5.67-7.79c-1.68,0-3.05.77-4,2.23l-.18-1.94h0Zm-9.7,11.44c-.45.66-1.29,1.2-2.54,1.2-1.49,0-2.24-.84-2.24-2.12,0-1.71,1.23-2.33,4.28-2.33h.51v3.25h0Zm3.55-6.66c0-3.64-1.86-5.01-5.62-5.01-2.36,0-4.21.74-5.29,1.38v2.96c.95-.73,3.04-1.5,4.87-1.5,1.7,0,2.48.59,2.48,2.21v.83h-.57c-5.44,0-7.85,1.8-7.85,4.84s1.85,4.75,4.6,4.75c2.09,0,2.99-.69,3.67-1.4h.15c.03.39.15.89.26,1.2h3.47c-.12-1.22-.18-2.45-.18-3.67v-6.58h0Zm-16.34,10.25h4.21l-7.38-10.9,6.69-9.86h-3.67l-6.43,9.55V3.1h-3.61v20.76h3.61v-9.74l6.58,9.74Z'%3e%3c/path%3e%3cpath%20class='cls-1'%20d='m39.54,21.04h-5.02c.99-2.27,1.26-6.36,1.26-8.96v-.45h3.76v9.41h0Zm12.33-9.7c1.76,0,2.3,1.46,2.3,3.34v.29h-4.96c.09-2.38.95-3.64,2.66-3.64h0Zm-26.79-2.52v5.95h-4.75v-5.95h-3.56v15.03h3.56v-6.28h4.75v6.28h3.55v-15.03h-3.55Zm19.59,12.22h-1.58v-12.22h-10.36v1.29c0,3.67-.24,8.41-1.49,10.93h-1.11v6.24h3.29v-3.43h7.97v3.43h3.29v-6.24h0Zm24.32,2.81h4.02l-5.7-7.98,5.02-7.05h-3.59l-5.01,7.05v-7.05h-3.56v15.03h3.56v-7.26l5.26,7.26h0Zm-11.35-1.02v-2.9c-1.1.75-2.96,1.4-4.69,1.4-2.6,0-3.58-1.22-3.73-3.73h8.57v-1.87c0-5.23-2.3-7.2-5.86-7.2-4.32,0-6.39,3.31-6.39,7.85,0,5.23,2.57,7.76,7.11,7.76,2.26,0,3.94-.59,4.98-1.31h0Zm22.22,1.31c-4.75,0-7.05-2.77-7.05-7.79,0-4.57,2.36-7.82,6.91-7.82,1.76,0,3.07.29,3.82.72v3.02c-.72-.45-2.05-.92-3.43-.92-2.33,0-3.62,1.67-3.62,4.93s1.05,5.07,3.59,5.07c1.49,0,2.56-.39,3.46-1.01v2.89c-.87.63-2.03.92-3.67.92h0Zm-69.68-.29h3.61V3.1h-5.26C3.25,3.1.48,5.81.48,9.81c0,3.19,1.52,5.08,4.24,7.02L0,23.85h3.91l5.26-7.86-1.82-1.23c-2.21-1.49-3.29-2.66-3.29-5.16,0-2.21,1.55-3.7,4.51-3.7h1.61v17.95Z'%3e%3c/path%3e%3c/g%3e%3c/g%3e%3c/svg%3e" alt=""></a></div>
                                    <div class="reviews__slider-row">
                                        <div class="reviews__slider-date text-regular">15 декабря 2024</div>
                                        <div class="reviews__slider-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="76" height="16" viewbox="0 0 76 16" fill="none">
                                                <path d="M6.1021 3.60575C6.94653 2.09092 7.36873 1.3335 8 1.3335C8.63126 1.3335 9.05346 2.09091 9.89786 3.60574L10.1163 3.99765C10.3563 4.42812 10.4763 4.64336 10.6634 4.78537C10.8505 4.92738 11.0834 4.9801 11.5494 5.08553L11.9737 5.18152C13.6134 5.55254 14.4333 5.73804 14.6284 6.36532C14.8235 6.99256 14.2645 7.64623 13.1466 8.95343L12.8574 9.29163C12.5397 9.6631 12.3809 9.84883 12.3094 10.0786C12.238 10.3084 12.262 10.5562 12.31 11.0519L12.3537 11.5031C12.5227 13.2472 12.6073 14.1193 12.0966 14.507C11.5859 14.8946 10.8182 14.5412 9.28286 13.8343L8.88566 13.6514C8.4494 13.4505 8.23126 13.35 8 13.35C7.76873 13.35 7.5506 13.4505 7.11433 13.6514L6.71713 13.8343C5.18178 14.5412 4.41412 14.8946 3.90343 14.507C3.39274 14.1193 3.47725 13.2472 3.64626 11.5031L3.68998 11.0519C3.73802 10.5562 3.76203 10.3084 3.69057 10.0786C3.61912 9.84883 3.46028 9.6631 3.14261 9.29163L2.8534 8.95343C1.7355 7.64623 1.17654 6.99256 1.37161 6.36532C1.56668 5.73804 2.38657 5.55254 4.02636 5.18152L4.45059 5.08553C4.91656 4.9801 5.14955 4.92738 5.33662 4.78537C5.5237 4.64336 5.64368 4.42812 5.88364 3.99765L6.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M21.1021 3.60575C21.9465 2.09092 22.3687 1.3335 23 1.3335C23.6313 1.3335 24.0535 2.09091 24.8979 3.60574L25.1163 3.99765C25.3563 4.42812 25.4763 4.64336 25.6634 4.78537C25.8505 4.92738 26.0834 4.9801 26.5494 5.08553L26.9737 5.18152C28.6134 5.55254 29.4333 5.73804 29.6284 6.36532C29.8235 6.99256 29.2645 7.64623 28.1466 8.95343L27.8574 9.29163C27.5397 9.6631 27.3809 9.84883 27.3094 10.0786C27.238 10.3084 27.262 10.5562 27.31 11.0519L27.3537 11.5031C27.5227 13.2472 27.6073 14.1193 27.0966 14.507C26.5859 14.8946 25.8182 14.5412 24.2829 13.8343L23.8857 13.6514C23.4494 13.4505 23.2313 13.35 23 13.35C22.7687 13.35 22.5506 13.4505 22.1143 13.6514L21.7171 13.8343C20.1818 14.5412 19.4141 14.8946 18.9034 14.507C18.3927 14.1193 18.4772 13.2472 18.6463 11.5031L18.69 11.0519C18.738 10.5562 18.762 10.3084 18.6906 10.0786C18.6191 9.84883 18.4603 9.6631 18.1426 9.29163L17.8534 8.95343C16.7355 7.64623 16.1765 6.99256 16.3716 6.36532C16.5667 5.73804 17.3866 5.55254 19.0264 5.18152L19.4506 5.08553C19.9166 4.9801 20.1495 4.92738 20.3366 4.78537C20.5237 4.64336 20.6437 4.42812 20.8836 3.99765L21.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M36.1021 3.60575C36.9465 2.09092 37.3687 1.3335 38 1.3335C38.6313 1.3335 39.0535 2.09091 39.8979 3.60574L40.1163 3.99765C40.3563 4.42812 40.4763 4.64336 40.6634 4.78537C40.8505 4.92738 41.0834 4.9801 41.5494 5.08553L41.9737 5.18152C43.6134 5.55254 44.4333 5.73804 44.6284 6.36532C44.8235 6.99256 44.2645 7.64623 43.1466 8.95343L42.8574 9.29163C42.5397 9.6631 42.3809 9.84883 42.3094 10.0786C42.238 10.3084 42.262 10.5562 42.31 11.0519L42.3537 11.5031C42.5227 13.2472 42.6073 14.1193 42.0966 14.507C41.5859 14.8946 40.8182 14.5412 39.2829 13.8343L38.8857 13.6514C38.4494 13.4505 38.2313 13.35 38 13.35C37.7687 13.35 37.5506 13.4505 37.1143 13.6514L36.7171 13.8343C35.1818 14.5412 34.4141 14.8946 33.9034 14.507C33.3927 14.1193 33.4772 13.2472 33.6463 11.5031L33.69 11.0519C33.738 10.5562 33.762 10.3084 33.6906 10.0786C33.6191 9.84883 33.4603 9.6631 33.1426 9.29163L32.8534 8.95343C31.7355 7.64623 31.1765 6.99256 31.3716 6.36532C31.5667 5.73804 32.3866 5.55254 34.0264 5.18152L34.4506 5.08553C34.9166 4.9801 35.1495 4.92738 35.3366 4.78537C35.5237 4.64336 35.6437 4.42812 35.8836 3.99765L36.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M51.1021 3.60575C51.9465 2.09092 52.3687 1.3335 53 1.3335C53.6313 1.3335 54.0535 2.09091 54.8979 3.60574L55.1163 3.99765C55.3563 4.42812 55.4763 4.64336 55.6634 4.78537C55.8505 4.92738 56.0834 4.9801 56.5494 5.08553L56.9737 5.18152C58.6134 5.55254 59.4333 5.73804 59.6284 6.36532C59.8235 6.99256 59.2645 7.64623 58.1466 8.95343L57.8574 9.29163C57.5397 9.6631 57.3809 9.84883 57.3094 10.0786C57.238 10.3084 57.262 10.5562 57.31 11.0519L57.3537 11.5031C57.5227 13.2472 57.6073 14.1193 57.0966 14.507C56.5859 14.8946 55.8182 14.5412 54.2829 13.8343L53.8857 13.6514C53.4494 13.4505 53.2313 13.35 53 13.35C52.7687 13.35 52.5506 13.4505 52.1143 13.6514L51.7171 13.8343C50.1818 14.5412 49.4141 14.8946 48.9034 14.507C48.3927 14.1193 48.4773 13.2472 48.6463 11.5031L48.69 11.0519C48.738 10.5562 48.762 10.3084 48.6906 10.0786C48.6191 9.84883 48.4603 9.6631 48.1426 9.29163L47.8534 8.95343C46.7355 7.64623 46.1765 6.99256 46.3716 6.36532C46.5667 5.73804 47.3866 5.55254 49.0264 5.18152L49.4506 5.08553C49.9166 4.9801 50.1496 4.92738 50.3366 4.78537C50.5237 4.64336 50.6437 4.42812 50.8836 3.99765L51.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M66.1021 3.60575C66.9465 2.09092 67.3687 1.3335 68 1.3335C68.6313 1.3335 69.0535 2.09091 69.8979 3.60574L70.1163 3.99765C70.3563 4.42812 70.4763 4.64336 70.6634 4.78537C70.8505 4.92738 71.0834 4.9801 71.5494 5.08553L71.9737 5.18152C73.6134 5.55254 74.4333 5.73804 74.6284 6.36532C74.8235 6.99256 74.2645 7.64623 73.1466 8.95343L72.8574 9.29163C72.5397 9.6631 72.3809 9.84883 72.3094 10.0786C72.238 10.3084 72.262 10.5562 72.31 11.0519L72.3537 11.5031C72.5227 13.2472 72.6073 14.1193 72.0966 14.507C71.5859 14.8946 70.8182 14.5412 69.2829 13.8343L68.8857 13.6514C68.4494 13.4505 68.2313 13.35 68 13.35C67.7687 13.35 67.5506 13.4505 67.1143 13.6514L66.7171 13.8343C65.1818 14.5412 64.4141 14.8946 63.9034 14.507C63.3927 14.1193 63.4773 13.2472 63.6463 11.5031L63.69 11.0519C63.738 10.5562 63.762 10.3084 63.6906 10.0786C63.6191 9.84883 63.4603 9.6631 63.1426 9.29163L62.8534 8.95343C61.7355 7.64623 61.1765 6.99256 61.3716 6.36532C61.5667 5.73804 62.3866 5.55254 64.0264 5.18152L64.4506 5.08553C64.9166 4.9801 65.1496 4.92738 65.3366 4.78537C65.5237 4.64336 65.6437 4.42812 65.8836 3.99765L66.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="reviews__slider-body"><p class="reviews__slider-description text-regular">Проходила курс «бариста
                                        продвинутый» все очень понравилось, ребята приветливые , все очень классно,
                                        приятная атмосфера , все понятно и интересно , классная подача</p></div>
                                </li>
                                <li class="reviews__slider-slide splide__slide">
                                    <div class="reviews__slider-head">
                                        <div class="reviews__slider-person">
                                            <div class="reviews__slider-avatar">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 448 512">
                                                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"></path>
                                                </svg>
                                            </div>
                                            <h4 class="reviews__slider-name text-medium">Евгений Поляков</h4></div>
                                        <a class="reviews__slider-link" target="_blank" href="https://yandex.ru/maps/org/39301833905/reviews?reviews%5BpublicId%5D=7fvy84jz262brc050uatygx91g&amp;si=5rm3pv9jexuu3gvw5nwcr7vc2c&amp;utm_source=review"><img width="150" loading="lazy" src="data:image/svg+xml,%3c?xml%20version='1.0'%20encoding='UTF-8'?%3e%3csvg%20xmlns='http://www.w3.org/2000/svg'%20id='Layer_2'%20data-name='Layer%202'%20viewBox='0%200%20199.88%2028.18'%3e%3cdefs%3e%3cstyle%3e%20.cls-1,%20.cls-2,%20.cls-3%20{%20fill-rule:%20evenodd;%20stroke-width:%200px;%20}%20.cls-2%20{%20fill:%20%23fff;%20}%20.cls-3%20{%20fill:%20%23f43;%20}%20%3c/style%3e%3c/defs%3e%3cg%20id='_%D0%A1%D0%BB%D0%BE%D0%B9_1'%20data-name='%D0%A1%D0%BB%D0%BE%D0%B9%201'%3e%3cg%3e%3cg%3e%3cpath%20class='cls-3'%20d='m104.6,0c-6.12,0-11.08,4.96-11.08,11.08,0,3.06,1.24,5.83,3.24,7.83,2.01,2.01,6.73,4.91,7.01,7.96.04.46.37.83.83.83s.79-.37.83-.83c.28-3.05,5-5.95,7.01-7.96,2-2.01,3.24-4.78,3.24-7.83,0-6.12-4.96-11.08-11.08-11.08Z'%3e%3c/path%3e%3cpath%20class='cls-2'%20d='m104.6,14.96c2.14,0,3.88-1.74,3.88-3.88s-1.74-3.88-3.88-3.88-3.88,1.74-3.88,3.88,1.74,3.88,3.88,3.88Z'%3e%3c/path%3e%3c/g%3e%3cpath%20class='cls-1'%20d='m188.83,21.04h-1.65v-4.81h1.73c1.53,0,2.42.69,2.42,2.42s-.99,2.39-2.51,2.39h0Zm7.49-12.22v15.03h3.56v-15.03h-3.56Zm-12.69,0v15.03h5.41c3.5,0,5.97-1.79,5.97-5.32,0-3.35-2.21-5.11-5.92-5.11h-1.91v-4.6h-3.55Zm-2.09,2.81v-2.81h-11.92v2.81h4.18v12.22h3.55v-12.22h4.18Zm-19.26,9.71c-1.88,0-2.85-1.52-2.85-4.98s1.02-5.01,3.02-5.01,2.89,1.52,2.89,4.98-1.02,5.01-3.07,5.01h0Zm-3.11-12.51h-3.29v19.35h3.55v-6.09c.9,1.34,2.21,2.05,3.74,2.05,3.46,0,5.85-2.77,5.85-7.82s-2.33-7.79-5.67-7.79c-1.68,0-3.05.77-4,2.23l-.18-1.94h0Zm-9.7,11.44c-.45.66-1.29,1.2-2.54,1.2-1.49,0-2.24-.84-2.24-2.12,0-1.71,1.23-2.33,4.28-2.33h.51v3.25h0Zm3.55-6.66c0-3.64-1.86-5.01-5.62-5.01-2.36,0-4.21.74-5.29,1.38v2.96c.95-.73,3.04-1.5,4.87-1.5,1.7,0,2.48.59,2.48,2.21v.83h-.57c-5.44,0-7.85,1.8-7.85,4.84s1.85,4.75,4.6,4.75c2.09,0,2.99-.69,3.67-1.4h.15c.03.39.15.89.26,1.2h3.47c-.12-1.22-.18-2.45-.18-3.67v-6.58h0Zm-16.34,10.25h4.21l-7.38-10.9,6.69-9.86h-3.67l-6.43,9.55V3.1h-3.61v20.76h3.61v-9.74l6.58,9.74Z'%3e%3c/path%3e%3cpath%20class='cls-1'%20d='m39.54,21.04h-5.02c.99-2.27,1.26-6.36,1.26-8.96v-.45h3.76v9.41h0Zm12.33-9.7c1.76,0,2.3,1.46,2.3,3.34v.29h-4.96c.09-2.38.95-3.64,2.66-3.64h0Zm-26.79-2.52v5.95h-4.75v-5.95h-3.56v15.03h3.56v-6.28h4.75v6.28h3.55v-15.03h-3.55Zm19.59,12.22h-1.58v-12.22h-10.36v1.29c0,3.67-.24,8.41-1.49,10.93h-1.11v6.24h3.29v-3.43h7.97v3.43h3.29v-6.24h0Zm24.32,2.81h4.02l-5.7-7.98,5.02-7.05h-3.59l-5.01,7.05v-7.05h-3.56v15.03h3.56v-7.26l5.26,7.26h0Zm-11.35-1.02v-2.9c-1.1.75-2.96,1.4-4.69,1.4-2.6,0-3.58-1.22-3.73-3.73h8.57v-1.87c0-5.23-2.3-7.2-5.86-7.2-4.32,0-6.39,3.31-6.39,7.85,0,5.23,2.57,7.76,7.11,7.76,2.26,0,3.94-.59,4.98-1.31h0Zm22.22,1.31c-4.75,0-7.05-2.77-7.05-7.79,0-4.57,2.36-7.82,6.91-7.82,1.76,0,3.07.29,3.82.72v3.02c-.72-.45-2.05-.92-3.43-.92-2.33,0-3.62,1.67-3.62,4.93s1.05,5.07,3.59,5.07c1.49,0,2.56-.39,3.46-1.01v2.89c-.87.63-2.03.92-3.67.92h0Zm-69.68-.29h3.61V3.1h-5.26C3.25,3.1.48,5.81.48,9.81c0,3.19,1.52,5.08,4.24,7.02L0,23.85h3.91l5.26-7.86-1.82-1.23c-2.21-1.49-3.29-2.66-3.29-5.16,0-2.21,1.55-3.7,4.51-3.7h1.61v17.95Z'%3e%3c/path%3e%3c/g%3e%3c/g%3e%3c/svg%3e" alt=""></a></div>
                                    <div class="reviews__slider-row">
                                        <div class="reviews__slider-date text-regular">26 октября 2024</div>
                                        <div class="reviews__slider-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="76" height="16" viewbox="0 0 76 16" fill="none">
                                                <path d="M6.1021 3.60575C6.94653 2.09092 7.36873 1.3335 8 1.3335C8.63126 1.3335 9.05346 2.09091 9.89786 3.60574L10.1163 3.99765C10.3563 4.42812 10.4763 4.64336 10.6634 4.78537C10.8505 4.92738 11.0834 4.9801 11.5494 5.08553L11.9737 5.18152C13.6134 5.55254 14.4333 5.73804 14.6284 6.36532C14.8235 6.99256 14.2645 7.64623 13.1466 8.95343L12.8574 9.29163C12.5397 9.6631 12.3809 9.84883 12.3094 10.0786C12.238 10.3084 12.262 10.5562 12.31 11.0519L12.3537 11.5031C12.5227 13.2472 12.6073 14.1193 12.0966 14.507C11.5859 14.8946 10.8182 14.5412 9.28286 13.8343L8.88566 13.6514C8.4494 13.4505 8.23126 13.35 8 13.35C7.76873 13.35 7.5506 13.4505 7.11433 13.6514L6.71713 13.8343C5.18178 14.5412 4.41412 14.8946 3.90343 14.507C3.39274 14.1193 3.47725 13.2472 3.64626 11.5031L3.68998 11.0519C3.73802 10.5562 3.76203 10.3084 3.69057 10.0786C3.61912 9.84883 3.46028 9.6631 3.14261 9.29163L2.8534 8.95343C1.7355 7.64623 1.17654 6.99256 1.37161 6.36532C1.56668 5.73804 2.38657 5.55254 4.02636 5.18152L4.45059 5.08553C4.91656 4.9801 5.14955 4.92738 5.33662 4.78537C5.5237 4.64336 5.64368 4.42812 5.88364 3.99765L6.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M21.1021 3.60575C21.9465 2.09092 22.3687 1.3335 23 1.3335C23.6313 1.3335 24.0535 2.09091 24.8979 3.60574L25.1163 3.99765C25.3563 4.42812 25.4763 4.64336 25.6634 4.78537C25.8505 4.92738 26.0834 4.9801 26.5494 5.08553L26.9737 5.18152C28.6134 5.55254 29.4333 5.73804 29.6284 6.36532C29.8235 6.99256 29.2645 7.64623 28.1466 8.95343L27.8574 9.29163C27.5397 9.6631 27.3809 9.84883 27.3094 10.0786C27.238 10.3084 27.262 10.5562 27.31 11.0519L27.3537 11.5031C27.5227 13.2472 27.6073 14.1193 27.0966 14.507C26.5859 14.8946 25.8182 14.5412 24.2829 13.8343L23.8857 13.6514C23.4494 13.4505 23.2313 13.35 23 13.35C22.7687 13.35 22.5506 13.4505 22.1143 13.6514L21.7171 13.8343C20.1818 14.5412 19.4141 14.8946 18.9034 14.507C18.3927 14.1193 18.4772 13.2472 18.6463 11.5031L18.69 11.0519C18.738 10.5562 18.762 10.3084 18.6906 10.0786C18.6191 9.84883 18.4603 9.6631 18.1426 9.29163L17.8534 8.95343C16.7355 7.64623 16.1765 6.99256 16.3716 6.36532C16.5667 5.73804 17.3866 5.55254 19.0264 5.18152L19.4506 5.08553C19.9166 4.9801 20.1495 4.92738 20.3366 4.78537C20.5237 4.64336 20.6437 4.42812 20.8836 3.99765L21.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M36.1021 3.60575C36.9465 2.09092 37.3687 1.3335 38 1.3335C38.6313 1.3335 39.0535 2.09091 39.8979 3.60574L40.1163 3.99765C40.3563 4.42812 40.4763 4.64336 40.6634 4.78537C40.8505 4.92738 41.0834 4.9801 41.5494 5.08553L41.9737 5.18152C43.6134 5.55254 44.4333 5.73804 44.6284 6.36532C44.8235 6.99256 44.2645 7.64623 43.1466 8.95343L42.8574 9.29163C42.5397 9.6631 42.3809 9.84883 42.3094 10.0786C42.238 10.3084 42.262 10.5562 42.31 11.0519L42.3537 11.5031C42.5227 13.2472 42.6073 14.1193 42.0966 14.507C41.5859 14.8946 40.8182 14.5412 39.2829 13.8343L38.8857 13.6514C38.4494 13.4505 38.2313 13.35 38 13.35C37.7687 13.35 37.5506 13.4505 37.1143 13.6514L36.7171 13.8343C35.1818 14.5412 34.4141 14.8946 33.9034 14.507C33.3927 14.1193 33.4772 13.2472 33.6463 11.5031L33.69 11.0519C33.738 10.5562 33.762 10.3084 33.6906 10.0786C33.6191 9.84883 33.4603 9.6631 33.1426 9.29163L32.8534 8.95343C31.7355 7.64623 31.1765 6.99256 31.3716 6.36532C31.5667 5.73804 32.3866 5.55254 34.0264 5.18152L34.4506 5.08553C34.9166 4.9801 35.1495 4.92738 35.3366 4.78537C35.5237 4.64336 35.6437 4.42812 35.8836 3.99765L36.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M51.1021 3.60575C51.9465 2.09092 52.3687 1.3335 53 1.3335C53.6313 1.3335 54.0535 2.09091 54.8979 3.60574L55.1163 3.99765C55.3563 4.42812 55.4763 4.64336 55.6634 4.78537C55.8505 4.92738 56.0834 4.9801 56.5494 5.08553L56.9737 5.18152C58.6134 5.55254 59.4333 5.73804 59.6284 6.36532C59.8235 6.99256 59.2645 7.64623 58.1466 8.95343L57.8574 9.29163C57.5397 9.6631 57.3809 9.84883 57.3094 10.0786C57.238 10.3084 57.262 10.5562 57.31 11.0519L57.3537 11.5031C57.5227 13.2472 57.6073 14.1193 57.0966 14.507C56.5859 14.8946 55.8182 14.5412 54.2829 13.8343L53.8857 13.6514C53.4494 13.4505 53.2313 13.35 53 13.35C52.7687 13.35 52.5506 13.4505 52.1143 13.6514L51.7171 13.8343C50.1818 14.5412 49.4141 14.8946 48.9034 14.507C48.3927 14.1193 48.4773 13.2472 48.6463 11.5031L48.69 11.0519C48.738 10.5562 48.762 10.3084 48.6906 10.0786C48.6191 9.84883 48.4603 9.6631 48.1426 9.29163L47.8534 8.95343C46.7355 7.64623 46.1765 6.99256 46.3716 6.36532C46.5667 5.73804 47.3866 5.55254 49.0264 5.18152L49.4506 5.08553C49.9166 4.9801 50.1496 4.92738 50.3366 4.78537C50.5237 4.64336 50.6437 4.42812 50.8836 3.99765L51.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M66.1021 3.60575C66.9465 2.09092 67.3687 1.3335 68 1.3335C68.6313 1.3335 69.0535 2.09091 69.8979 3.60574L70.1163 3.99765C70.3563 4.42812 70.4763 4.64336 70.6634 4.78537C70.8505 4.92738 71.0834 4.9801 71.5494 5.08553L71.9737 5.18152C73.6134 5.55254 74.4333 5.73804 74.6284 6.36532C74.8235 6.99256 74.2645 7.64623 73.1466 8.95343L72.8574 9.29163C72.5397 9.6631 72.3809 9.84883 72.3094 10.0786C72.238 10.3084 72.262 10.5562 72.31 11.0519L72.3537 11.5031C72.5227 13.2472 72.6073 14.1193 72.0966 14.507C71.5859 14.8946 70.8182 14.5412 69.2829 13.8343L68.8857 13.6514C68.4494 13.4505 68.2313 13.35 68 13.35C67.7687 13.35 67.5506 13.4505 67.1143 13.6514L66.7171 13.8343C65.1818 14.5412 64.4141 14.8946 63.9034 14.507C63.3927 14.1193 63.4773 13.2472 63.6463 11.5031L63.69 11.0519C63.738 10.5562 63.762 10.3084 63.6906 10.0786C63.6191 9.84883 63.4603 9.6631 63.1426 9.29163L62.8534 8.95343C61.7355 7.64623 61.1765 6.99256 61.3716 6.36532C61.5667 5.73804 62.3866 5.55254 64.0264 5.18152L64.4506 5.08553C64.9166 4.9801 65.1496 4.92738 65.3366 4.78537C65.5237 4.64336 65.6437 4.42812 65.8836 3.99765L66.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="reviews__slider-body"><p class="reviews__slider-description text-regular">Проходил обучение в
                                        "Академия бариста", очень доволен результатом. Преподаватели объясняют просто и
                                        понятно, одним словом профессионалы своего дела. Всем те кто желает освоить
                                        профессию " Бариста" Очень советую посетить.)))</p></div>
                                </li>
                                <li class="reviews__slider-slide splide__slide">
                                    <div class="reviews__slider-head">
                                        <div class="reviews__slider-person">
                                            <div class="reviews__slider-avatar">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 448 512">
                                                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"></path>
                                                </svg>
                                            </div>
                                            <h4 class="reviews__slider-name text-medium">Надежда Созинова</h4></div>
                                        <a class="reviews__slider-link" target="_blank" href="https://yandex.ru/maps/org/39301833905/reviews?reviews%5BpublicId%5D=phyunj1zmbhwd4jw07bq0at8pr&amp;si=5rm3pv9jexuu3gvw5nwcr7vc2c&amp;utm_source=review"><img width="150" loading="lazy" src="data:image/svg+xml,%3c?xml%20version='1.0'%20encoding='UTF-8'?%3e%3csvg%20xmlns='http://www.w3.org/2000/svg'%20id='Layer_2'%20data-name='Layer%202'%20viewBox='0%200%20199.88%2028.18'%3e%3cdefs%3e%3cstyle%3e%20.cls-1,%20.cls-2,%20.cls-3%20{%20fill-rule:%20evenodd;%20stroke-width:%200px;%20}%20.cls-2%20{%20fill:%20%23fff;%20}%20.cls-3%20{%20fill:%20%23f43;%20}%20%3c/style%3e%3c/defs%3e%3cg%20id='_%D0%A1%D0%BB%D0%BE%D0%B9_1'%20data-name='%D0%A1%D0%BB%D0%BE%D0%B9%201'%3e%3cg%3e%3cg%3e%3cpath%20class='cls-3'%20d='m104.6,0c-6.12,0-11.08,4.96-11.08,11.08,0,3.06,1.24,5.83,3.24,7.83,2.01,2.01,6.73,4.91,7.01,7.96.04.46.37.83.83.83s.79-.37.83-.83c.28-3.05,5-5.95,7.01-7.96,2-2.01,3.24-4.78,3.24-7.83,0-6.12-4.96-11.08-11.08-11.08Z'%3e%3c/path%3e%3cpath%20class='cls-2'%20d='m104.6,14.96c2.14,0,3.88-1.74,3.88-3.88s-1.74-3.88-3.88-3.88-3.88,1.74-3.88,3.88,1.74,3.88,3.88,3.88Z'%3e%3c/path%3e%3c/g%3e%3cpath%20class='cls-1'%20d='m188.83,21.04h-1.65v-4.81h1.73c1.53,0,2.42.69,2.42,2.42s-.99,2.39-2.51,2.39h0Zm7.49-12.22v15.03h3.56v-15.03h-3.56Zm-12.69,0v15.03h5.41c3.5,0,5.97-1.79,5.97-5.32,0-3.35-2.21-5.11-5.92-5.11h-1.91v-4.6h-3.55Zm-2.09,2.81v-2.81h-11.92v2.81h4.18v12.22h3.55v-12.22h4.18Zm-19.26,9.71c-1.88,0-2.85-1.52-2.85-4.98s1.02-5.01,3.02-5.01,2.89,1.52,2.89,4.98-1.02,5.01-3.07,5.01h0Zm-3.11-12.51h-3.29v19.35h3.55v-6.09c.9,1.34,2.21,2.05,3.74,2.05,3.46,0,5.85-2.77,5.85-7.82s-2.33-7.79-5.67-7.79c-1.68,0-3.05.77-4,2.23l-.18-1.94h0Zm-9.7,11.44c-.45.66-1.29,1.2-2.54,1.2-1.49,0-2.24-.84-2.24-2.12,0-1.71,1.23-2.33,4.28-2.33h.51v3.25h0Zm3.55-6.66c0-3.64-1.86-5.01-5.62-5.01-2.36,0-4.21.74-5.29,1.38v2.96c.95-.73,3.04-1.5,4.87-1.5,1.7,0,2.48.59,2.48,2.21v.83h-.57c-5.44,0-7.85,1.8-7.85,4.84s1.85,4.75,4.6,4.75c2.09,0,2.99-.69,3.67-1.4h.15c.03.39.15.89.26,1.2h3.47c-.12-1.22-.18-2.45-.18-3.67v-6.58h0Zm-16.34,10.25h4.21l-7.38-10.9,6.69-9.86h-3.67l-6.43,9.55V3.1h-3.61v20.76h3.61v-9.74l6.58,9.74Z'%3e%3c/path%3e%3cpath%20class='cls-1'%20d='m39.54,21.04h-5.02c.99-2.27,1.26-6.36,1.26-8.96v-.45h3.76v9.41h0Zm12.33-9.7c1.76,0,2.3,1.46,2.3,3.34v.29h-4.96c.09-2.38.95-3.64,2.66-3.64h0Zm-26.79-2.52v5.95h-4.75v-5.95h-3.56v15.03h3.56v-6.28h4.75v6.28h3.55v-15.03h-3.55Zm19.59,12.22h-1.58v-12.22h-10.36v1.29c0,3.67-.24,8.41-1.49,10.93h-1.11v6.24h3.29v-3.43h7.97v3.43h3.29v-6.24h0Zm24.32,2.81h4.02l-5.7-7.98,5.02-7.05h-3.59l-5.01,7.05v-7.05h-3.56v15.03h3.56v-7.26l5.26,7.26h0Zm-11.35-1.02v-2.9c-1.1.75-2.96,1.4-4.69,1.4-2.6,0-3.58-1.22-3.73-3.73h8.57v-1.87c0-5.23-2.3-7.2-5.86-7.2-4.32,0-6.39,3.31-6.39,7.85,0,5.23,2.57,7.76,7.11,7.76,2.26,0,3.94-.59,4.98-1.31h0Zm22.22,1.31c-4.75,0-7.05-2.77-7.05-7.79,0-4.57,2.36-7.82,6.91-7.82,1.76,0,3.07.29,3.82.72v3.02c-.72-.45-2.05-.92-3.43-.92-2.33,0-3.62,1.67-3.62,4.93s1.05,5.07,3.59,5.07c1.49,0,2.56-.39,3.46-1.01v2.89c-.87.63-2.03.92-3.67.92h0Zm-69.68-.29h3.61V3.1h-5.26C3.25,3.1.48,5.81.48,9.81c0,3.19,1.52,5.08,4.24,7.02L0,23.85h3.91l5.26-7.86-1.82-1.23c-2.21-1.49-3.29-2.66-3.29-5.16,0-2.21,1.55-3.7,4.51-3.7h1.61v17.95Z'%3e%3c/path%3e%3c/g%3e%3c/g%3e%3c/svg%3e" alt=""></a></div>
                                    <div class="reviews__slider-row">
                                        <div class="reviews__slider-date text-regular">1 ноября 2024</div>
                                        <div class="reviews__slider-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="76" height="16" viewbox="0 0 76 16" fill="none">
                                                <path d="M6.1021 3.60575C6.94653 2.09092 7.36873 1.3335 8 1.3335C8.63126 1.3335 9.05346 2.09091 9.89786 3.60574L10.1163 3.99765C10.3563 4.42812 10.4763 4.64336 10.6634 4.78537C10.8505 4.92738 11.0834 4.9801 11.5494 5.08553L11.9737 5.18152C13.6134 5.55254 14.4333 5.73804 14.6284 6.36532C14.8235 6.99256 14.2645 7.64623 13.1466 8.95343L12.8574 9.29163C12.5397 9.6631 12.3809 9.84883 12.3094 10.0786C12.238 10.3084 12.262 10.5562 12.31 11.0519L12.3537 11.5031C12.5227 13.2472 12.6073 14.1193 12.0966 14.507C11.5859 14.8946 10.8182 14.5412 9.28286 13.8343L8.88566 13.6514C8.4494 13.4505 8.23126 13.35 8 13.35C7.76873 13.35 7.5506 13.4505 7.11433 13.6514L6.71713 13.8343C5.18178 14.5412 4.41412 14.8946 3.90343 14.507C3.39274 14.1193 3.47725 13.2472 3.64626 11.5031L3.68998 11.0519C3.73802 10.5562 3.76203 10.3084 3.69057 10.0786C3.61912 9.84883 3.46028 9.6631 3.14261 9.29163L2.8534 8.95343C1.7355 7.64623 1.17654 6.99256 1.37161 6.36532C1.56668 5.73804 2.38657 5.55254 4.02636 5.18152L4.45059 5.08553C4.91656 4.9801 5.14955 4.92738 5.33662 4.78537C5.5237 4.64336 5.64368 4.42812 5.88364 3.99765L6.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M21.1021 3.60575C21.9465 2.09092 22.3687 1.3335 23 1.3335C23.6313 1.3335 24.0535 2.09091 24.8979 3.60574L25.1163 3.99765C25.3563 4.42812 25.4763 4.64336 25.6634 4.78537C25.8505 4.92738 26.0834 4.9801 26.5494 5.08553L26.9737 5.18152C28.6134 5.55254 29.4333 5.73804 29.6284 6.36532C29.8235 6.99256 29.2645 7.64623 28.1466 8.95343L27.8574 9.29163C27.5397 9.6631 27.3809 9.84883 27.3094 10.0786C27.238 10.3084 27.262 10.5562 27.31 11.0519L27.3537 11.5031C27.5227 13.2472 27.6073 14.1193 27.0966 14.507C26.5859 14.8946 25.8182 14.5412 24.2829 13.8343L23.8857 13.6514C23.4494 13.4505 23.2313 13.35 23 13.35C22.7687 13.35 22.5506 13.4505 22.1143 13.6514L21.7171 13.8343C20.1818 14.5412 19.4141 14.8946 18.9034 14.507C18.3927 14.1193 18.4772 13.2472 18.6463 11.5031L18.69 11.0519C18.738 10.5562 18.762 10.3084 18.6906 10.0786C18.6191 9.84883 18.4603 9.6631 18.1426 9.29163L17.8534 8.95343C16.7355 7.64623 16.1765 6.99256 16.3716 6.36532C16.5667 5.73804 17.3866 5.55254 19.0264 5.18152L19.4506 5.08553C19.9166 4.9801 20.1495 4.92738 20.3366 4.78537C20.5237 4.64336 20.6437 4.42812 20.8836 3.99765L21.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M36.1021 3.60575C36.9465 2.09092 37.3687 1.3335 38 1.3335C38.6313 1.3335 39.0535 2.09091 39.8979 3.60574L40.1163 3.99765C40.3563 4.42812 40.4763 4.64336 40.6634 4.78537C40.8505 4.92738 41.0834 4.9801 41.5494 5.08553L41.9737 5.18152C43.6134 5.55254 44.4333 5.73804 44.6284 6.36532C44.8235 6.99256 44.2645 7.64623 43.1466 8.95343L42.8574 9.29163C42.5397 9.6631 42.3809 9.84883 42.3094 10.0786C42.238 10.3084 42.262 10.5562 42.31 11.0519L42.3537 11.5031C42.5227 13.2472 42.6073 14.1193 42.0966 14.507C41.5859 14.8946 40.8182 14.5412 39.2829 13.8343L38.8857 13.6514C38.4494 13.4505 38.2313 13.35 38 13.35C37.7687 13.35 37.5506 13.4505 37.1143 13.6514L36.7171 13.8343C35.1818 14.5412 34.4141 14.8946 33.9034 14.507C33.3927 14.1193 33.4772 13.2472 33.6463 11.5031L33.69 11.0519C33.738 10.5562 33.762 10.3084 33.6906 10.0786C33.6191 9.84883 33.4603 9.6631 33.1426 9.29163L32.8534 8.95343C31.7355 7.64623 31.1765 6.99256 31.3716 6.36532C31.5667 5.73804 32.3866 5.55254 34.0264 5.18152L34.4506 5.08553C34.9166 4.9801 35.1495 4.92738 35.3366 4.78537C35.5237 4.64336 35.6437 4.42812 35.8836 3.99765L36.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M51.1021 3.60575C51.9465 2.09092 52.3687 1.3335 53 1.3335C53.6313 1.3335 54.0535 2.09091 54.8979 3.60574L55.1163 3.99765C55.3563 4.42812 55.4763 4.64336 55.6634 4.78537C55.8505 4.92738 56.0834 4.9801 56.5494 5.08553L56.9737 5.18152C58.6134 5.55254 59.4333 5.73804 59.6284 6.36532C59.8235 6.99256 59.2645 7.64623 58.1466 8.95343L57.8574 9.29163C57.5397 9.6631 57.3809 9.84883 57.3094 10.0786C57.238 10.3084 57.262 10.5562 57.31 11.0519L57.3537 11.5031C57.5227 13.2472 57.6073 14.1193 57.0966 14.507C56.5859 14.8946 55.8182 14.5412 54.2829 13.8343L53.8857 13.6514C53.4494 13.4505 53.2313 13.35 53 13.35C52.7687 13.35 52.5506 13.4505 52.1143 13.6514L51.7171 13.8343C50.1818 14.5412 49.4141 14.8946 48.9034 14.507C48.3927 14.1193 48.4773 13.2472 48.6463 11.5031L48.69 11.0519C48.738 10.5562 48.762 10.3084 48.6906 10.0786C48.6191 9.84883 48.4603 9.6631 48.1426 9.29163L47.8534 8.95343C46.7355 7.64623 46.1765 6.99256 46.3716 6.36532C46.5667 5.73804 47.3866 5.55254 49.0264 5.18152L49.4506 5.08553C49.9166 4.9801 50.1496 4.92738 50.3366 4.78537C50.5237 4.64336 50.6437 4.42812 50.8836 3.99765L51.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M66.1021 3.60575C66.9465 2.09092 67.3687 1.3335 68 1.3335C68.6313 1.3335 69.0535 2.09091 69.8979 3.60574L70.1163 3.99765C70.3563 4.42812 70.4763 4.64336 70.6634 4.78537C70.8505 4.92738 71.0834 4.9801 71.5494 5.08553L71.9737 5.18152C73.6134 5.55254 74.4333 5.73804 74.6284 6.36532C74.8235 6.99256 74.2645 7.64623 73.1466 8.95343L72.8574 9.29163C72.5397 9.6631 72.3809 9.84883 72.3094 10.0786C72.238 10.3084 72.262 10.5562 72.31 11.0519L72.3537 11.5031C72.5227 13.2472 72.6073 14.1193 72.0966 14.507C71.5859 14.8946 70.8182 14.5412 69.2829 13.8343L68.8857 13.6514C68.4494 13.4505 68.2313 13.35 68 13.35C67.7687 13.35 67.5506 13.4505 67.1143 13.6514L66.7171 13.8343C65.1818 14.5412 64.4141 14.8946 63.9034 14.507C63.3927 14.1193 63.4773 13.2472 63.6463 11.5031L63.69 11.0519C63.738 10.5562 63.762 10.3084 63.6906 10.0786C63.6191 9.84883 63.4603 9.6631 63.1426 9.29163L62.8534 8.95343C61.7355 7.64623 61.1765 6.99256 61.3716 6.36532C61.5667 5.73804 62.3866 5.55254 64.0264 5.18152L64.4506 5.08553C64.9166 4.9801 65.1496 4.92738 65.3366 4.78537C65.5237 4.64336 65.6437 4.42812 65.8836 3.99765L66.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="reviews__slider-body"><p class="reviews__slider-description text-regular">Ходила с подругой на мастер
                                        класс бариста домашний. Узнала много нового и интересного о кофе и способов
                                        заваривания. Объясняют всё доступно, на понятном языке. Помогают, если что-то не
                                        получается. Всем советую. Даже людям, ничего не смыслящим в приготовлении кофе,
                                        всё далось очень легко</p></div>
                                </li>
                                <li class="reviews__slider-slide splide__slide">
                                    <div class="reviews__slider-head">
                                        <div class="reviews__slider-person">
                                            <div class="reviews__slider-avatar">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 448 512">
                                                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"></path>
                                                </svg>
                                            </div>
                                            <h4 class="reviews__slider-name text-medium">Вероника Порецкая</h4></div>
                                        <a class="reviews__slider-link" target="_blank" href="https://yandex.ru/maps/org/39301833905/reviews?reviews%5BpublicId%5D=r9zhhtvwjeng2huwuy04jwg4ac&amp;si=5rm3pv9jexuu3gvw5nwcr7vc2c&amp;utm_source=review"><img width="150" loading="lazy" src="data:image/svg+xml,%3c?xml%20version='1.0'%20encoding='UTF-8'?%3e%3csvg%20xmlns='http://www.w3.org/2000/svg'%20id='Layer_2'%20data-name='Layer%202'%20viewBox='0%200%20199.88%2028.18'%3e%3cdefs%3e%3cstyle%3e%20.cls-1,%20.cls-2,%20.cls-3%20{%20fill-rule:%20evenodd;%20stroke-width:%200px;%20}%20.cls-2%20{%20fill:%20%23fff;%20}%20.cls-3%20{%20fill:%20%23f43;%20}%20%3c/style%3e%3c/defs%3e%3cg%20id='_%D0%A1%D0%BB%D0%BE%D0%B9_1'%20data-name='%D0%A1%D0%BB%D0%BE%D0%B9%201'%3e%3cg%3e%3cg%3e%3cpath%20class='cls-3'%20d='m104.6,0c-6.12,0-11.08,4.96-11.08,11.08,0,3.06,1.24,5.83,3.24,7.83,2.01,2.01,6.73,4.91,7.01,7.96.04.46.37.83.83.83s.79-.37.83-.83c.28-3.05,5-5.95,7.01-7.96,2-2.01,3.24-4.78,3.24-7.83,0-6.12-4.96-11.08-11.08-11.08Z'%3e%3c/path%3e%3cpath%20class='cls-2'%20d='m104.6,14.96c2.14,0,3.88-1.74,3.88-3.88s-1.74-3.88-3.88-3.88-3.88,1.74-3.88,3.88,1.74,3.88,3.88,3.88Z'%3e%3c/path%3e%3c/g%3e%3cpath%20class='cls-1'%20d='m188.83,21.04h-1.65v-4.81h1.73c1.53,0,2.42.69,2.42,2.42s-.99,2.39-2.51,2.39h0Zm7.49-12.22v15.03h3.56v-15.03h-3.56Zm-12.69,0v15.03h5.41c3.5,0,5.97-1.79,5.97-5.32,0-3.35-2.21-5.11-5.92-5.11h-1.91v-4.6h-3.55Zm-2.09,2.81v-2.81h-11.92v2.81h4.18v12.22h3.55v-12.22h4.18Zm-19.26,9.71c-1.88,0-2.85-1.52-2.85-4.98s1.02-5.01,3.02-5.01,2.89,1.52,2.89,4.98-1.02,5.01-3.07,5.01h0Zm-3.11-12.51h-3.29v19.35h3.55v-6.09c.9,1.34,2.21,2.05,3.74,2.05,3.46,0,5.85-2.77,5.85-7.82s-2.33-7.79-5.67-7.79c-1.68,0-3.05.77-4,2.23l-.18-1.94h0Zm-9.7,11.44c-.45.66-1.29,1.2-2.54,1.2-1.49,0-2.24-.84-2.24-2.12,0-1.71,1.23-2.33,4.28-2.33h.51v3.25h0Zm3.55-6.66c0-3.64-1.86-5.01-5.62-5.01-2.36,0-4.21.74-5.29,1.38v2.96c.95-.73,3.04-1.5,4.87-1.5,1.7,0,2.48.59,2.48,2.21v.83h-.57c-5.44,0-7.85,1.8-7.85,4.84s1.85,4.75,4.6,4.75c2.09,0,2.99-.69,3.67-1.4h.15c.03.39.15.89.26,1.2h3.47c-.12-1.22-.18-2.45-.18-3.67v-6.58h0Zm-16.34,10.25h4.21l-7.38-10.9,6.69-9.86h-3.67l-6.43,9.55V3.1h-3.61v20.76h3.61v-9.74l6.58,9.74Z'%3e%3c/path%3e%3cpath%20class='cls-1'%20d='m39.54,21.04h-5.02c.99-2.27,1.26-6.36,1.26-8.96v-.45h3.76v9.41h0Zm12.33-9.7c1.76,0,2.3,1.46,2.3,3.34v.29h-4.96c.09-2.38.95-3.64,2.66-3.64h0Zm-26.79-2.52v5.95h-4.75v-5.95h-3.56v15.03h3.56v-6.28h4.75v6.28h3.55v-15.03h-3.55Zm19.59,12.22h-1.58v-12.22h-10.36v1.29c0,3.67-.24,8.41-1.49,10.93h-1.11v6.24h3.29v-3.43h7.97v3.43h3.29v-6.24h0Zm24.32,2.81h4.02l-5.7-7.98,5.02-7.05h-3.59l-5.01,7.05v-7.05h-3.56v15.03h3.56v-7.26l5.26,7.26h0Zm-11.35-1.02v-2.9c-1.1.75-2.96,1.4-4.69,1.4-2.6,0-3.58-1.22-3.73-3.73h8.57v-1.87c0-5.23-2.3-7.2-5.86-7.2-4.32,0-6.39,3.31-6.39,7.85,0,5.23,2.57,7.76,7.11,7.76,2.26,0,3.94-.59,4.98-1.31h0Zm22.22,1.31c-4.75,0-7.05-2.77-7.05-7.79,0-4.57,2.36-7.82,6.91-7.82,1.76,0,3.07.29,3.82.72v3.02c-.72-.45-2.05-.92-3.43-.92-2.33,0-3.62,1.67-3.62,4.93s1.05,5.07,3.59,5.07c1.49,0,2.56-.39,3.46-1.01v2.89c-.87.63-2.03.92-3.67.92h0Zm-69.68-.29h3.61V3.1h-5.26C3.25,3.1.48,5.81.48,9.81c0,3.19,1.52,5.08,4.24,7.02L0,23.85h3.91l5.26-7.86-1.82-1.23c-2.21-1.49-3.29-2.66-3.29-5.16,0-2.21,1.55-3.7,4.51-3.7h1.61v17.95Z'%3e%3c/path%3e%3c/g%3e%3c/g%3e%3c/svg%3e" alt=""></a></div>
                                    <div class="reviews__slider-row">
                                        <div class="reviews__slider-date text-regular">7 февраля 2024</div>
                                        <div class="reviews__slider-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="76" height="16" viewbox="0 0 76 16" fill="none">
                                                <path d="M6.1021 3.60575C6.94653 2.09092 7.36873 1.3335 8 1.3335C8.63126 1.3335 9.05346 2.09091 9.89786 3.60574L10.1163 3.99765C10.3563 4.42812 10.4763 4.64336 10.6634 4.78537C10.8505 4.92738 11.0834 4.9801 11.5494 5.08553L11.9737 5.18152C13.6134 5.55254 14.4333 5.73804 14.6284 6.36532C14.8235 6.99256 14.2645 7.64623 13.1466 8.95343L12.8574 9.29163C12.5397 9.6631 12.3809 9.84883 12.3094 10.0786C12.238 10.3084 12.262 10.5562 12.31 11.0519L12.3537 11.5031C12.5227 13.2472 12.6073 14.1193 12.0966 14.507C11.5859 14.8946 10.8182 14.5412 9.28286 13.8343L8.88566 13.6514C8.4494 13.4505 8.23126 13.35 8 13.35C7.76873 13.35 7.5506 13.4505 7.11433 13.6514L6.71713 13.8343C5.18178 14.5412 4.41412 14.8946 3.90343 14.507C3.39274 14.1193 3.47725 13.2472 3.64626 11.5031L3.68998 11.0519C3.73802 10.5562 3.76203 10.3084 3.69057 10.0786C3.61912 9.84883 3.46028 9.6631 3.14261 9.29163L2.8534 8.95343C1.7355 7.64623 1.17654 6.99256 1.37161 6.36532C1.56668 5.73804 2.38657 5.55254 4.02636 5.18152L4.45059 5.08553C4.91656 4.9801 5.14955 4.92738 5.33662 4.78537C5.5237 4.64336 5.64368 4.42812 5.88364 3.99765L6.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M21.1021 3.60575C21.9465 2.09092 22.3687 1.3335 23 1.3335C23.6313 1.3335 24.0535 2.09091 24.8979 3.60574L25.1163 3.99765C25.3563 4.42812 25.4763 4.64336 25.6634 4.78537C25.8505 4.92738 26.0834 4.9801 26.5494 5.08553L26.9737 5.18152C28.6134 5.55254 29.4333 5.73804 29.6284 6.36532C29.8235 6.99256 29.2645 7.64623 28.1466 8.95343L27.8574 9.29163C27.5397 9.6631 27.3809 9.84883 27.3094 10.0786C27.238 10.3084 27.262 10.5562 27.31 11.0519L27.3537 11.5031C27.5227 13.2472 27.6073 14.1193 27.0966 14.507C26.5859 14.8946 25.8182 14.5412 24.2829 13.8343L23.8857 13.6514C23.4494 13.4505 23.2313 13.35 23 13.35C22.7687 13.35 22.5506 13.4505 22.1143 13.6514L21.7171 13.8343C20.1818 14.5412 19.4141 14.8946 18.9034 14.507C18.3927 14.1193 18.4772 13.2472 18.6463 11.5031L18.69 11.0519C18.738 10.5562 18.762 10.3084 18.6906 10.0786C18.6191 9.84883 18.4603 9.6631 18.1426 9.29163L17.8534 8.95343C16.7355 7.64623 16.1765 6.99256 16.3716 6.36532C16.5667 5.73804 17.3866 5.55254 19.0264 5.18152L19.4506 5.08553C19.9166 4.9801 20.1495 4.92738 20.3366 4.78537C20.5237 4.64336 20.6437 4.42812 20.8836 3.99765L21.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M36.1021 3.60575C36.9465 2.09092 37.3687 1.3335 38 1.3335C38.6313 1.3335 39.0535 2.09091 39.8979 3.60574L40.1163 3.99765C40.3563 4.42812 40.4763 4.64336 40.6634 4.78537C40.8505 4.92738 41.0834 4.9801 41.5494 5.08553L41.9737 5.18152C43.6134 5.55254 44.4333 5.73804 44.6284 6.36532C44.8235 6.99256 44.2645 7.64623 43.1466 8.95343L42.8574 9.29163C42.5397 9.6631 42.3809 9.84883 42.3094 10.0786C42.238 10.3084 42.262 10.5562 42.31 11.0519L42.3537 11.5031C42.5227 13.2472 42.6073 14.1193 42.0966 14.507C41.5859 14.8946 40.8182 14.5412 39.2829 13.8343L38.8857 13.6514C38.4494 13.4505 38.2313 13.35 38 13.35C37.7687 13.35 37.5506 13.4505 37.1143 13.6514L36.7171 13.8343C35.1818 14.5412 34.4141 14.8946 33.9034 14.507C33.3927 14.1193 33.4772 13.2472 33.6463 11.5031L33.69 11.0519C33.738 10.5562 33.762 10.3084 33.6906 10.0786C33.6191 9.84883 33.4603 9.6631 33.1426 9.29163L32.8534 8.95343C31.7355 7.64623 31.1765 6.99256 31.3716 6.36532C31.5667 5.73804 32.3866 5.55254 34.0264 5.18152L34.4506 5.08553C34.9166 4.9801 35.1495 4.92738 35.3366 4.78537C35.5237 4.64336 35.6437 4.42812 35.8836 3.99765L36.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M51.1021 3.60575C51.9465 2.09092 52.3687 1.3335 53 1.3335C53.6313 1.3335 54.0535 2.09091 54.8979 3.60574L55.1163 3.99765C55.3563 4.42812 55.4763 4.64336 55.6634 4.78537C55.8505 4.92738 56.0834 4.9801 56.5494 5.08553L56.9737 5.18152C58.6134 5.55254 59.4333 5.73804 59.6284 6.36532C59.8235 6.99256 59.2645 7.64623 58.1466 8.95343L57.8574 9.29163C57.5397 9.6631 57.3809 9.84883 57.3094 10.0786C57.238 10.3084 57.262 10.5562 57.31 11.0519L57.3537 11.5031C57.5227 13.2472 57.6073 14.1193 57.0966 14.507C56.5859 14.8946 55.8182 14.5412 54.2829 13.8343L53.8857 13.6514C53.4494 13.4505 53.2313 13.35 53 13.35C52.7687 13.35 52.5506 13.4505 52.1143 13.6514L51.7171 13.8343C50.1818 14.5412 49.4141 14.8946 48.9034 14.507C48.3927 14.1193 48.4773 13.2472 48.6463 11.5031L48.69 11.0519C48.738 10.5562 48.762 10.3084 48.6906 10.0786C48.6191 9.84883 48.4603 9.6631 48.1426 9.29163L47.8534 8.95343C46.7355 7.64623 46.1765 6.99256 46.3716 6.36532C46.5667 5.73804 47.3866 5.55254 49.0264 5.18152L49.4506 5.08553C49.9166 4.9801 50.1496 4.92738 50.3366 4.78537C50.5237 4.64336 50.6437 4.42812 50.8836 3.99765L51.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M66.1021 3.60575C66.9465 2.09092 67.3687 1.3335 68 1.3335C68.6313 1.3335 69.0535 2.09091 69.8979 3.60574L70.1163 3.99765C70.3563 4.42812 70.4763 4.64336 70.6634 4.78537C70.8505 4.92738 71.0834 4.9801 71.5494 5.08553L71.9737 5.18152C73.6134 5.55254 74.4333 5.73804 74.6284 6.36532C74.8235 6.99256 74.2645 7.64623 73.1466 8.95343L72.8574 9.29163C72.5397 9.6631 72.3809 9.84883 72.3094 10.0786C72.238 10.3084 72.262 10.5562 72.31 11.0519L72.3537 11.5031C72.5227 13.2472 72.6073 14.1193 72.0966 14.507C71.5859 14.8946 70.8182 14.5412 69.2829 13.8343L68.8857 13.6514C68.4494 13.4505 68.2313 13.35 68 13.35C67.7687 13.35 67.5506 13.4505 67.1143 13.6514L66.7171 13.8343C65.1818 14.5412 64.4141 14.8946 63.9034 14.507C63.3927 14.1193 63.4773 13.2472 63.6463 11.5031L63.69 11.0519C63.738 10.5562 63.762 10.3084 63.6906 10.0786C63.6191 9.84883 63.4603 9.6631 63.1426 9.29163L62.8534 8.95343C61.7355 7.64623 61.1765 6.99256 61.3716 6.36532C61.5667 5.73804 62.3866 5.55254 64.0264 5.18152L64.4506 5.08553C64.9166 4.9801 65.1496 4.92738 65.3366 4.78537C65.5237 4.64336 65.6437 4.42812 65.8836 3.99765L66.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="reviews__slider-body"><p class="reviews__slider-description text-regular">Мне очень понравился курс!
                                        Прекрасный тренер Виталий Козлов, всё понятно, позитивно и интересно. Очень
                                        понравился подход к работе и ученикам. Много практики и полезной информации!
                                        Всем советую.</p></div>
                                </li>
                                <li class="reviews__slider-slide splide__slide">
                                    <div class="reviews__slider-head">
                                        <div class="reviews__slider-person">
                                            <div class="reviews__slider-avatar">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 448 512">
                                                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"></path>
                                                </svg>
                                            </div>
                                            <h4 class="reviews__slider-name text-medium">Ирина Степняк</h4></div>
                                        <a class="reviews__slider-link" target="_blank" href="https://yandex.ru/maps/org/39301833905/reviews?reviews%5BpublicId%5D=xkt24kpew4yqebjd2g33g6dnhg&amp;si=5rm3pv9jexuu3gvw5nwcr7vc2c&amp;utm_source=review"><img width="150" loading="lazy" src="data:image/svg+xml,%3c?xml%20version='1.0'%20encoding='UTF-8'?%3e%3csvg%20xmlns='http://www.w3.org/2000/svg'%20id='Layer_2'%20data-name='Layer%202'%20viewBox='0%200%20199.88%2028.18'%3e%3cdefs%3e%3cstyle%3e%20.cls-1,%20.cls-2,%20.cls-3%20{%20fill-rule:%20evenodd;%20stroke-width:%200px;%20}%20.cls-2%20{%20fill:%20%23fff;%20}%20.cls-3%20{%20fill:%20%23f43;%20}%20%3c/style%3e%3c/defs%3e%3cg%20id='_%D0%A1%D0%BB%D0%BE%D0%B9_1'%20data-name='%D0%A1%D0%BB%D0%BE%D0%B9%201'%3e%3cg%3e%3cg%3e%3cpath%20class='cls-3'%20d='m104.6,0c-6.12,0-11.08,4.96-11.08,11.08,0,3.06,1.24,5.83,3.24,7.83,2.01,2.01,6.73,4.91,7.01,7.96.04.46.37.83.83.83s.79-.37.83-.83c.28-3.05,5-5.95,7.01-7.96,2-2.01,3.24-4.78,3.24-7.83,0-6.12-4.96-11.08-11.08-11.08Z'%3e%3c/path%3e%3cpath%20class='cls-2'%20d='m104.6,14.96c2.14,0,3.88-1.74,3.88-3.88s-1.74-3.88-3.88-3.88-3.88,1.74-3.88,3.88,1.74,3.88,3.88,3.88Z'%3e%3c/path%3e%3c/g%3e%3cpath%20class='cls-1'%20d='m188.83,21.04h-1.65v-4.81h1.73c1.53,0,2.42.69,2.42,2.42s-.99,2.39-2.51,2.39h0Zm7.49-12.22v15.03h3.56v-15.03h-3.56Zm-12.69,0v15.03h5.41c3.5,0,5.97-1.79,5.97-5.32,0-3.35-2.21-5.11-5.92-5.11h-1.91v-4.6h-3.55Zm-2.09,2.81v-2.81h-11.92v2.81h4.18v12.22h3.55v-12.22h4.18Zm-19.26,9.71c-1.88,0-2.85-1.52-2.85-4.98s1.02-5.01,3.02-5.01,2.89,1.52,2.89,4.98-1.02,5.01-3.07,5.01h0Zm-3.11-12.51h-3.29v19.35h3.55v-6.09c.9,1.34,2.21,2.05,3.74,2.05,3.46,0,5.85-2.77,5.85-7.82s-2.33-7.79-5.67-7.79c-1.68,0-3.05.77-4,2.23l-.18-1.94h0Zm-9.7,11.44c-.45.66-1.29,1.2-2.54,1.2-1.49,0-2.24-.84-2.24-2.12,0-1.71,1.23-2.33,4.28-2.33h.51v3.25h0Zm3.55-6.66c0-3.64-1.86-5.01-5.62-5.01-2.36,0-4.21.74-5.29,1.38v2.96c.95-.73,3.04-1.5,4.87-1.5,1.7,0,2.48.59,2.48,2.21v.83h-.57c-5.44,0-7.85,1.8-7.85,4.84s1.85,4.75,4.6,4.75c2.09,0,2.99-.69,3.67-1.4h.15c.03.39.15.89.26,1.2h3.47c-.12-1.22-.18-2.45-.18-3.67v-6.58h0Zm-16.34,10.25h4.21l-7.38-10.9,6.69-9.86h-3.67l-6.43,9.55V3.1h-3.61v20.76h3.61v-9.74l6.58,9.74Z'%3e%3c/path%3e%3cpath%20class='cls-1'%20d='m39.54,21.04h-5.02c.99-2.27,1.26-6.36,1.26-8.96v-.45h3.76v9.41h0Zm12.33-9.7c1.76,0,2.3,1.46,2.3,3.34v.29h-4.96c.09-2.38.95-3.64,2.66-3.64h0Zm-26.79-2.52v5.95h-4.75v-5.95h-3.56v15.03h3.56v-6.28h4.75v6.28h3.55v-15.03h-3.55Zm19.59,12.22h-1.58v-12.22h-10.36v1.29c0,3.67-.24,8.41-1.49,10.93h-1.11v6.24h3.29v-3.43h7.97v3.43h3.29v-6.24h0Zm24.32,2.81h4.02l-5.7-7.98,5.02-7.05h-3.59l-5.01,7.05v-7.05h-3.56v15.03h3.56v-7.26l5.26,7.26h0Zm-11.35-1.02v-2.9c-1.1.75-2.96,1.4-4.69,1.4-2.6,0-3.58-1.22-3.73-3.73h8.57v-1.87c0-5.23-2.3-7.2-5.86-7.2-4.32,0-6.39,3.31-6.39,7.85,0,5.23,2.57,7.76,7.11,7.76,2.26,0,3.94-.59,4.98-1.31h0Zm22.22,1.31c-4.75,0-7.05-2.77-7.05-7.79,0-4.57,2.36-7.82,6.91-7.82,1.76,0,3.07.29,3.82.72v3.02c-.72-.45-2.05-.92-3.43-.92-2.33,0-3.62,1.67-3.62,4.93s1.05,5.07,3.59,5.07c1.49,0,2.56-.39,3.46-1.01v2.89c-.87.63-2.03.92-3.67.92h0Zm-69.68-.29h3.61V3.1h-5.26C3.25,3.1.48,5.81.48,9.81c0,3.19,1.52,5.08,4.24,7.02L0,23.85h3.91l5.26-7.86-1.82-1.23c-2.21-1.49-3.29-2.66-3.29-5.16,0-2.21,1.55-3.7,4.51-3.7h1.61v17.95Z'%3e%3c/path%3e%3c/g%3e%3c/g%3e%3c/svg%3e" alt=""></a></div>
                                    <div class="reviews__slider-row">
                                        <div class="reviews__slider-date text-regular">14 февраля 2024</div>
                                        <div class="reviews__slider-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="76" height="16" viewbox="0 0 76 16" fill="none">
                                                <path d="M6.1021 3.60575C6.94653 2.09092 7.36873 1.3335 8 1.3335C8.63126 1.3335 9.05346 2.09091 9.89786 3.60574L10.1163 3.99765C10.3563 4.42812 10.4763 4.64336 10.6634 4.78537C10.8505 4.92738 11.0834 4.9801 11.5494 5.08553L11.9737 5.18152C13.6134 5.55254 14.4333 5.73804 14.6284 6.36532C14.8235 6.99256 14.2645 7.64623 13.1466 8.95343L12.8574 9.29163C12.5397 9.6631 12.3809 9.84883 12.3094 10.0786C12.238 10.3084 12.262 10.5562 12.31 11.0519L12.3537 11.5031C12.5227 13.2472 12.6073 14.1193 12.0966 14.507C11.5859 14.8946 10.8182 14.5412 9.28286 13.8343L8.88566 13.6514C8.4494 13.4505 8.23126 13.35 8 13.35C7.76873 13.35 7.5506 13.4505 7.11433 13.6514L6.71713 13.8343C5.18178 14.5412 4.41412 14.8946 3.90343 14.507C3.39274 14.1193 3.47725 13.2472 3.64626 11.5031L3.68998 11.0519C3.73802 10.5562 3.76203 10.3084 3.69057 10.0786C3.61912 9.84883 3.46028 9.6631 3.14261 9.29163L2.8534 8.95343C1.7355 7.64623 1.17654 6.99256 1.37161 6.36532C1.56668 5.73804 2.38657 5.55254 4.02636 5.18152L4.45059 5.08553C4.91656 4.9801 5.14955 4.92738 5.33662 4.78537C5.5237 4.64336 5.64368 4.42812 5.88364 3.99765L6.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M21.1021 3.60575C21.9465 2.09092 22.3687 1.3335 23 1.3335C23.6313 1.3335 24.0535 2.09091 24.8979 3.60574L25.1163 3.99765C25.3563 4.42812 25.4763 4.64336 25.6634 4.78537C25.8505 4.92738 26.0834 4.9801 26.5494 5.08553L26.9737 5.18152C28.6134 5.55254 29.4333 5.73804 29.6284 6.36532C29.8235 6.99256 29.2645 7.64623 28.1466 8.95343L27.8574 9.29163C27.5397 9.6631 27.3809 9.84883 27.3094 10.0786C27.238 10.3084 27.262 10.5562 27.31 11.0519L27.3537 11.5031C27.5227 13.2472 27.6073 14.1193 27.0966 14.507C26.5859 14.8946 25.8182 14.5412 24.2829 13.8343L23.8857 13.6514C23.4494 13.4505 23.2313 13.35 23 13.35C22.7687 13.35 22.5506 13.4505 22.1143 13.6514L21.7171 13.8343C20.1818 14.5412 19.4141 14.8946 18.9034 14.507C18.3927 14.1193 18.4772 13.2472 18.6463 11.5031L18.69 11.0519C18.738 10.5562 18.762 10.3084 18.6906 10.0786C18.6191 9.84883 18.4603 9.6631 18.1426 9.29163L17.8534 8.95343C16.7355 7.64623 16.1765 6.99256 16.3716 6.36532C16.5667 5.73804 17.3866 5.55254 19.0264 5.18152L19.4506 5.08553C19.9166 4.9801 20.1495 4.92738 20.3366 4.78537C20.5237 4.64336 20.6437 4.42812 20.8836 3.99765L21.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M36.1021 3.60575C36.9465 2.09092 37.3687 1.3335 38 1.3335C38.6313 1.3335 39.0535 2.09091 39.8979 3.60574L40.1163 3.99765C40.3563 4.42812 40.4763 4.64336 40.6634 4.78537C40.8505 4.92738 41.0834 4.9801 41.5494 5.08553L41.9737 5.18152C43.6134 5.55254 44.4333 5.73804 44.6284 6.36532C44.8235 6.99256 44.2645 7.64623 43.1466 8.95343L42.8574 9.29163C42.5397 9.6631 42.3809 9.84883 42.3094 10.0786C42.238 10.3084 42.262 10.5562 42.31 11.0519L42.3537 11.5031C42.5227 13.2472 42.6073 14.1193 42.0966 14.507C41.5859 14.8946 40.8182 14.5412 39.2829 13.8343L38.8857 13.6514C38.4494 13.4505 38.2313 13.35 38 13.35C37.7687 13.35 37.5506 13.4505 37.1143 13.6514L36.7171 13.8343C35.1818 14.5412 34.4141 14.8946 33.9034 14.507C33.3927 14.1193 33.4772 13.2472 33.6463 11.5031L33.69 11.0519C33.738 10.5562 33.762 10.3084 33.6906 10.0786C33.6191 9.84883 33.4603 9.6631 33.1426 9.29163L32.8534 8.95343C31.7355 7.64623 31.1765 6.99256 31.3716 6.36532C31.5667 5.73804 32.3866 5.55254 34.0264 5.18152L34.4506 5.08553C34.9166 4.9801 35.1495 4.92738 35.3366 4.78537C35.5237 4.64336 35.6437 4.42812 35.8836 3.99765L36.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M51.1021 3.60575C51.9465 2.09092 52.3687 1.3335 53 1.3335C53.6313 1.3335 54.0535 2.09091 54.8979 3.60574L55.1163 3.99765C55.3563 4.42812 55.4763 4.64336 55.6634 4.78537C55.8505 4.92738 56.0834 4.9801 56.5494 5.08553L56.9737 5.18152C58.6134 5.55254 59.4333 5.73804 59.6284 6.36532C59.8235 6.99256 59.2645 7.64623 58.1466 8.95343L57.8574 9.29163C57.5397 9.6631 57.3809 9.84883 57.3094 10.0786C57.238 10.3084 57.262 10.5562 57.31 11.0519L57.3537 11.5031C57.5227 13.2472 57.6073 14.1193 57.0966 14.507C56.5859 14.8946 55.8182 14.5412 54.2829 13.8343L53.8857 13.6514C53.4494 13.4505 53.2313 13.35 53 13.35C52.7687 13.35 52.5506 13.4505 52.1143 13.6514L51.7171 13.8343C50.1818 14.5412 49.4141 14.8946 48.9034 14.507C48.3927 14.1193 48.4773 13.2472 48.6463 11.5031L48.69 11.0519C48.738 10.5562 48.762 10.3084 48.6906 10.0786C48.6191 9.84883 48.4603 9.6631 48.1426 9.29163L47.8534 8.95343C46.7355 7.64623 46.1765 6.99256 46.3716 6.36532C46.5667 5.73804 47.3866 5.55254 49.0264 5.18152L49.4506 5.08553C49.9166 4.9801 50.1496 4.92738 50.3366 4.78537C50.5237 4.64336 50.6437 4.42812 50.8836 3.99765L51.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                                <path d="M66.1021 3.60575C66.9465 2.09092 67.3687 1.3335 68 1.3335C68.6313 1.3335 69.0535 2.09091 69.8979 3.60574L70.1163 3.99765C70.3563 4.42812 70.4763 4.64336 70.6634 4.78537C70.8505 4.92738 71.0834 4.9801 71.5494 5.08553L71.9737 5.18152C73.6134 5.55254 74.4333 5.73804 74.6284 6.36532C74.8235 6.99256 74.2645 7.64623 73.1466 8.95343L72.8574 9.29163C72.5397 9.6631 72.3809 9.84883 72.3094 10.0786C72.238 10.3084 72.262 10.5562 72.31 11.0519L72.3537 11.5031C72.5227 13.2472 72.6073 14.1193 72.0966 14.507C71.5859 14.8946 70.8182 14.5412 69.2829 13.8343L68.8857 13.6514C68.4494 13.4505 68.2313 13.35 68 13.35C67.7687 13.35 67.5506 13.4505 67.1143 13.6514L66.7171 13.8343C65.1818 14.5412 64.4141 14.8946 63.9034 14.507C63.3927 14.1193 63.4773 13.2472 63.6463 11.5031L63.69 11.0519C63.738 10.5562 63.762 10.3084 63.6906 10.0786C63.6191 9.84883 63.4603 9.6631 63.1426 9.29163L62.8534 8.95343C61.7355 7.64623 61.1765 6.99256 61.3716 6.36532C61.5667 5.73804 62.3866 5.55254 64.0264 5.18152L64.4506 5.08553C64.9166 4.9801 65.1496 4.92738 65.3366 4.78537C65.5237 4.64336 65.6437 4.42812 65.8836 3.99765L66.1021 3.60575Z" fill="#fc0" stroke="#fc0" stroke-width="0.00064"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="reviews__slider-body"><p class="reviews__slider-description text-regular">Крутой мастер класс,
                                        спасибо теперь знаю какой кофе выбрать для себя, а так же вернусь что бы при их
                                        помощи открыть свою кофейню, все доходчиво и индивидуально</p></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact main-section">
            <div class="contact__inner"><h4 class="contact__vertical-text heading-title-vertical">Контакты</h4>
                <div class="contact__container container">
                    <div class="contact__content">
                        <div class="contact__maps" id="map"></div>
                        <div class="contact__right"><h2 class="contact__title heading-title-section">Контакты</h2>
                            <div class="contact__card"><a class="contact__card-item contact__link contact__tel text-regular" href="tel:+7%20(925)%20152-28-66">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.6002 14.5215C13.2052 17.0421 7.09606 10.9878 9.50019 8.45753C10.9681 6.91263 9.30988 5.14707 8.39205 3.84934C6.66948 1.41378 2.88796 4.77641 3.0028 6.91544C3.36497 13.6609 10.6618 21.6546 17.7278 20.9574C19.9383 20.7393 22.4781 16.7471 19.9426 15.2882C18.6747 14.5587 16.9345 13.1172 15.6002 14.5215Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14 3C15.8565 3 17.637 3.7375 18.9497 5.05025C20.2625 6.36301 21 8.14348 21 10" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14 7C14.7956 7 15.5587 7.31607 16.1213 7.87868C16.6839 8.44129 17 9.20435 17 10" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                +7 (925) 152-28-66 </a><a class="contact__card-item contact__link contact__email text-regular" href="mailto:consulting@academy-barista.ru">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z" stroke="#DFDFEC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="#DFDFEC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                consulting@academy-barista.ru</a>
                                <address class="contact__card-item contact__card-address text-regular">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 13.43C13.7231 13.43 15.12 12.0331 15.12 10.31C15.12 8.58687 13.7231 7.19 12 7.19C10.2769 7.19 8.88 8.58687 8.88 10.31C8.88 12.0331 10.2769 13.43 12 13.43Z" stroke="#DFDFEC" stroke-width="1.5"></path>
                                        <path d="M3.62001 8.49C5.59001 -0.169998 18.42 -0.159997 20.38 8.5C21.53 13.58 18.37 17.88 15.6 20.54C13.59 22.48 10.41 22.48 8.39001 20.54C5.63001 17.88 2.47001 13.57 3.62001 8.49Z" stroke="#DFDFEC" stroke-width="1.5"></path>
                                    </svg>
                                    г.Москва, Фридриха Энгельса, 25с7
                                </address>
                                <div class="contact__card-item contact__card-hourse text-regular">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    Пн-Вс 10:00 – 20:00
                                </div>
                            </div>
                            <ul class="contact__social">
                                <li class="contact__social-item"><a class="contact__social-link" href="https://t.me/academybarista" target="_blank" title="https://t.me/academybarista">
                                    <svg class="contact__social-icon" width="36" height="36" viewbox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="36" height="36" rx="18" fill="#33373E"></rect>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0996 16.5964C14.3931 14.7618 17.2561 13.5523 18.6886 12.968C22.7788 11.2995 23.6287 11.0097 24.1826 11.0001C24.3045 10.998 24.5769 11.0276 24.7533 11.1681C25.0151 11.3764 25.0166 11.8286 24.9875 12.1278C24.7659 14.4119 23.8068 19.9545 23.3189 22.5127C23.1124 23.5951 22.7059 23.9581 22.3124 23.9936C21.4571 24.0707 20.8076 23.4392 19.9792 22.9067C18.683 22.0733 17.9507 21.5545 16.6924 20.7414C15.2383 19.8016 16.1809 19.2851 17.0096 18.4409C17.2265 18.22 20.9949 14.8583 21.0678 14.5534C21.077 14.5152 21.0854 14.373 20.9993 14.298C20.9132 14.223 20.7861 14.2486 20.6944 14.269C20.5644 14.2979 18.4936 15.6403 14.482 18.2961C13.8942 18.6919 13.3618 18.8848 12.8848 18.8747C12.3589 18.8636 11.3474 18.5831 10.5954 18.3434C9.67309 18.0493 8.94002 17.8938 9.00388 17.3945C9.03713 17.1343 9.40234 16.8683 10.0996 16.5964Z" fill="white"></path>
                                    </svg>
                                </a></li>
                                <li class="contact__social-item"><a class="contact__social-link" href="https://Wa.me/79251522866" target="_blank" title="https://Wa.me/79251522866">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 50 50" width="36px" height="36px">
                                        <path fill="#6b5a53" d="M25,2C12.318,2,2,12.318,2,25c0,3.96,1.023,7.854,2.963,11.29L2.037,46.73c-0.096,0.343-0.003,0.711,0.245,0.966 C2.473,47.893,2.733,48,3,48c0.08,0,0.161-0.01,0.24-0.029l10.896-2.699C17.463,47.058,21.21,48,25,48c12.682,0,23-10.318,23-23 S37.682,2,25,2z M36.57,33.116c-0.492,1.362-2.852,2.605-3.986,2.772c-1.018,0.149-2.306,0.213-3.72-0.231 c-0.857-0.27-1.957-0.628-3.366-1.229c-5.923-2.526-9.791-8.415-10.087-8.804C15.116,25.235,13,22.463,13,19.594 s1.525-4.28,2.067-4.864c0.542-0.584,1.181-0.73,1.575-0.73s0.787,0.005,1.132,0.021c0.363,0.018,0.85-0.137,1.329,1.001 c0.492,1.168,1.673,4.037,1.819,4.33c0.148,0.292,0.246,0.633,0.05,1.022c-0.196,0.389-0.294,0.632-0.59,0.973 s-0.62,0.76-0.886,1.022c-0.296,0.291-0.603,0.606-0.259,1.19c0.344,0.584,1.529,2.493,3.285,4.039 c2.255,1.986,4.158,2.602,4.748,2.894c0.59,0.292,0.935,0.243,1.279-0.146c0.344-0.39,1.476-1.703,1.869-2.286 s0.787-0.487,1.329-0.292c0.542,0.194,3.445,1.604,4.035,1.896c0.59,0.292,0.984,0.438,1.132,0.681 C37.062,30.587,37.062,31.755,36.57,33.116z"></path>
                                    </svg>
                                </a></li>
                                <li class="contact__social-item"><a class="contact__social-link" href="https://vk.com/academybarista1" target="_blank" title="https://vk.com/academybarista1">
                                    <svg class="contact__social-icon" width="36" height="36" viewbox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="36" height="36" rx="18" fill="#282020"></rect>
                                        <path d="M18.7145 23C13.2479 23 10.1299 19.2462 10 13H12.7383C12.8282 17.5846 14.8469 19.5265 16.4459 19.9269V13H19.0244V16.954C20.6034 16.7838 22.2622 14.982 22.8218 13H25.4003C24.9705 15.4424 23.1717 17.2442 21.8925 17.985C23.1717 18.5856 25.2205 20.1572 26 23H23.1617C22.5521 21.0981 21.0332 19.6266 19.0244 19.4264V23H18.7145Z" fill="white"></path>
                                    </svg>
                                </a></li>
                                <li class="contact__social-item"><a class="contact__social-link" href="https://youtube.com/@academybarista" target="_blank" title="https://youtube.com/@academybarista">
                                    <svg class="contact__social-icon" xmlns="http://www.w3.org/2000/svg" fill="#6b5a53" width="36" height="36" viewbox="0 0 20 20">
                                        <path d="M11.603 9.833L9.357 8.785C9.161 8.694 9 8.796 9 9.013v1.974c0 .217.161.319.357.228l2.245-1.048c.197-.092.197-.242.001-.334zM10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6 9.6-4.298 9.6-9.6S15.302.4 10 .4zm0 13.5c-4.914 0-5-.443-5-3.9s.086-3.9 5-3.9 5 .443 5 3.9-.086 3.9-5 3.9z"></path>
                                    </svg>
                                </a></li>
                            </ul>
                            <button class="certificate__card-button button button-brown open-modal">Оставить заявку
                                <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
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
                        <input type="hidden" class="form-purpose" value="Тип заявки: Подарок Сертификата"></form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
