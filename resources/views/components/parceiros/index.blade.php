@props(['empresa' => null, 'href' => '/produtos'])
<x-ui::section>
    <x-ui::container class='text-center'>
        <x-ui::h2 class="mb-12">
            @isset($title)
            {{ $title }}
            @else
            <strong>A EHub</strong> é para empresas, sindicatos, entidades de classes e mais…
            @endisset
        </x-ui::h2>
        <x-ui::swiper options="{ slidesPerView: 2, breakpoints: { 800: { slidesPerView: 5 } } }">
            @foreach ($parceiros as $parceiro)
                <x-ui::swiper.item>
                    <img width="150" height="65" class="h-12 w-full object-center  object-contain duration-200 grayscale-100 hover:grayscale-0" alt="{{ $parceiro->nome }}" src="{{ $parceiro->imagem?->url }}" />
                </x-ui::swiper.item>
            @endforeach
        </x-ui::swiper>
        <div class="mt-14">
            <x-ui::button variant="primary" :href="$href">
                @if($title)
                Clique e veja todos os benefícios
                @else
                    Experimentar EHub
                @endif
            </x-ui::button>
        </div>
    </x-ui::container>
</x-ui::section>
