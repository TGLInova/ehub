<div>
    <x-ui::section>
        <x-ui::container variant="compact" class="space-y-4">
            <x-ui::h1 class="font-bold text-center">O que você procura?</x-ui::h1>
            <p class="text-center text-lg">Encontre aqui as melhores ofertas e serviços do mercado!</p>
            <form class="flex gap-4" wire:submit="$refresh">
                <x-ui.search-input placeholder="Pesquisa Serviço" wire:model="busca" name="pesquisa" type="search" />
                <x-ui::button variant="primary-300">Buscar</x-ui::button>
            </form>
        </x-ui::container>
    </x-ui::section>
    <x-ui::section>
        <x-ui::container>
            <div class="grid lg:grid-cols-4 gap-8">
                @foreach($this->produtos as $produto)
                    <div class="space-y-5 bg-neutral-200 p-5 rounded-xl duration-200 hover:scale-[1.03] hover:shadow-[0_15px_15px] hover:shadow-neutral-400">
                        <img src="{{ $produto->imagem->url }}">
                        <x-ui::h3 class="font-bold">{{ $produto->nome }}</x-ui::h3>
                        <p class="text-sm">{{ $produto->descricao }}</p>
                        <x-ui::button :variant="['primary-300', 'rounded']" class="w-full">Quero saber mais</x-ui::button>
                    </div>
                @endforeach
            </div>
        </x-ui::container>
    </x-ui::section>
</div>
