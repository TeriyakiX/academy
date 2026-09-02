<footer class="site-footer">
    <div class="site-footer__container">

        <div class="site-footer__top">
            <div class="site-footer__brand">
                <a class="site-footer__logo" href="/"><img src="/assets/logo.svg" alt="Академия Бариста" width="64" height="64" loading="lazy"></a>
                <p class="site-footer__tagline">
                    Профессиональное обучение бариста, барменов и управляющих кофеен в Москве.
                    Работаем по образовательной лицензии.
                </p>
                <ul class="site-footer__socials">
                    @foreach (config('nav.socials') as $s)
                        <li><a class="site-social" href="{{ $s['href'] }}" target="_blank" rel="noopener" aria-label="{{ $s['title'] }}">
                            <svg class="site-icon"><use href="#i-{{ $s['icon'] }}"></use></svg>
                        </a></li>
                    @endforeach
                </ul>
            </div>

            @foreach (config('nav.footer') as $title => $links)
                <div class="site-footer__col">
                    <h3 class="site-footer__col-title">{{ $title }}</h3>
                    <ul>
                        @foreach ($links as $l)
                            <li><a href="{{ $l['href'] }}">{{ $l['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <div class="site-footer__col site-footer__col--contacts">
                <h3 class="site-footer__col-title">Контакты</h3>
                <ul>
                    <li><a href="{{ config('nav.contacts.phone_href') }}">
                        <svg class="site-icon"><use href="#i-phone"></use></svg>{{ config('nav.contacts.phone') }}</a></li>
                    <li><a href="mailto:{{ config('nav.contacts.email') }}">
                        <svg class="site-icon"><use href="#i-mail"></use></svg>{{ config('nav.contacts.email') }}</a></li>
                    <li><span><svg class="site-icon"><use href="#i-pin"></use></svg>{{ config('nav.contacts.address') }}</span></li>
                    <li><span><svg class="site-icon"><use href="#i-clock"></use></svg>{{ config('nav.contacts.hours') }}</span></li>
                </ul>
            </div>
        </div>

        <div class="site-footer__bottom">
            <p class="site-footer__copy">&copy; Академия Бариста, 2020–{{ date('Y') }}</p>
            <ul class="site-footer__legal">
                @foreach (config('nav.legal') as $l)
                    <li><a href="{{ $l['href'] }}">{{ $l['title'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>
