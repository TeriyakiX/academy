@php $a = config('home.about'); @endphp

<section class="ab-about ab-reveal">
    <div class="ab-container">
        <div class="ab-about__grid">
            <div class="ab-about__media">
                <img src="/assets/about.webp" alt="Академия Бариста в Москве" loading="lazy" width="640" height="520">
                <div class="ab-about__badge">
                    <strong>{{ $a['badge']['value'] }}</strong>
                    <span>{{ $a['badge']['label'] }}</span>
                </div>
            </div>

            <div class="ab-about__body">
                <h2 class="ab-h2">{{ $a['title'] }}</h2>
                <p class="ab-lead">{{ $a['lead'] }}</p>
                <p class="ab-about__text">{{ $a['text'] }}</p>

                <ul class="ab-about__list">
                    @foreach ($a['facts'] as $fact)
                        <li>{{ $fact }}</li>
                    @endforeach
                </ul>

                <div class="ab-about__actions">
                    <button class="ab-btn ab-btn--primary js-open-modal" type="button" data-modal-path="consultation">
                        Оставить заявку
                    </button>
                    <a class="ab-btn ab-btn--outline" href="/courses.html">Выбрать курс</a>
                </div>
            </div>
        </div>
    </div>
</section>
