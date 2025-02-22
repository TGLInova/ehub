<form class="relative" x-data="{isFocused: false}" x-cloak>
    <x-ui.search-input placeholder="Buscar" wire:model.live="busca" x-on:blur="isFocused = false" x-on:focus="isFocused = true" />
    <ul class="absolute bg-white w-full divide-y z-10" x-bind:class="isFocused ? 'animate-fade-in': 'hidden'">
        @foreach ($this->produtos as $produto)
            <a wire:navigate href="{{ $produto->url }}" class="cursor-pointer duration-500 hover:bg-neutral-200 py-2.5 px-4 flex gap-3 items-center animate-fade" wire:key="{{ $produto->id }}">
                <img class="h-14 w-14 object-cover rounded-lg" src="{{ $produto->imagem?->url }}">
                <span>{{ $produto->nome }}</span>
            </a>
        @endforeach
    </ul>
</form>
