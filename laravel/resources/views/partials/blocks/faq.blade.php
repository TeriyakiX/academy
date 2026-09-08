<section class="ab-faq ab-reveal">
    <div class="ab-container">
        <div class="ab-faq__grid">
            <div class="ab-faq__aside">
                <h2 class="ab-h2">Частые вопросы</h2>
                <p class="ab-lead">Не нашли ответ? Напишите или позвоните — подскажем за пару минут.</p>
                <div class="ab-faq__contacts">
                    <a class="ab-btn ab-btn--primary" href="{{ config('nav.contacts.phone_href') }}">
                        {{ config('nav.contacts.phone') }}
                    </a>

                    <ul class="ab-faq__socials">
                        @foreach (config('nav.socials') as $social)
                            <li>
                                <a class="site-social" href="{{ $social['href'] }}"
                                   target="_blank" rel="noopener" aria-label="{{ $social['title'] }}">
                                    <svg class="site-icon"><use href="#i-{{ $social['icon'] }}"></use></svg>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div data-island="FaqAccordion"
                 data-props="{{ json_encode(['items' => config('home.faq.items')], JSON_UNESCAPED_UNICODE) }}"></div>
        </div>
    </div>
</section>
