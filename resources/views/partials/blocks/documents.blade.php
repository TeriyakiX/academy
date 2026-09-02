{{--
    Блок «Документы об обучении».
    Тексты и изображения — заглушки до получения материалов от заказчика.
    Реальные сканы класть в public/assets/docs/, подписи править в config/documents.php.
--}}
<section class="docs main-section">
    <div class="docs__container container">
        <h2 class="docs__title heading-title-section">Документы государственного образца</h2>
        <p class="docs__description text-18">
            Академия Бариста работает по образовательной лицензии. После обучения вы получаете
            документ, который подтверждает квалификацию при трудоустройстве.
        </p>

        <ul class="docs__list">
            @foreach (config('documents.items') as $doc)
                <li class="docs__item">
                    <div class="docs__item-preview">
                        @if (!empty($doc['image']))
                            <img class="docs__item-image" src="{{ $doc['image'] }}" alt="{{ $doc['title'] }}" loading="lazy" width="280" height="200">
                        @else
                            <div class="docs__item-placeholder">Образец документа</div>
                        @endif
                    </div>
                    <h3 class="docs__item-title text-20">{{ $doc['title'] }}</h3>
                    <p class="docs__item-text text-16">{{ $doc['text'] }}</p>
                </li>
            @endforeach
        </ul>

        <p class="docs__note text-16">{{ config('documents.note') }}</p>
    </div>
</section>
