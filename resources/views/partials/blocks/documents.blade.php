@php $d = config('documents'); @endphp

<section class="ab-docs ab-reveal">
    <div class="ab-container">
        <div class="ab-docs__head">
            <div>
                <h2 class="ab-h2">{{ $d['title'] }}</h2>
                <p class="ab-lead">{{ $d['lead'] }}</p>
            </div>
            @if (!empty($d['badge']))
                <span class="ab-docs__badge">{{ $d['badge'] }}</span>
            @endif
        </div>

        {{-- Документы: слева сам документ, справа описание и реквизиты --}}
        <ul class="ab-docs__list">
            @foreach ($d['items'] as $item)
                <li class="ab-docs__item">
                    <div class="ab-docs__preview">
                        @if (!empty($item['image']))
                            <img src="{{ $item['image'] }}"
                                 alt="{{ $item['alt'] ?? $item['title'] }}"
                                 loading="lazy" width="300" height="420">
                        @elseif (!empty($item['file']))
                            {{-- документ в PDF: показываем обложку-ссылку --}}
                            <a class="ab-docs__file" href="{{ $item['file'] }}"
                               target="_blank" rel="noopener"
                               aria-label="{{ $item['file_label'] ?? $item['title'] }}">
                                <span class="ab-docs__file-icon">{!! $item['icon'] ?? '' !!}</span>
                                <span class="ab-docs__file-type">PDF</span>
                            </a>
                        @else
                            <span class="ab-docs__icon">{!! $item['icon'] ?? '' !!}</span>
                        @endif
                    </div>

                    <div class="ab-docs__body">
                        <h3 class="ab-docs__title">{{ $item['title'] }}</h3>
                        <p class="ab-docs__text">{{ $item['text'] }}</p>

                        @if (!empty($item['meta']))
                            <dl class="ab-docs__meta">
                                @foreach ($item['meta'] as $key => $value)
                                    <div>
                                        <dt>{{ $key }}</dt>
                                        <dd>{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        @endif

                        @if (!empty($item['file']))
                            <a class="ab-docs__link" href="{{ $item['file'] }}"
                               target="_blank" rel="noopener">
                                {{ $item['file_label'] ?? 'Открыть документ' }}
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                     aria-hidden="true"><path d="M7 17 17 7"/><path d="M8 7h9v9"/></svg>
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>

        {{-- Что написано в свидетельстве --}}
        <div class="ab-docs__details">
            <h3 class="ab-docs__sub">{{ $d['details']['title'] }}</h3>
            <ul class="ab-docs__facts">
                @foreach ($d['details']['items'] as $f)
                    <li>
                        <b>{{ $f['title'] }}</b>
                        <span>{{ $f['text'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Условия приёма --}}
        <div class="ab-docs__req">
            <h3 class="ab-docs__req-title">{{ $d['requirements']['title'] }}</h3>
            <ul class="ab-docs__req-list">
                @foreach ($d['requirements']['items'] as $r)
                    <li>
                        <b>{{ $r['title'] }}</b>
                        <span>{{ $r['text'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <p class="ab-docs__note">{{ $d['note'] }}</p>
    </div>
</section>
