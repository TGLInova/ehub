@props(['options' => '{}', 'navigation' => false, 'pagination' => false, 'swiperWrapperClass' => null, 'enableHelper' => false])
<x-bless-ui::wrapper x-data="swiper({{ $options }})" {{ $attributes->class('swiper-cloak group') }} tag="div" :tag-self-close="false" component="swiper">
    <div @class(['swiper-wrapper', $swiperWrapperClass])>
        {{ $slot }}
    </div>
    @if($navigation)
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    @endif

    @if($pagination)
        <div class="swiper-pagination"></div>
    @endif

    @if($enableHelper)
    <div class="absolute h-full left-0 top-0 flex items-center w-5 -z-10 group-hover:opacity-100 opacity-0 duration-200 pointer-events-none" title="Arraste o bloco para visualizar mais">
        <x-icon class="w-5 h-5 animate-fade-left animate-infinite" name="icon-touch" />
    </div>
    @endif
</x-bless-ui::wrapper>
