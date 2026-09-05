@include('partials.site.icons')

<header class="site-header">
    {{-- Верхняя строка: контакты и соцсети --}}
    <div class="site-header__top">
        <div class="site-header__container">
            <a class="site-header__contact" href="{{ config('nav.contacts.phone_href') }}">
                <svg class="site-icon"><use href="#i-phone"></use></svg>
                {{ config('nav.contacts.phone') }}
            </a>
            <a class="site-header__contact site-header__contact--hide-sm" href="mailto:{{ config('nav.contacts.email') }}">
                <svg class="site-icon"><use href="#i-mail"></use></svg>
                {{ config('nav.contacts.email') }}
            </a>
            <span class="site-header__contact site-header__contact--hide-md">
                <svg class="site-icon"><use href="#i-pin"></use></svg>
                {{ config('nav.contacts.address') }}
            </span>

            <ul class="site-header__socials">
                @foreach (config('nav.socials') as $s)
                    <li>
                        <a class="site-social" href="{{ $s['href'] }}" target="_blank" rel="noopener" title="{{ $s['title'] }}" aria-label="{{ $s['title'] }}">
                            <svg class="site-icon"><use href="#i-{{ $s['icon'] }}"></use></svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Основная строка: логотип, меню, кнопка --}}
    <div class="site-header__main">
        <div class="site-header__container">
            <a class="site-header__logo" href="/" aria-label="Академия Бариста — на главную">
                <img src="/assets/logo.png" alt="Академия Бариста" width="64" height="64" loading="eager">
            </a>

            <nav class="site-nav" aria-label="Основное меню">
                <ul class="site-nav__list">
                    @foreach (config('nav.main') as $item)
                        @php $current = request()->getPathInfo() === $item['href']; @endphp
                        <li class="site-nav__item @if (!empty($item['children'])) site-nav__item--has-children @endif">
                            <a class="site-nav__link @if (!empty($item['accent'])) site-nav__link--accent @endif @if ($current) is-current @endif"
                               href="{{ $item['href'] }}" @if ($current) aria-current="page" @endif>
                                {{ $item['title'] }}
                                @if (!empty($item['children']))
                                    <svg class="site-nav__chevron"><use href="#i-chevron"></use></svg>
                                @endif
                            </a>
                            @if (!empty($item['children']))
                                <ul class="site-nav__submenu">
                                    @foreach ($item['children'] as $child)
                                        <li><a href="{{ $child['href'] }}">{{ $child['title'] }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>

            <button class="site-header__cta ab-btn ab-btn--primary js-open-modal" type="button" data-modal-path="consultation">
                Оставить заявку
            </button>

            <button class="site-burger" type="button" aria-label="Меню" aria-expanded="false" aria-controls="site-mobile-menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

{{-- Мобильное меню --}}
<div class="site-mobile" id="site-mobile-menu" hidden>
    <div class="site-mobile__panel">
        <div class="site-mobile__head">
            <a class="site-mobile__logo" href="/"><img src="/assets/logo.png" alt="Академия Бариста" width="52" height="52"></a>
            <button class="site-mobile__close" type="button" aria-label="Закрыть">&times;</button>
        </div>

        <nav class="site-mobile__nav">
            <ul>
                @foreach (config('nav.main') as $item)
                    <li>
                        @if (!empty($item['children']))
                            <button class="site-mobile__toggle" type="button" aria-expanded="false">
                                {{ $item['title'] }}
                                <svg class="site-icon"><use href="#i-chevron"></use></svg>
                            </button>
                            <ul class="site-mobile__sub" hidden>
                                <li><a href="{{ $item['href'] }}">Все {{ mb_strtolower($item['title']) }}</a></li>
                                @foreach ($item['children'] as $child)
                                    <li><a href="{{ $child['href'] }}">{{ $child['title'] }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <a class="site-mobile__link" href="{{ $item['href'] }}">{{ $item['title'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="site-mobile__contacts">
            <a href="{{ config('nav.contacts.phone_href') }}">{{ config('nav.contacts.phone') }}</a>
            <a href="mailto:{{ config('nav.contacts.email') }}">{{ config('nav.contacts.email') }}</a>
            <span>{{ config('nav.contacts.address') }}</span>
            <span>{{ config('nav.contacts.hours') }}</span>
        </div>

        <ul class="site-mobile__socials">
            @foreach (config('nav.socials') as $s)
                <li><a class="site-social" href="{{ $s['href'] }}" target="_blank" rel="noopener" aria-label="{{ $s['title'] }}">
                    <svg class="site-icon"><use href="#i-{{ $s['icon'] }}"></use></svg>
                </a></li>
            @endforeach
        </ul>
    </div>
</div>
