@props(['links' => []])
<x-bless-ui::wrapper {{ $attributes }} tag="header" :tag-self-close="false" component="navbar">
    <x-ui::container class="flex">
        <a href="{{ route('home') }}" wire:navigate>
            <x-icon name="logo" />
        </a>
        <nav class="flex items-center justify-end grow gap-12 max-lg:hidden">
            @foreach($links as $url => $text)
                <a href="{{ $url }}" wire:navigate>{{ $text }}</a>
            @endforeach
            <x-ui::button href="" variant="primary-300">
                Quero contratar
            </x-ui::button>
        </nav>
    </x-ui::container>
</x-bless-ui::wrapper>
