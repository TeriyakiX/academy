@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/course.css'])
@endpush

@section('content')
{{--
    Служебная страница: варианты блока характеристик курса рядом,
    чтобы выбрать один. В карту сайта и меню не попадает.
--}}
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--course">
        @php
            $facts = $course['facts'];
            $doc = $facts['документ'] ?? null;
            $duration = $facts['длительность'] ?? $facts['продолжительность'] ?? null;
            $days = preg_match('/(\d+)\s*дн/ui', (string) $duration, $m) ? (int) $m[1] : 1;
            $hours = preg_match('/(\d+)\s*час/ui', (string) $duration, $m2) ? (int) $m2[1] : null;
            $total = $hours ? $hours * $days : null;
            $rest = collect($facts)->except(['стоимость', 'документ'])->filter(fn ($v) => !empty($v));
        @endphp

        <section class="ab-cpage__hero" style="padding: 40px 0">
            <div class="ab-container">
                <h1 class="ab-cpage__title" style="font-size: 34px">Варианты блока: {{ $course['title'] }}</h1>
                <p class="ab-cpage__lead">Выберите номер — поставлю его на все страницы курсов.</p>
            </div>
        </section>

        {{-- ---------- 1. Строка без карточки ---------- --}}
        <section class="ab-demo">
            <div class="ab-container">
                <span class="ab-demo__no">Вариант 1 — строка без карточки</span>

                <div class="ab-v1">
                    @foreach ($rest as $label => $value)
                        <div>
                            <dt>{{ $label }}</dt>
                            <dd>{{ is_array($value) ? implode(', ', $value) : $value }}</dd>
                        </div>
                    @endforeach
                </div>
                @if ($doc)
                    <p class="ab-v1__doc">{{ is_array($doc) ? implode(', ', $doc) : $doc }}</p>
                @endif
            </div>
        </section>

        {{-- ---------- 2. Чипы ---------- --}}
        <section class="ab-demo ab-demo--alt">
            <div class="ab-container">
                <span class="ab-demo__no">Вариант 2 — чипы</span>

                <div class="ab-v2">
                    @if ($total)<span class="ab-v2__chip ab-v2__chip--lead">{{ $total }} часов</span>@endif
                    @if ($duration)<span class="ab-v2__chip">{{ $duration }}</span>@endif
                    @foreach ($rest->except(['длительность', 'продолжительность']) as $label => $value)
                        <span class="ab-v2__chip"><i>{{ $label }}</i>{{ is_array($value) ? implode(', ', $value) : $value }}</span>
                    @endforeach
                    @if ($doc)<span class="ab-v2__chip ab-v2__chip--doc">{{ is_array($doc) ? implode(', ', $doc) : $doc }}</span>@endif
                </div>
            </div>
        </section>

        {{-- ---------- 3. Крупные цифры ---------- --}}
        <section class="ab-demo">
            <div class="ab-container">
                <span class="ab-demo__no">Вариант 3 — крупные цифры</span>

                <div class="ab-v3">
                    @if ($total)
                        <div class="ab-v3__num"><b>{{ $total }}</b><span>часов всего</span></div>
                    @endif
                    @if ($days > 1)
                        <div class="ab-v3__num"><b>{{ $days }}</b><span>занятия</span></div>
                    @endif
                    <div class="ab-v3__text">
                        @foreach ($rest->except(['длительность', 'продолжительность']) as $label => $value)
                            <p><i>{{ $label }}</i> {{ is_array($value) ? implode(', ', $value) : $value }}</p>
                        @endforeach
                        @if ($doc)<p><i>документ</i> {{ is_array($doc) ? implode(', ', $doc) : $doc }}</p>@endif
                    </div>
                </div>
            </div>
        </section>

        {{-- ---------- 4. Тёмная плашка ---------- --}}
        <section class="ab-demo ab-demo--alt">
            <div class="ab-container">
                <span class="ab-demo__no">Вариант 4 — тёмная плашка</span>

                <div class="ab-v4">
                    @if ($total)
                        <div class="ab-v4__big"><b>{{ $total }}</b><span>часов практики<br>и теории</span></div>
                    @endif
                    <dl class="ab-v4__list">
                        @foreach ($rest as $label => $value)
                            <div>
                                <dt>{{ $label }}</dt>
                                <dd>{{ is_array($value) ? implode(', ', $value) : $value }}</dd>
                            </div>
                        @endforeach
                        @if ($doc)
                            <div><dt>документ</dt><dd>{{ is_array($doc) ? implode(', ', $doc) : $doc }}</dd></div>
                        @endif
                    </dl>
                </div>
            </div>
        </section>

        {{-- ---------- 5. Карточка-билет ---------- --}}
        <section class="ab-demo">
            <div class="ab-container">
                <span class="ab-demo__no">Вариант 5 — билет</span>

                <div class="ab-v5">
                    <div class="ab-v5__stub">
                        @if ($total)<b>{{ $total }}</b><span>часов</span>@endif
                    </div>
                    <dl class="ab-v5__body">
                        @foreach ($rest as $label => $value)
                            <div>
                                <dt>{{ $label }}</dt>
                                <dd>{{ is_array($value) ? implode(', ', $value) : $value }}</dd>
                            </div>
                        @endforeach
                        @if ($doc)
                            <div><dt>документ</dt><dd>{{ is_array($doc) ? implode(', ', $doc) : $doc }}</dd></div>
                        @endif
                    </dl>
                </div>
            </div>
        </section>
    </main>

    @include('partials.site.footer')
</div>
@endsection
