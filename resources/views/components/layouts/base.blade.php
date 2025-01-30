@props([
    'bodyClass'   => null,
    'htmlClass'   => null,
    'head'        => null,
    'title'       => null,
    'company'     => config('app.name'),
    'canonical'   => url()->current(),
    'description' => null,
    'image'       => null,
])
<!DOCTYPE html>
<html {{ $attributes }} lang="pt-br" @class(['2xl:text-base lg:text-sm text-sm leading-normal h-full scroll-smooth', $htmlClass])>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ? sprintf('%s | %s', $title, $company) : $company }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('static/img/favicon.png') }}">

    <!-- SEO -->
    <link rel="canonical" href="{{ $canonical }}">
    <meta property="og:title" content="{{ $title ?? $company }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:type" content="website">
    <meta property="og:description" content="{{ $description }}">
    @if($image)
    <meta property="og:image" content="{{ $image }}">
    @endif
    <meta name="description" content="{{ str($description)->limit(170) }}">

    <meta name="theme-color" content="#11234E" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{ $head ?? '' }}

    @livewireStyles
</head>
<body @class(['antialiased min-h-full flex flex-col w-full bg-neutral-100 text-neutral-800', $bodyClass])>
    {{ $slot }}
    @livewireScriptConfig
</body>
</html>
