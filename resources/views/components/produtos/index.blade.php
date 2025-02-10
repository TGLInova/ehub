@props([
    'produtos',
    'empresa'  => null,
    'grid'     => 4,
    'title'    => null,
    'subtitle' => null,
])
<x-ui::section>
    <x-ui::container class="space-y-16">
        @if ($title)
            <header class="text-center max-w-4xl mx-auto">
                <x-ui::h2 class="font-semibold ">
                    {{ $title }}
                </x-ui::h2>
                @if ($subtitle)
                    <p class="text-lg">
                        {{ $subtitle }}
                    </p>
                @endif
            </header>
        @endif

        <div @class([
            'grid gap-8',
            'lg:grid-cols-4' => $grid === 4,
            'lg:grid-cols-3' => $grid === 3,
        ])>
            @foreach ($produtos as $produto)
                <x-produtos.card :$produto :$empresa />
            @endforeach
        </div>
        <div class="text-center">
            <x-ui::button variant="outlined" :href="$empresa ? route('empresa.categorias', ['empresa' => $empresa]) : '#'">
                Clique e veja todos os benefícios
            </x-ui::button>
        </div>
    </x-ui::container>
</x-ui::section>
