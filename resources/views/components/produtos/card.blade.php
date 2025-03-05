<div {{ $attributes->class('flex flex-col space-y-5 bg-neutral-200 p-5 rounded-xl duration-200 hover:scale-[1.03] hover:shadow-[0_15px_15px] hover:shadow-neutral-400')}}>
    <figure class="h-48 relative">
        <img src="{{ $produto->imagem?->url }}" class="h-full w-full object-cover object-center">
        <img  alt="{{ $produto->parceiro->nome }}" class="absolute bottom-4 right-4 h-14 w-14 object-contain bg-white p-2  rounded-lg" src="{{ $produto->parceiro?->icone?->url ?? $produto->parceiro?->imagem->url }}">
    </figure>
    <x-ui::h3 class="font-bold">{{ $produto->nome }}</x-ui::h3>
    <p class="text-sm grow">{{ $produto->descricao }}</p>
    <x-ui::button :href="$empresa ? $produto->getUrl($empresa) : '#contratar'" :variant="['primary', 'rounded']" class="w-full">Quero saber mais</x-ui::button>
</div>
