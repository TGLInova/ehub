@props(['empresa' => null, 'title', 'text', 'image'])
@php

$fixedImage = Arr::first((array) $image);
$imageUrl   = Str::startsWith($fixedImage, ['http://', 'https://']) ? $fixedImage : Storage::disk('public')->url($fixedImage);

@endphp
<x-ui::section style="--bg-cover: url({{ $imageUrl }})"
    class="lg:bg-(image:--bg-cover) bg-[length:65%_auto] bg-right-top bg-no-repeat lg:bg-primary/60 bg-primary bg-blend-multiply relative">
    <x-ui::card variant="rounded-r" class="max-lg:hidden bg-primary w-1/2 h-full absolute top-0"></x-ui::card>
    <x-ui::container class='relative flex h-full items-center'>
        <div class="lg:w-1/3 space-y-8 text-white max-lg:text-center">
            <x-ui::h2 class="font-bold">{{ $title ?? null }}</x-ui::h2>
            <p>{{ $text ?? null }}</p>
            <x-ui::button :href="$url ?? null" class="bg-black/30">
                Quero Saber Mais
            </x-ui::button>
            <x-ui::card variant="rounded-r" class="lg:hidden h-56 bg-(image:--bg-cover) bg-cover bg-center"></x-ui::card>
        </div>
    </x-ui::container>

</x-ui::section>
