@extends('layouts.app')

@push('head')
    @vite([
        'resources/src/app/assets/styles/home-blocks.css',
        'resources/src/app/assets/styles/reviews.css',
    ])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    {{--
        Страница «О нас».

        Сюда перенесены блоки, из-за которых главная растянулась: рассказ
        о школе, причины выбора и преподаватели. Тем, кто пришёл выбирать
        курс, они не нужны в первую минуту; тем, кто сомневается, —
        нужны целиком и в одном месте.
    --}}
    <main class="ab-page">
        @include('partials.blocks.about')
        @include('partials.blocks.reasons')
        @include('partials.blocks.teachers')
        @include('partials.blocks.partners')

        @include('partials.blocks.lead', [
            'title' => 'Остались вопросы о школе?',
            'note'  => 'Расскажем про обучение, преподавателей и документы, поможем выбрать программу.',
        ])
    </main>

    @include('partials.site.footer')
</div>
@endsection
