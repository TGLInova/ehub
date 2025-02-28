@props([
    'produtos',
    'empresa'  => null,
    'grid'     => 4,
    'title'    => null,
    'subtitle' => null,
])
<x-ui::section x-data="{active: false}" x-intersect:enter="active = true" x-intersect:leave="active = false">
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
            @foreach ($produtos as $key => $produto)
                <x-produtos.card :$produto :$empresa x-bind:class="{'[&_img]:animate-fade [&_img]:animate-delay-(--delay)': active}" style="--delay: {{ $key*200 }}ms" />
            @endforeach
        </div>
        <div class="text-center">
            <x-ui::button variant="outlined" :href="$empresa ? route('empresa.categorias', ['empresa' => $empresa]) : '#contratar'">
                Clique e veja todos os benefícios
            </x-ui::button>
        </div>
    </x-ui::container>
</x-ui::section>
