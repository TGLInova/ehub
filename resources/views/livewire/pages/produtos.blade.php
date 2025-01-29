<div>
    <x-ui::section>
        <x-ui::container variant="compact" class="space-y-4">
            <x-ui::h1 class="font-bold text-center">O que você procura?</x-ui::h1>
            <p class="text-center text-lg">Encontre aqui as melhores ofertas e serviços do mercado!</p>
            <form class="flex gap-4" wire:submit="$refresh">
                <x-ui.search-input placeholder="Pesquisa Serviço" wire:model="busca" name="pesquisa" type="search" />
                <x-ui::button variant="primary">Buscar</x-ui::button>
            </form>
        </x-ui::container>
    </x-ui::section>
    <x-ui::section>
        <x-ui::container>
            <div class="grid lg:grid-cols-4 gap-8">
                @foreach($this->produtos as $produto)
                    <x-produtos.card :$produto />
                @endforeach
            </div>
        </x-ui::container>
    </x-ui::section>
</div>
