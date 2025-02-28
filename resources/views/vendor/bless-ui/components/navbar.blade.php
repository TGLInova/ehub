@props(['links' => [], 'dark' => false, 'extraActions' => null, 'logo' => null, 'home' => route('home'), 'hasSearchbar' => false])
<x-bless-ui::wrapper {{ $attributes->class(['ui-navbar-dark' => $dark]) }} tag="header" :tag-self-close="false" component="navbar">
    <x-ui::container class="flex items-center justify-between gap-4"  x-data="{mobileOpen: false}">
        <a href="{{ $home }}" wire:navigate>
            @if($logo)
                <img width="150" height="50" src="{{ $logo }}" class="object-contain object-center h-10" />
            @else
            <x-icon name="icon-logo" @class($dark ? 'text-white' : 'text-primary') />
            @endif
        </a>
        <nav @class([
            'flex lg:items-center lg:justify-end justify-center grow gap-12',
            'max-lg:fixed max-lg:flex-col max-lg:w-full max-lg:h-full max-lg:top-0 max-lg:left-0 max-lg:bg-primary-500/90 max-lg:z-10',
            'max-lg:p-6'
        ]) x-bind:class="{'max-lg:hidden' : !mobileOpen}">
            @foreach($links as $url => $text)
                <a href="{{ $url }}" wire:navigate>{{ $text }}</a>
            @endforeach
            {{ $extraActions }}
        </nav>
        @if($hasSearchbar)
            @livewire('components.pesquisa')
        @endif
        <a class="w-12 h-12 lg:hidden" x-on:click="mobileOpen = true">
            <x-icon name="heroicon-o-bars-3" />
        </a>
    </x-ui::container>
</x-bless-ui::wrapper>
