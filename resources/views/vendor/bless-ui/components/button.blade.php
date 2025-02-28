@props(['href' => null, 'animated' => true])
<x-bless-ui::wrapper
    {{ $attributes->merge(compact('href'))->class(['is-animated relative' => $animated]) }}
    :tag="$href === null ? 'button' : 'a'"
    component="button">

    @if($animated)
        <svg width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 180 60" class="svg-border">
            <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
            <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
        </svg>
    @endif

    {{ $slot }}
</x-bless-ui::wrapper>
