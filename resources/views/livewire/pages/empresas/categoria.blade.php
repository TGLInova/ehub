<div>
    <x-ui::section style="--bg-cover: url({{ $categoria?->imagem?->url ?? 'https://images.pexels.com/photos/518244/pexels-photo-518244.jpeg?auto=compress&cs=tinysrgb&w=1660&h=750&dpr=1' }})"
        class="flex items-center bg-(image:--bg-cover) bg-cover bg-tope bg-primary/60 text-white bg-blend-multiply lg:h-72">
        <x-ui::container class="text-center">
            <x-ui::h2 class="font-bold">
                {{ $categoria?->nome ?? 'Categorias' }}
            </x-ui::h2>
        </x-ui::container>
    </x-ui::section>
    <x-ui::section>
        <x-ui::container class="grid lg:grid-cols-4">
            <div>
                <x-ui::h4 variant="bold" class="mb-6">Categorias</x-ui::h4>
                <div class="space-y-4">
                    @foreach ($categorias as $item)
                        <a class="flex gap-4 items-center" wire:navigate
                            href="{{ route('empresa.categoria', ['empresa' => $empresa, 'categoria' => $item]) }}">
                            <span x-bind:class="{ active: @js($item->id === $categoria?->id) }"
                                class="h-5 w-5 flex-none border border-neutral-600 [&.active]:border-transparent [&.active]:bg-primary"></span>
                            <span>{{ $item->nome }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="lg:col-span-3" wire:loading.class="blur-[2px]" wire:key="categoria-{{ $categoria?->id }}">
                <div class="grid lg:grid-cols-3 gap-6">
                    @foreach ($this->produtos as $produto)
                        <x-produtos.card :$produto :$empresa />
                    @endforeach
                </div>
            </div>
        </x-ui::container>
    </x-ui::section>
</div>
