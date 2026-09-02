@extends('layouts.app')

@push('head')
    @vite('resources/css/constructor.css')
@endpush
@section('content')
<div class="wrapper">
    @include('partials.header-2')

    <main class="constructor-page">
        <div class="container">
            <h1 class="constructor-page__title">Соберите свой курс</h1>
            <p class="constructor-page__lead">
                Не можете выбрать одну программу? Соберите собственный набор из курсов
                и мастер-классов Академии — чем больше направлений, тем выше скидка.
            </p>

            <div
                data-island="CourseConstructor"
                data-props="{{ json_encode(['schools' => config('courses.schools'), 'discounts' => config('courses.discounts')], JSON_UNESCAPED_UNICODE) }}"
            ></div>
        </div>
    </main>

    @include('partials.footer-2')
</div>
@endsection
