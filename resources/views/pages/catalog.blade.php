@extends('layouts.app')

@push('head')
    @vite(['resources/src/app/assets/styles/home-blocks.css', 'resources/src/app/assets/styles/course.css'])
@endpush

@section('content')
<div class="wrapper">
    @include('partials.site.header')

    <main class="ab-page ab-page--catalog">
        <section class="ab-cpage__hero">
            <div class="ab-container">
                <nav class="ab-crumbs" aria-label="Хлебные крошки">
                    <a href="/">Главная</a>
                    <span>/</span>
                    <b>{{ $catalog['h1'] }}</b>
                </nav>

                <h1 class="ab-cpage__title">{{ $catalog['h1'] }}</h1>
                <p class="ab-cpage__lead">{{ $catalog['lead'] }}</p>
            </div>
        </section>

        <section class="ab-programs">
            <div class="ab-container">
                <div data-island="CourseTabs"
                     data-props="{{ json_encode(['schools' => $catalog['schools']], JSON_UNESCAPED_UNICODE) }}"></div>
            </div>
        </section>

        @include('partials.blocks.constructor-cta')
        @include('partials.blocks.schedule')
        @include('partials.blocks.reviews')
        @include('partials.blocks.faq')
        @include('partials.blocks.lead')
    </main>

    @include('partials.site.footer')
</div>
@endsection
