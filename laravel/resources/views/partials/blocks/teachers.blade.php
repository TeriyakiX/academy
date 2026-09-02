@php $t = config('home.teachers'); @endphp

<section class="ab-teachers-section ab-reveal">
    <div class="ab-container">
        <h2 class="ab-h2">{{ $t['title'] }}</h2>
        <p class="ab-lead">{{ $t['lead'] }}</p>

        <div data-island="TeacherSlider"
             data-props="{{ json_encode(['teachers' => $t['items']], JSON_UNESCAPED_UNICODE) }}"></div>
    </div>
</section>
