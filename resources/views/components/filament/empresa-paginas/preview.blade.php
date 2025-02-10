@props(['view', 'data' => []])
<html class="isolate">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite('resources/css/app.css')
    </head>
    <body class="flex flex-col w-full bg-neutral-100 text-neutral-800">
        @include('components.' . $view, $data)
    </body>
</html>
