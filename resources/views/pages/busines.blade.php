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
                    <li class="bread-crumbs__nav-item"><a class="bread-crumbs__nav-link bread-crumbs__nav-link-is-active text-regular" href="/busines.html">Для бизнеса</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <main class="main">
        <section class="hero">
            <div class="hero__container container">
                <div class="hero__top">
                    <div class="hero__info"><h1 class="hero__title heading-title-general">Услуги для Бизнеса</h1>
                        <p class="hero__description text-medium">Наши услуги идеально подойдут тебе, если ты стоишь на
                            пороге открытия своей первой кофейни или уже управляешь заведением и стремишься вывести его
                            на качественно новый уровень.</p>
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
                    <div class="hero__image"><img src="/assets/busines.png" alt="кофейный бизнес с нуля - школа бариста"></div>
                </div>
            </div>
        </section>
        <section class="courses main-section">
            <div class="courses__inner">
                <div class="courses__container container"><h2 class="courses__title heading-title-section">Программы и
                    курсы</h2>
                    <div class="courses__body">
                        <article class="courses__card">
                            <div class="courses__card-image"><img loading="lazy" src="/assets/12.jpg" alt="Подбор поставщиков и оборудования для кофейни">
                            </div>
                            <div class="courses__card-body">
                                <nav class="courses__card-nav">
                                    <button class="courses__card-nav-button active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M0 3.75A.75.75 0 0 1 .75 3h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 3.75ZM0 8a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 8Zm.75 3.5a.75.75 0 0 0 0 1.5h9.5a.75.75 0 0 0 0-1.5H.75Z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Основное</span></button>
                                    <button class="courses__card-nav-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Описание</span></button>
                                </nav>
                                <div class="courses__card-general">
                                    <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">
                                        Подбор поставщиков и оборудования для кофейни</h3>
                                        <div class="courses__card-row">
                                            <div class="courses__card-col">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                </svg>
                                                <span class="text-small">8 000 ₽</span></div>
                                            <div class="courses__card-col">
                                                <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span class="text-small">1 день 4 часа</span></div>
                                        </div>
                                        <p class="courses__card-text text-small">Мы поможем подобрать всё необходимое
                                            для кофейни — от профессионального оборудования до надёжных поставщиков
                                            кофе, молока, сиропов, посуды и инвентаря.</p></div>
                                </div>
                                <div class="courses__card-descr">
                                    <div class="courses__card-information"><h3 class="courses__card-label">Что входит в
                                        наши услуги:</h3>
                                        <ul class="courses__card-list">
                                            <li class="courses__card-item text-small">Подбор эспрессо-машин, кофемолок,
                                                фильтрационных систем и бойлеров с учётом формата кофейни и бюджета
                                            </li>
                                            <li class="courses__card-item text-small">Поиск поставщиков кофе, молока,
                                                сиропов, посуды (одноразовой и керамической), инвентаря для заваривания
                                                кофе
                                            </li>
                                            <li class="courses__card-item text-small">Рекомендации по выбору техники и
                                                комплектующих, подходящих под концепцию вашего заведения
                                            </li>
                                        </ul>
                                        <p class="courses__card-text text-small">Мы сопровождаем вас на каждом этапе —
                                            от консультаций и подбора до финальных закупок</p>
                                        <p class="courses__card-text courses__card-text-strong text-small">Работаем
                                            только с проверенными брендами и надёжными поставщиками</p>
                                        <p class="courses__card-text text-small">Хотите быстро и безопасно собрать всё
                                            необходимое для кофейни? Оставьте заявку — начнём уже сегодня</p></div>
                                </div>
                                <a class="courses__card-button button button-brown" href="#give">Оставить заявку
                                    <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a></div>
                        </article>
                        <article class="courses__card">
                            <div class="courses__card-image"><img loading="lazy" src="/assets/22.jpg" alt="Разработка меню для кофейни"></div>
                            <div class="courses__card-body">
                                <nav class="courses__card-nav">
                                    <button class="courses__card-nav-button active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M0 3.75A.75.75 0 0 1 .75 3h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 3.75ZM0 8a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 8Zm.75 3.5a.75.75 0 0 0 0 1.5h9.5a.75.75 0 0 0 0-1.5H.75Z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Основное</span></button>
                                    <button class="courses__card-nav-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Описание</span></button>
                                </nav>
                                <div class="courses__card-general">
                                    <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">
                                        Разработка меню для кофейни под ключ онлайн\оффлайн</h3>
                                        <div class="courses__card-row">
                                            <div class="courses__card-col">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                </svg>
                                                <span class="text-small">от 15 000 ₽</span></div>
                                            <div class="courses__card-col">
                                                <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span class="text-small">2 дня по 3 часа</span></div>
                                        </div>
                                        <p class="courses__card-text text-small">Меню — это сердце вашей кофейни. Оно
                                            должно быть актуальным, понятным, рентабельным и подчеркивать стиль вашего
                                            заведения. Наша команда поможет вам разработать кофейное меню, которое
                                            привлечет гостей и увеличит прибыль.</p></div>
                                </div>
                                <div class="courses__card-descr">
                                    <div class="courses__card-information"><h3 class="courses__card-label">Что входит в
                                        наши услуги:</h3>
                                        <div class="courses__card-list">
                                            <div class="courses__card-item">
                                                <div><span class="courses__card-text-strong text-small">Формирование базового кофейного меню</span>
                                                    <p class="text-small">Мы создадим классическую карту напитков:
                                                        эспрессо, капучино, латте, американо, фильтр (Батч-брю). Учтём
                                                        вкусы вашей аудитории и формат кофейни, чтобы меню идеально
                                                        вписалось в ваш бизнес.</p></div>
                                            </div>
                                            <div class="courses__card-item">
                                                <div><span class="courses__card-text-strong text-small">Разработка сезонных и авторских напитков</span>
                                                    <p class="text-small">Хотите выделиться? Мы придумаем уникальные
                                                        рецепты сезонных и авторских напитков на основе кофе, какао или
                                                        других ингредиентов. Все рецепты адаптируем под ваш бюджет,
                                                        сохраняя их привлекательность и рентабельность.</p></div>
                                            </div>
                                            <div class="courses__card-item">
                                                <div><span class="courses__card-text-strong text-small">Собираем сбалансированную карту напитков</span>
                                                    <p class="text-small">Мы соберем меню, где классика и креатив
                                                        дополняют друг друга. Каждый гость найдет свой любимый напиток,
                                                        что повысит лояльность и средний чек.</p></div>
                                            </div>
                                        </div>
                                        <h3 class="courses__card-label">Дополнительные преимущества:</h3>
                                        <ul class="courses__card-list">
                                            <li class="courses__card-item text-small">Помощь в выборе качественного
                                                сырья и надежных поставщиков.
                                            </li>
                                            <li class="courses__card-item text-small">Рекомендации по подаче напитков и
                                                подбору посуды
                                            </li>
                                            <li class="courses__card-item text-small">Консультации по ценообразованию
                                                для максимальной прибыли.
                                            </li>
                                        </ul>
                                        <p class="courses__card-text text-small">Наша цель — сделать процесс работы
                                            вашего бариста простым, а выбор для гостей — очевидным. Разработка меню для
                                            кофейни с нами — это шаг к успеху вашего бизнеса.</p></div>
                                </div>
                                <a class="courses__card-button button button-brown" href="#give">Оставить заявку
                                    <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a></div>
                        </article>
                        <article class="courses__card">
                            <div class="courses__card-image"><img loading="lazy" src="/assets/3.webp" alt="Проектирование барной зоны для кофейни"></div>
                            <div class="courses__card-body">
                                <nav class="courses__card-nav">
                                    <button class="courses__card-nav-button active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M0 3.75A.75.75 0 0 1 .75 3h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 3.75ZM0 8a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 8Zm.75 3.5a.75.75 0 0 0 0 1.5h9.5a.75.75 0 0 0 0-1.5H.75Z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Основное</span></button>
                                    <button class="courses__card-nav-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Описание</span></button>
                                </nav>
                                <div class="courses__card-general">
                                    <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">
                                        Проектирование барной зоны для кофейни под ключ</h3>
                                        <div class="courses__card-row">
                                            <div class="courses__card-col">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                </svg>
                                                <span class="text-small">от 15 000 ₽</span></div>
                                            <div class="courses__card-col">
                                                <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span class="text-small">От 3-х до 7-ми дней</span></div>
                                        </div>
                                        <p class="courses__card-text text-small">Ищете того, кто поможет спроектировать
                                            барную зону для кофейни? Мы разработаем удобное, эргономичное и стильное
                                            пространство, где бариста будет работать быстро, а гости — возвращаться
                                            снова и снова.</p></div>
                                </div>
                                <div class="courses__card-descr">
                                    <div class="courses__card-information"><h3 class="courses__card-label">Что входит в
                                        наши услуги:</h3>
                                        <div class="courses__card-list">
                                            <div class="courses__card-item">
                                                <div><span class="courses__card-text-strong text-small">Онлайн-консультация с разбором проекта</span>
                                                    <p class="text-small">Анализ помещения, оборудования, особенностей
                                                        локации и формата взаимодействия с гостями</p></div>
                                            </div>
                                            <div class="courses__card-item">
                                                <div><span class="courses__card-text-strong text-small">Разработка дизайна барной зоны</span>
                                                    <p class="text-small">От пустого пространства до полной
                                                        визуализации, отражающей концепцию кофейни.</p></div>
                                            </div>
                                            <div class="courses__card-item">
                                                <div><span class="courses__card-text-strong text-small">Проектирование бара под ключ</span>
                                                    <p class="text-small">Планировка, расстановка техники, схемы
                                                        коммуникаций, подбор отделки и оборудования — в связке с меню и
                                                        предполагаемой нагрузкой</p></div>
                                            </div>
                                        </div>
                                        <h3 class="courses__card-label">Что вы получите:</h3>
                                        <p class="courses__card-text text-small">Функциональный и стильный бар, который
                                            ускоряет работу бариста, повышает качество сервиса и усиливает атмосферу
                                            вашего заведения.</p>
                                        <p class="courses__card-text text-small">Мы создаём удобное рабочее
                                            пространство, где бариста легко справляется с потоком гостей, а интерьер
                                            работает на узнаваемость бренда. Всё обсуждаем онлайн — быстро, чётко и по
                                            делу</p></div>
                                </div>
                                <a class="courses__card-button button button-brown" href="#give">Оставить заявку
                                    <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a></div>
                        </article>
                        <article class="courses__card">
                            <div class="courses__card-image"><img loading="lazy" src="/assets/4.jpg" alt="Индивидуальная программа обучения бариста"></div>
                            <div class="courses__card-body">
                                <nav class="courses__card-nav">
                                    <button class="courses__card-nav-button active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M0 3.75A.75.75 0 0 1 .75 3h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 3.75ZM0 8a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 8Zm.75 3.5a.75.75 0 0 0 0 1.5h9.5a.75.75 0 0 0 0-1.5H.75Z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Основное</span></button>
                                    <button class="courses__card-nav-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Описание</span></button>
                                </nav>
                                <div class="courses__card-general">
                                    <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">
                                        Индивидуальная программа обучения бариста</h3>
                                        <div class="courses__card-row">
                                            <div class="courses__card-col">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                </svg>
                                                <span class="text-small">от 2 500 ₽</span></div>
                                            <div class="courses__card-col">
                                                <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span class="text-small">Индивидуально</span></div>
                                        </div>
                                        <p class="courses__card-text text-small">Хотите повысить качество кофе, ускорить
                                            работу бариста и увеличить продажи в кофейне – без найма штатного тренера?
                                            Мы разработаем индивидуальную программу обучения бариста под задачи вашего
                                            заведения.</p></div>
                                </div>
                                <div class="courses__card-descr">
                                    <div class="courses__card-information"><h3 class="courses__card-label">Что входит в
                                        обучение бариста:</h3>
                                        <div class="courses__card-list">
                                            <div class="courses__card-item">
                                                <div><p class="text-small">Техники продаж и презентация напитков, чтобы
                                                    бариста мог не только готовить, но и продавать</p></div>
                                            </div>
                                            <div class="courses__card-item">
                                                <div><p class="text-small">Оптимизация работы за барной стойкой и
                                                    увеличение скорости отдачи напитков</p></div>
                                            </div>
                                            <div class="courses__card-item">
                                                <div><p class="text-small">Настройка помола кофе, взбивание молока и
                                                    базовый латте-арт</p></div>
                                            </div>
                                            <div class="courses__card-item">
                                                <div><p class="text-small">Альтернативные способы заваривания кофе для
                                                    расширения ассортимента</p></div>
                                            </div>
                                            <div class="courses__card-item">
                                                <div><p class="text-small">Практические рекомендации с учётом формата
                                                    вашей кофейни и целевой аудитории</p></div>
                                            </div>
                                        </div>
                                        <h3 class="courses__card-label">Почему выбирают нас:</h3>
                                        <p class="courses__card-text text-small">Мы не перегружаем теорией — работаем на
                                            результат: качество напитков, скорость обслуживания, повышение сервиса.</p>
                                        <p class="courses__card-text text-small">Вы получите обученных бариста, готовых
                                            работать эффективно и увеличивать прибыль кофейни.</p>
                                        <p class="courses__card-text courses__card-text-strong text-small">Хотите
                                            улучшить работу бариста и качество кофе в заведении? Оставьте заявку —
                                            составим программу обучения под ваши задачи!</p></div>
                                </div>
                                <a class="courses__card-button button button-brown" href="#give">Оставить заявку
                                    <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a></div>
                        </article>
                        <article class="courses__card">
                            <div class="courses__card-image"><img loading="lazy" src="/assets/52.jpg" alt="Кофейня с нуля - пошаговый запуск кофейни"></div>
                            <div class="courses__card-body">
                                <nav class="courses__card-nav">
                                    <button class="courses__card-nav-button active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M0 3.75A.75.75 0 0 1 .75 3h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 3.75ZM0 8a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 8Zm.75 3.5a.75.75 0 0 0 0 1.5h9.5a.75.75 0 0 0 0-1.5H.75Z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Основное</span></button>
                                    <button class="courses__card-nav-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Описание</span></button>
                                </nav>
                                <div class="courses__card-general">
                                    <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">
                                        Кофейня с нуля - пошаговый запуск кофейни</h3>
                                        <div class="courses__card-row">
                                            <div class="courses__card-col">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                </svg>
                                                <span class="text-small">от 50 000 ₽</span></div>
                                            <div class="courses__card-col">
                                                <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span class="text-small">от 3-х недель</span></div>
                                        </div>
                                        <p class="courses__card-text text-small">Мечтаете открыть свою кофейню, но не
                                            знаете, с чего начать? Наша бизнес-программа «Кофейня с нуля» поможет пройти
                                            весь путь от идеи до первых гостей — быстро, безопасно и без лишних
                                            ошибок.</p></div>
                                </div>
                                <div class="courses__card-descr">
                                    <div class="courses__card-information"><h3 class="courses__card-label">Что включает
                                        программа по открытию кофейни:</h3>
                                        <ul class="courses__card-list">
                                            <li class="courses__card-item text-small">Создание сбалансированного и
                                                прибыльного меню для кофейни
                                            </li>
                                            <li class="courses__card-item text-small">Поиск, обучение и мотивация
                                                персонала под ваш формат
                                            </li>
                                            <li class="courses__card-item text-small">Выбор оптимальной локации для
                                                кофейни с расчётом потенциала трафика
                                            </li>
                                            <li class="courses__card-item text-small">Настройка продаж и маркетинга,
                                                продвижение кофейни
                                            </li>
                                            <li class="courses__card-item text-small">Работа с контролирующими органами:
                                                необходимые документы и лицензии
                                            </li>
                                            <li class="courses__card-item text-small">Технологии приготовления вкусного
                                                кофе, который будет привлекать гостей
                                            </li>
                                        </ul>
                                        <h3 class="courses__card-label">Что вы получите:</h3>
                                        <ul class="courses__card-list">
                                            <li class="courses__card-item text-small">Полное понимание всех этапов
                                                запуска кофейни
                                            </li>
                                            <li class="courses__card-item text-small">Практические инструменты для
                                                открытия и управления
                                            </li>
                                            <li class="courses__card-item text-small">Поддержку команды, которая
                                                помогает открывать кофейни с 2019 года
                                            </li>
                                        </ul>
                                        <p class="courses__card-text courses__card-text-strong text-small">Хотите
                                            открыть кофейню с нуля и избежать типичных ошибок? Оставьте заявку — начнём
                                            строить ваш успешный кофейный бизнес!</p></div>
                                </div>
                                <a class="courses__card-button button button-brown" href="#give">Оставить заявку
                                    <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a></div>
                        </article>
                        <article class="courses__card">
                            <div class="courses__card-image"><img loading="lazy" src="/assets/62.jpg" alt="Курс «Менеджмент кофейни»"></div>
                            <div class="courses__card-body">
                                <nav class="courses__card-nav">
                                    <button class="courses__card-nav-button active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M0 3.75A.75.75 0 0 1 .75 3h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 3.75ZM0 8a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 8Zm.75 3.5a.75.75 0 0 0 0 1.5h9.5a.75.75 0 0 0 0-1.5H.75Z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Основное</span></button>
                                    <button class="courses__card-nav-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Описание</span></button>
                                </nav>
                                <div class="courses__card-general">
                                    <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">
                                        Курс «Менеджмент кофейни»</h3>
                                        <div class="courses__card-row">
                                            <div class="courses__card-col">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                </svg>
                                                <span class="text-small">25 000 ₽</span></div>
                                            <div class="courses__card-col">
                                                <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span class="text-small">3 дня по 4 часа</span></div>
                                        </div>
                                        <p class="courses__card-text text-small">Планируете открыть кофейню и хотите
                                            избежать ошибок новичков? Наш обучающий курс «Менеджмент кофейни: StartUp» —
                                            это полный набор знаний и инструментов для уверенного старта в кофейном
                                            бизнесе.</p></div>
                                </div>
                                <div class="courses__card-descr">
                                    <div class="courses__card-information"><h3 class="courses__card-label">На курсе вы
                                        узнаете:</h3>
                                        <ul class="courses__card-list">
                                            <li class="courses__card-item text-small">Как выбрать локацию для кофейни,
                                                которая будет приносить прибыль
                                            </li>
                                            <li class="courses__card-item text-small">Какие документы нужны для открытия
                                                кофейни и какую форму юрлица выбрать
                                            </li>
                                            <li class="courses__card-item text-small">Как составить бизнес-план и
                                                финансовую модель кофейни
                                            </li>
                                            <li class="courses__card-item text-small">Как подобрать оборудование и
                                                инвентарь для кофейни
                                            </li>
                                            <li class="courses__card-item text-small">Как выбрать кассовую систему и
                                                настроить автоматизацию процессов
                                            </li>
                                            <li class="courses__card-item text-small">Как найти и обучить персонал под
                                                ваш формат кофейни
                                            </li>
                                            <li class="courses__card-item text-small">Как эффективно управлять кофейней
                                                на ежедневной основе
                                            </li>
                                        </ul>
                                        <h3 class="courses__card-label">Что вы получите:</h3>
                                        <ul class="courses__card-list">
                                            <li class="courses__card-item text-small">Пошаговый план запуска кофейни
                                            </li>
                                            <li class="courses__card-item text-small">Практические кейсы и живые примеры
                                                из реального бизнеса
                                            </li>
                                            <li class="courses__card-item text-small">Индивидуальные консультации от
                                                экспертов, которые помогают открывать кофейни с 2019 года
                                            </li>
                                        </ul>
                                        <p class="courses__card-text courses__card-text-strong text-small">Хотите
                                            открыть кофейню с нуля и управлять ею как профессионал? Запишитесь на курс —
                                            начните строить успешный кофейный бизнес уже сегодня!</p></div>
                                </div>
                                <a class="courses__card-button button button-brown" href="#give">Оставить заявку
                                    <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a></div>
                        </article>
                        <article class="courses__card">
                            <div class="courses__card-image"><img loading="lazy" src="/assets/72.jpg" alt="Консалтинг «Кофейня под ключ»"></div>
                            <div class="courses__card-body">
                                <nav class="courses__card-nav">
                                    <button class="courses__card-nav-button active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M0 3.75A.75.75 0 0 1 .75 3h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 3.75ZM0 8a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 8Zm.75 3.5a.75.75 0 0 0 0 1.5h9.5a.75.75 0 0 0 0-1.5H.75Z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Основное</span></button>
                                    <button class="courses__card-nav-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Описание</span></button>
                                </nav>
                                <div class="courses__card-general">
                                    <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">
                                        Консалтинг «Кофейня под ключ»</h3>
                                        <div class="courses__card-row">
                                            <div class="courses__card-col">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                </svg>
                                                <span class="text-small">от 100 000 ₽</span></div>
                                            <div class="courses__card-col">
                                                <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span class="text-small">Индивидуально</span></div>
                                        </div>
                                        <p class="courses__card-text text-small">Открытие кофейни — это большой и
                                            ответственный шаг. Чтобы избежать типичных ошибок и успешно запустить свой
                                            бизнес, мы предлагаем вам полный консалтинговый сервис «Кофейня под ключ».
                                            Мы предоставляем комплексное сопровождение на всех этапах — от разработки
                                            идеи до привлечения первых клиентов.</p></div>
                                </div>
                                <div class="courses__card-descr">
                                    <div class="courses__card-information"><h3 class="courses__card-label">Программа
                                        включает:</h3>
                                        <ul class="courses__card-list">
                                            <li class="courses__card-item text-small">Документация для кофейни —
                                                подготовка всех необходимых документов для открытия.
                                            </li>
                                            <li class="courses__card-item text-small">Структура работы кофейни —
                                                оптимизация процессов для эффективной работы.
                                            </li>
                                            <li class="courses__card-item text-small">Финансовая модель и расчёт
                                                окупаемости — подробный расчёт финансов и окупаемости.
                                            </li>
                                            <li class="courses__card-item text-small">Бизнес-план кофейни — разработка
                                                бизнес-плана для получения инвестиций.
                                            </li>
                                            <li class="courses__card-item text-small">Обучение собственника — от теории
                                                до практики для управления кофейней.
                                            </li>
                                            <li class="courses__card-item text-small">Презентация для арендодателя —
                                                помощь в подготовке презентации для аренды.
                                            </li>
                                            <li class="courses__card-item text-small">Поиск локации — оценка
                                                потенциальных мест для кофейни.
                                            </li>
                                            <li class="courses__card-item text-small">Подбор оборудования — выбор
                                                профессионального оборудования и инвентаря.
                                            </li>
                                            <li class="courses__card-item text-small">Выбор поставщиков кофе и товаров —
                                                помощь в поиске надёжных поставщиков.
                                            </li>
                                            <li class="courses__card-item text-small">Найм персонала — подбор и обучение
                                                команды для кофейни.
                                            </li>
                                            <li class="courses__card-item text-small">Меню и технические карты —
                                                разработка меню и техкарт.
                                            </li>
                                            <li class="courses__card-item text-small">Программное обеспечение —
                                                настройка ПО для автоматизации.
                                            </li>
                                            <li class="courses__card-item text-small">Маркетинговая стратегия —
                                                разработка стратегии продвижения кофейни.
                                            </li>
                                            <li class="courses__card-item text-small">Поддержка на открытии — помощь на
                                                всех этапах открытия.
                                            </li>
                                            <li class="courses__card-item text-small">Сопровождение после запуска — 30
                                                дней поддержки для уверенного старта.
                                            </li>
                                        </ul>
                                        <h3 class="courses__card-label">Что вы получите:</h3>
                                        <p class="courses__card-text text-small">Вы получаете кофейню с обученной
                                            командой, отлаженными процессами и понятной финансовой моделью. Всё готово
                                            для успешного запуска!</p></div>
                                </div>
                                <a class="courses__card-button button button-brown" href="#give">Оставить заявку
                                    <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a></div>
                        </article>
                        <article class="courses__card">
                            <div class="courses__card-image"><img loading="lazy" src="/assets/82.jpg" alt="Онлайн / Оффлайн «Как открыть кофейню»"></div>
                            <div class="courses__card-body">
                                <nav class="courses__card-nav">
                                    <button class="courses__card-nav-button active">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M0 3.75A.75.75 0 0 1 .75 3h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 3.75ZM0 8a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H.75A.75.75 0 0 1 0 8Zm.75 3.5a.75.75 0 0 0 0 1.5h9.5a.75.75 0 0 0 0-1.5H.75Z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Основное</span></button>
                                    <button class="courses__card-nav-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewbox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Описание</span></button>
                                </nav>
                                <div class="courses__card-general">
                                    <div class="courses__card-info"><h3 class="courses__card-name heading-title-name">
                                        Онлайн / Оффлайн<br>«Как открыть кофейню»</h3>
                                        <div class="courses__card-row">
                                            <div class="courses__card-col">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9.5 12.0001C10.8807 12.0001 12 10.8808 12 9.50006C12 8.11935 10.8807 7.00006 9.5 7.00006C8.11929 7.00006 7 8.11935 7 9.50006C7 10.8808 8.11929 12.0001 9.5 12.0001Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round"></path>
                                                </svg>
                                                <span class="text-small">7 000 ₽</span></div>
                                            <div class="courses__card-col">
                                                <svg class="courses__card-icon" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12Z" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.71 15.18L12.61 13.33C12.07 13.01 11.63 12.24 11.63 11.61V7.50999" stroke="#DFDFEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span class="text-small">3 часа</span></div>
                                        </div>
                                        <p class="courses__card-text text-small">Мечтаете о собственной кофейне, но не
                                            знаете, с чего начать? Приглашаем вас на авторский семинар от Академии
                                            Бариста — пошаговое руководство к запуску кофейного бизнеса от тех, кто
                                            помогает открывать кофейни с 2019 года.</p></div>
                                </div>
                                <div class="courses__card-descr">
                                    <div class="courses__card-information"><h3 class="courses__card-label">Для кого этот
                                        семинар:</h3>
                                        <ul class="courses__card-list">
                                            <li class="courses__card-item text-small">Начинающие предприниматели</li>
                                            <li class="courses__card-item text-small">Инвесторы без опыта в ресторанной
                                                сфере
                                            </li>
                                            <li class="courses__card-item text-small">Профессиональные бариста,
                                                мечтающие о своём деле
                                            </li>
                                            <li class="courses__card-item text-small">Любители кофе, желающие превратить
                                                страсть в прибыльный бизнес
                                            </li>
                                        </ul>
                                        <h3 class="courses__card-label">На семинаре вы узнаете:</h3>
                                        <ul class="courses__card-list">
                                            <li class="courses__card-item text-small">Какие форматы кофеен существуют и
                                                их особенности
                                            </li>
                                            <li class="courses__card-item text-small">Как выбрать юридическое лицо и
                                                оформить необходимые документы
                                            </li>
                                            <li class="courses__card-item text-small">Как выбрать локацию с высоким
                                                потенциалом
                                            </li>
                                            <li class="courses__card-item text-small">Как составить бизнес-план и
                                                финансовую модель кофейни
                                            </li>
                                            <li class="courses__card-item text-small">Как создать фирменный стиль и
                                                маркетинговую стратегию
                                            </li>
                                            <li class="courses__card-item text-small">Где искать надёжных поставщиков
                                                для кофейни
                                            </li>
                                            <li class="courses__card-item text-small">Как выбрать оборудование и не
                                                переплатить
                                            </li>
                                            <li class="courses__card-item text-small">Как выбрать кассовую систему и
                                                автоматизировать процессы
                                            </li>
                                            <li class="courses__card-item text-small">Как находить, обучать и удерживать
                                                персонал
                                            </li>
                                            <li class="courses__card-item text-small">Как эффективно управлять
                                                кофейней
                                            </li>
                                        </ul>
                                        <h3 class="courses__card-label">Бонусы для участников:</h3>
                                        <ul class="courses__card-list">
                                            <li class="courses__card-item text-small">Дегустация авторских напитков</li>
                                            <li class="courses__card-item text-small">Разбор реальных кейсов открытия
                                                кофеен
                                            </li>
                                            <li class="courses__card-item text-small">Интерактив с экспертами и ответы
                                                на ваши вопросы
                                            </li>
                                            <li class="courses__card-item text-small">Разбор бюджетов и старта кофеен от
                                                мини-островков до крупных заведений
                                            </li>
                                        </ul>
                                        <h3 class="courses__card-label">Результат:</h3>
                                        <p class="courses__card-text text-small">За один день вы получите полное
                                            представление о запуске кофейни и чёткое понимание, с чего начать. Это ваш
                                            первый шаг к успешному кофейному бизнесу!</p></div>
                                </div>
                                <a class="courses__card-button button button-brown" href="#give">Оставить заявку
                                    <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a></div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <section class="give main-section" id="give">
            <div class="give__container container">
                <div class="give__card"><h2 class="give__title heading-title-section">Оставьте заявку</h2>
                    <form class="give__form form-give" action=""><label class="give__form-label form__label" for=""><input class="give__form-input form__input form-name" name="Имя" type="text" placeholder="Ваше имя"></label> <label class="give__form-label form__label" for=""><input class="give__form-input form__input form-phone" name="Телефон" type="tel" placeholder="Телефон"></label> <label class="give__form-label custom-select form__label" for="" name="Программа"><select class="give__form-select form-select" name="Программа">
                        <option class="give__form-option form-option" value="">Выберите программу</option>
                        <option class="give__form-option form-option" value="Подбор поставщиков и оборудования для кофейни">Подбор поставщиков и оборудования
                            для кофейни
                        </option>
                        <option class="give__form-option form-option" value="Разработка меню для кофейни под ключ">
                            Разработка меню для кофейни под ключ
                        </option>
                        <option class="give__form-option form-option" value="Проектирование барной зоны для кофейни под ключ">Проектирование барной зоны для
                            кофейни под ключ
                        </option>
                        <option class="give__form-option form-option" value="Программа обучения бариста для кофейни">
                            Программа обучения бариста для кофейни
                        </option>
                        <option class="give__form-option form-option" value="Кофейня с нуля - пошаговый запуск кофейни">
                            Кофейня с нуля - пошаговый запуск кофейни
                        </option>
                        <option class="give__form-option form-option" value="Курс «Менеджмент кофейни: StartUp»Юный Бариста">Курс «Менеджмент кофейни:
                            StartUp»
                        </option>
                        <option class="give__form-option form-option" value="Кофейня с нуля - пошаговый запуск кофейни">
                            Кофейня с нуля - пошаговый запуск кофейни
                        </option>
                        <option class="give__form-option form-option" value="Вебинар / Семинар «Как открыть кофейню»">
                            Вебинар / Семинар «Как открыть кофейню»
                        </option>
                    </select></label> <label class="give__form-label form__label" for=""><textarea class="modal__form-textarea form__textarea" placeholder="Ваше сообщение" name="Сообщение"></textarea></label>
                        <button class="give__form-button form__button button button-brown" type="submit">Оставить заявку
                            <svg class="button-icon" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="button-icon-path" d="M1.5 12.5L12.5 1.5M12.5 1.5H3.5M12.5 1.5V10.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <div class="give__form-chek form__chek">
                            <div><input class="give__form-checkbox form__chek-chekbox" type="checkbox" required> <span class="give__form-text form__chek-text text-regular">Согласен на обработку <a href="/docs/%D0%A1%D0%BE%D0%B3%D0%BB%D0%B0%D1%81%D0%B8%D0%B5_%D0%BE%D0%B1%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%BA%D0%B8_%D0%9F%D0%94_%D0%90%D0%BA%D0%B0%D0%B4%D0%B5%D0%BC%D0%B8%D0%B8_%D0%B1%D0%B0%D1%80%D0%B8%D1%81%D1%82%D0%B0.pdf">персональных данных</a></span>
                            </div>
                        </div>
                        <input type="hidden" class="form-purpose" value="Тип заявки: Консультация по бизнесу"></form>
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
                        <input type="hidden" class="form-purpose" value="Тип заявки: Для бизнеса"></form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
