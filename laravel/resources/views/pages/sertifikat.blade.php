@extends('layouts.app')

@push('head')
    @vite([
        'resources/src/app/assets/styles/home-blocks.css',
        'resources/src/app/assets/styles/course.css',
        'resources/src/app/assets/styles/certificate.css',
    ])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--cert">
        <section class="ab-cpage__hero">
            <div class="ab-container">
                <div class="ab-bus__intro">
                    <div>
                        <span class="ab-cpage__tag">Подарочный сертификат</span>
                        <h1 class="ab-cpage__title">Подарочные сертификаты</h1>
                        <p class="ab-cpage__lead">
                            Подарите близким не просто эмоции, а ценные навыки. Обучение искусству
                            бариста или секретам барного дела — подарок, который останется с человеком
                            надолго. Соберите сертификат за два шага — прямо на этой странице.
                        </p>

                        <ul class="ab-cert__list ab-cert__list--dark">
                            <li>Сертификат выписывается на выбранные программы</li>
                            <li>Чем больше программ — тем выше скидка</li>
                            <li>Имя получателя и подпись впишем в сертификат</li>
                        </ul>
                    </div>

                    {{-- Карточка нарисована вёрсткой: на прежнем снимке была
                         напечатана дата окончания, которая давно прошла. --}}
                    <div class="ab-cert__media ab-cert__media--light" aria-hidden="true">
                        <div class="ab-giftcard">
                            <span class="ab-giftcard__sheen"></span>

                            <img class="ab-giftcard__mark" src="/assets/logo.png" alt=""
                                 width="64" height="64" loading="eager" decoding="async">

                            <span class="ab-giftcard__kicker">Подарочный</span>
                            <strong class="ab-giftcard__word">Сертификат</strong>

                            <span class="ab-giftcard__rule"></span>
                            <span class="ab-giftcard__foot">Академия Бариста · Москва</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Оформление по шагам: программа → кому → контакты.
             Без скрипта страница остаётся полезной: ниже есть список программ
             и обычная форма заявки. --}}
        <section class="ab-cwrap ab-reveal" id="oformit">
            <div class="ab-container">
                <h2 class="ab-h2">Соберите сертификат</h2>
                <p class="ab-lead">Два шага: выбрать программы и оставить данные — кому дарите и куда перезвонить.</p>

                <div data-island="CertificateWizard"
                     data-props="{{ json_encode([
                         'schools'   => config('courses.schools'),
                         'discounts' => config('courses.discounts'),
                         'token'     => csrf_token(),
                         'loadedAt'  => encrypt(now()->timestamp),
                         'page'      => request()->getPathInfo(),
                     ], JSON_UNESCAPED_UNICODE) }}">

                    {{-- Видно, пока не загрузился скрипт, и остаётся навсегда,
                         если он отключён. --}}
                    <noscript>
                        <p class="ab-cwrap__fallback">
                            Выберите программу в списке ниже и оставьте заявку —
                            перезвоним и оформим сертификат.
                        </p>
                    </noscript>
                </div>
            </div>
        </section>

        <section class="ab-programs ab-reveal">
            <div class="ab-container">
                <h2 class="ab-h2">На какие программы</h2>
                <p class="ab-lead">Сертификат можно оформить на любой курс или мастер-класс.</p>
                <div data-island="CourseTabs"
                     data-props="{{ json_encode(['schools' => config('courses.schools')], JSON_UNESCAPED_UNICODE) }}"></div>
            </div>
        </section>

        {{-- Обычная форма заявки остаётся: она и запасной путь, если скрипт
             не загрузился, и способ просто задать вопрос. --}}
        @include('partials.blocks.lead', [
            'title' => 'Не знаете, что выбрать?',
            'note'  => 'Расскажем про программы и поможем подобрать сертификат под получателя.',
        ])
    </main>

    @include('partials.site.footer')
</div>
@endsection
