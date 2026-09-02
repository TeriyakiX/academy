<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>{{ $seo['title'] }}</title>
    @isset($seo["description"])
        <meta name="description" content="{{ $seo["description"] }}">
    @endisset
    @isset($seo['keywords'])
        <meta name="keywords" content="{{ $seo['keywords'] }}">
    @endisset
    <meta name="robots" content="{{ $seo['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' }}">

    {{-- canonical всегда указывает на саму страницу --}}
    <link rel="canonical" href="{{ $seo['canonical'] }}">

    <meta property="og:title" content="{{ $seo['og_title'] ?? $seo['title'] }}">
    @isset($seo["description"])<meta property="og:description" content="{{ $seo["description"] }}">@endisset
    <meta property="og:image" content="{{ url($seo['og_image'] ?? '/assets/1.webp') }}">
    <meta property="og:url" content="{{ $seo['canonical'] }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Академия Бариста">

    <link rel="shortcut icon" href="/assets/icon.png">

    @foreach ($seo['css'] ?? [] as $href)
        <link rel="stylesheet" href="{{ $href }}">
    @endforeach

    @stack('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body @foreach ($seo['body_attrs'] ?? [] as $k => $v) {{ $k }}="{{ $v }}" @endforeach>

@yield('content')

@foreach ($seo['js'] ?? [] as $script)
    <script src="{{ $script['src'] }}"@if ($script['type']) type="{{ $script['type'] }}"@endif @if ($script['defer']) defer @endif @if ($script['async']) async @endif></script>
@endforeach
@stack('scripts')

</body>
</html>
