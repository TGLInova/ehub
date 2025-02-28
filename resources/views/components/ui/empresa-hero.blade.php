@props([
    'empresa' => null,
    'url' => null,
    'title' => null,
    'description' => null,
    'buttonText' => null,
    'buttonUrl' => null,
    'image' => null,
])
<x-ui::section style="--bg-cover: url({{ asset('static/img/home/banner.webp') }})"
    class="bg-(image:--bg-cover) bg-cover bg-center bg-primary/60 bg-blend-multiply ">
    <x-ui::container class="grid lg:grid-cols-2">
        <x-ui::card variant="rounded-r" class="bg-primary text-white space-y-5 animate-fade-left">
            <x-ui::h2>
                {{ $title ?? 'Clube de Benefícios com descontos de verdade!' }}
            </x-ui::h2>
            <p>{{ $description ?? 'Aqui você encontra Produtos e Serviços para a sua segurança e tranquilidade.' }}</p>
            <x-ui::button class="bg-black/30" :href="$buttonUrl">
                {{ $buttonText ?? 'Conhecer os benefícios' }}
            </x-ui::button>
        </x-ui::card>
    </x-ui::container>
</x-ui::section>
