{{--
    Карточка услуги для бизнеса.
    Так же, как карточки курсов: фото, короткое описание, цена и ссылка
    на страницу услуги. Раньше вместо ссылки был раскрывающийся список,
    из-за которого страница прыгала, а услугу нельзя было открыть отдельно.
--}}
<article class="ab-bus__card">
    @if (!empty($service['image']))
        <a class="ab-bus__media" href="{{ $service['url'] }}" aria-hidden="true" tabindex="-1">
            <img src="{{ $service['image'] }}" alt="" width="420" height="240" loading="lazy" decoding="async">
        </a>
    @endif

    <div class="ab-bus__body">
        <h3 class="ab-bus__title">
            <a href="{{ $service['url'] }}">{{ $service['title'] }}</a>
        </h3>

        <p class="ab-bus__text">{{ $service['text'] }}</p>

        <ul class="ab-bus__meta">
            @if (!empty($service['price']))
                <li><b>от {{ number_format($service['price'], 0, '', ' ') }} ₽</b></li>
            @endif
            @if (!empty($service['duration']))
                <li>{{ $service['duration'] }}</li>
            @endif
        </ul>

        <div class="ab-bus__actions">
            <a class="ab-btn ab-btn--primary ab-btn--sm" href="{{ $service['url'] }}">Подробнее</a>
            <button class="ab-bus__toggle" type="button" data-modal-path="consultation">Оставить заявку</button>
        </div>
    </div>
</article>
