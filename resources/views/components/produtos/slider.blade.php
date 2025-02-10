@props(['produtos', 'empresa' => null])

<x-ui::swiper options="{slidesPerView: 1}" class="w-full">
    @foreach ($produtos as $produto)
        <x-ui::swiper.item>
            <x-ui::section style="--bg-cover: url({{ $produto->imagem->url }})"
                class="lg:bg-(image:--bg-cover) bg-cover lg:bg-primary/60 bg-primary bg-blend-multiply relative">
                <x-ui::card variant="rounded-r" class="max-lg:hidden bg-primary w-1/2 h-full absolute top-0"></x-ui::card>
                <x-ui::container class='relative flex h-full items-center'>
                    <div class="lg:w-1/3 space-y-8 text-white max-lg:text-center">
                        <x-ui::h2 class="font-bold">{{ $produto->nome }}</x-ui::h2>
                        <p>{{ $produto->descricao }}</p>
                        <x-ui::button :href="route('empresa.produto.show', ['empresa' => $empresa, 'produto' => $produto])" class="bg-black/30">
                            Quero Saber Mais
                        </x-ui::button>
                        <x-ui::card variant="rounded-r"
                            class="lg:hidden h-56 bg-(image:--bg-cover) bg-cover bg-center"></x-ui::card>
                    </div>
                </x-ui::container>

            </x-ui::section>
        </x-ui::swiper.item>
    @endforeach
</x-ui::swiper>
