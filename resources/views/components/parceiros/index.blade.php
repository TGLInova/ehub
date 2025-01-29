<x-ui::section>
    <x-ui::container class='text-center space-y-8'>
        <x-ui::h2>
            <strong>A EHub</strong> é para empresas, sindicatos, entidades de classes e mais…
        </x-ui::h2>
        <x-ui::swiper options="{ slidesPerView: 2, breakpoints: { 800: { slidesPerView: 5 } } }">
            @foreach ($parceiros as $parceiro)
                <x-ui::swiper.item>
                    <img width="150" height="65" class="h-12 w-full object-bottom object-contain" alt="{{ $parceiro->nome }}" src="{{ $parceiro->imagem->url }}" />
                </x-ui::swiper.item>
            @endforeach
        </x-ui::swiper>
        <x-ui::button variant="primary">
            Experimentar EHub
        </x-ui::button>
    </x-ui::container>
</x-ui::section>
