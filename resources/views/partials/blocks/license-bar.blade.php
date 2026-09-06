@php $lic = config('documents.items.0'); @endphp

@if (!empty($lic['meta']))
    {{-- Узкая полоса вместо большого блока документов: лицензия видна сразу
         после первого экрана, а до остального контента идти не приходится. --}}
    <section class="ab-licbar">
        <div class="ab-container ab-licbar__inner">
            <span class="ab-licbar__icon" aria-hidden="true">{!! $lic['icon'] ?? '' !!}</span>

            <p class="ab-licbar__text">
                <b>Лицензия {{ $lic['meta']['Номер лицензии'] }}</b>
                <span class="ab-licbar__sep" aria-hidden="true">·</span>
                <span>{{ $lic['meta']['Кем выдана'] }}</span>
            </p>

            @if (!empty($lic['file']))
                <a class="ab-licbar__link" href="{{ $lic['file'] }}" target="_blank" rel="noopener">
                    Выписка из реестра
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7"/><path d="M8 7h9v9"/></svg>
                </a>
            @endif
        </div>
    </section>
@endif
