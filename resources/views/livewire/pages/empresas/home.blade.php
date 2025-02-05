<div>
    <x-ui::section style="--bg-cover: url({{ asset('static/img/home/banner.webp') }})"
        class="bg-(image:--bg-cover) bg-cover bg-primary/60 bg-blend-multiply">
        <x-ui::container class="grid lg:grid-cols-2">
            <x-ui::card variant="rounded-r" class="bg-primary text-white space-y-5">
                <x-ui::h2>
                    Clube de Benefícios com descontos de verdade!
                </x-ui::h2>
                <p>Aqui você encontra Produtos e Serviços para a sua segurança e tranquilidade.</p>
                <x-ui::button class="bg-black/30" wire:navigate :href="$categoria? route('empresa.categorias', ['empresa' => $empresa]) : '#'">
                    Conhecer os benefícios
                </x-ui::button>
            </x-ui::card>
        </x-ui::container>
    </x-ui::section>

    <x-produtos.list :$produtos :$empresa title="Produtos e Serviços com descontos exclusivos!">
        <x-slot name="subtitle">
            Reunimos empresas sólidas, com representatividade nacional e internacional, para criar
            <strong>algo que realmente faça sentido em sua vida</strong>.
        </x-slot>
    </x-produtos.list>

    <x-ui::swiper options="{slidesPerView: 1}">
        @foreach($produtos as $produto)
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
                        <x-ui::card variant="rounded-r" class="lg:hidden h-56 bg-(image:--bg-cover) bg-cover bg-center"></x-ui::card>
                    </div>
                </x-ui::container>

            </x-ui::section>
        </x-ui::swiper.item>
        @endforeach
    </x-ui::swiper>

    <x-parceiros title="Benefícios que você encontra por aqui:" :$empresa />
</div>
