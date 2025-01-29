<div>
    <x-ui::section
        style="--bg-cover: url({{ asset('static/img/home/banner.webp') }})"
        class="bg-[image:--bg-cover] bg-cover bg-primary/60 bg-blend-multiply">
        <x-ui::container class="grid lg:grid-cols-2">
            <x-ui::card variant="rounded-r" class="bg-primary text-white space-y-5">
                <x-ui::h2>
                    Clube de Benefícios com descontos de verdade!
                </x-ui::h2>
                <p>Aqui você encontra Produtos e Serviços para a sua segurança e tranquilidade.</p>
                <x-ui::button class="bg-black/30">
                    Conhecer os benefícios
                </x-ui::button>
            </x-ui::card>
        </x-ui::container>
    </x-ui::section>

    <x-ui::section>
        <x-ui::container class="space-y-12">
            <x-ui::h2 class='text-center font-bold'>Produtos e Serviços com descontos exclusivos!</x-ui::h2>
            <p class='text-center'>Reunimos empresas sólidas, com representatividade nacional e internacional, para criar
                algo que<br> realmente faça sentido em sua vida.</p>

            <div class="grid lg:grid-cols-4 gap-8">
                @foreach ($produtos as $produto)
                    <x-produtos.card :$produto />
                @endforeach
            </div>

            <div class="text-center">
                <x-ui::button variant="outlined">
                    Clique e veja todos os benefícios
                </x-ui::button>
            </div>
        </x-ui::container>
    </x-ui::section>

    <section style="--bg-cover: url({{ asset('static/img/home/banner.webp') }})"
    class="bg-[image:--bg-cover] bg-cover bg-primary/60 bg-blend-multiply h-96 relative">
        <x-ui::card variant="rounded-r" class="max-lg:hidden bg-primary w-1/2 h-full absolute"></x-ui::card>
        <x-ui::container class='relative flex h-full items-center'>
            <div class="lg:w-1/3 space-y-5 text-white">
                <x-ui::h2 class="font-bold">Proteção financeira para você e sua família!</x-ui::h2>
                <p>A TGL Consultoria Financeira conta com uma equipe especializada em levar a você, por meio do Seguro de Vida, tranquilidade e bem-estar!</p>
                <x-ui::button class="bg-black/30">
                Conhecer os benefícios
            </x-ui::button>
            </div>
        </x-ui::container>
    </section>

    <x-parceiros />
</div>
