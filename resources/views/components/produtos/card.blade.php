<div class="space-y-5 bg-neutral-200 p-5 rounded-xl duration-200 hover:scale-[1.03] hover:shadow-[0_15px_15px] hover:shadow-neutral-400">
    <img src="{{ $produto->imagem->url }}">
    <x-ui::h3 class="font-bold">{{ $produto->nome }}</x-ui::h3>
    <p class="text-sm">{{ $produto->descricao }}</p>
    <x-ui::button :variant="['primary', 'rounded']" class="w-full">Quero saber mais</x-ui::button>
</div>
