@props([])
<x-bless-ui::wrapper {{ $attributes }} tag="header" :tag-self-close="false" component="navbar">
    <x-ui::container class="flex">
        <a href="{{ route('home') }}">
            <x-icon name="logo" />
        </a>
        <nav class="flex items-center justify-end grow gap-12 max-lg:hidden">
            <a>Página Inicial</a>
            <a>Sobre Nós</a>
            <x-ui::button href="" variant="primary-300">
                Quero contratar
            </x-ui::button>
        </nav>
    </x-ui::container>
</x-bless-ui::wrapper>
