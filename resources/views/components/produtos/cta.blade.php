@props(['title', 'text'])
<x-ui::section style="--bg-cover: url({{ asset('static/img/beneficios_cta.webp')}})"
    class="lg:bg-(image:--bg-cover) bg-[length:57%_auto] bg-[right_center] bg-no-repeat lg:bg-primary/60 bg-primary bg-blend-multiply relative">
    <x-ui::card variant="rounded-r" class="max-lg:hidden bg-primary w-1/2 h-full absolute top-0"></x-ui::card>
    <x-ui::container class='relative flex h-full items-center'>
        <div class="lg:w-1/3 space-y-8 text-white max-lg:text-center">
            <x-ui::h2 class="font-bold">{{ $title ?? 'Vantagens e Descontos' }}</x-ui::h2>
            <p>{{ $text ?? 'Beleza, saúde, consultoria, finanças e muitos outros benefícios para facilitar a sua vida!' }}</p>
            <x-ui::button href="/produtos" class="bg-black/30">
                Ver todos os benefícios
            </x-ui::button>
            <x-ui::card variant="rounded-r" class="lg:hidden h-56 bg-(image:--bg-cover) bg-cover bg-center"></x-ui::card>
        </div>
    </x-ui::container>

</x-ui::section>
