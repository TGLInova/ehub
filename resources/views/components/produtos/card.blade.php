<div class="flex flex-col space-y-5 bg-neutral-200 p-5 rounded-xl duration-200 hover:scale-[1.03] hover:shadow-[0_15px_15px] hover:shadow-neutral-400">
    <img src="{{ $produto->imagem->url }}" class="h-32 w-full object-cover object-center">
    <x-ui::h3 class="font-bold">{{ $produto->nome }}</x-ui::h3>
    <p class="text-sm grow">{{ $produto->descricao }}</p>
    <x-ui::button :href="$empresa ? route('empresa.produto.show', ['empresa' => $empresa, 'produto' => $produto->id]) : '#'" :variant="['primary', 'rounded']" class="w-full">Quero saber mais</x-ui::button>
</div>
