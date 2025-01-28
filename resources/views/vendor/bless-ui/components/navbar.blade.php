@props(['links' => []])
<x-bless-ui::wrapper {{ $attributes }} tag="header" :tag-self-close="false" component="navbar">
    <x-ui::container class="flex items-center justify-between gap-4"  x-data="{mobileOpen: false}">
        <a href="{{ route('home') }}" wire:navigate>
            <x-icon name="logo" />
        </a>
        <nav @class([
            'flex lg:items-center lg:justify-end justify-center grow gap-12',
            'max-lg:fixed max-lg:flex-col max-lg:w-full max-lg:h-full max-lg:top-0 max-lg:left-0 max-lg:bg-primary-500/90 max-lg:z-10',
            'max-lg:p-6'
        ]) x-bind:class="{'max-lg:hidden' : !mobileOpen}">
            @foreach($links as $url => $text)
                <a href="{{ $url }}" wire:navigate>{{ $text }}</a>
            @endforeach
            <x-ui::button href="" variant="primary-300">
                Quero contratar
            </x-ui::button>
        </nav>
        <a class="w-12 h-12 lg:hidden" x-on:click="mobileOpen = true">
            <x-icon name="heroicon-o-bars-3" />
        </a>
    </x-ui::container>
</x-bless-ui::wrapper>
