@props(['reverse' => false, 'icon' => 'mao-no-dinheiro'])
<div class="grid lg:grid-cols-2 gap-20 items-center" x-data="{active: false}" x-intersect.half:enter="active = true" x-intersect.half:leave="active = false">
    <div
        x-bind:class="{'animate-fade-up animate-duration-1000': active}"
    @class([
        'bg-primary-400 rounded-2xl rounded-tl-[6rem] relative lg:h-72 h-52 max-lg:px-16 items-center justify-center flex ',
        'lg:order-last' => $reverse
    ])>
        <img src="{{ asset($icon) }}" class="h-full lg:w-full object-center object-contain" x-bind:class="{'animate-fade animate-delay-500': active}" />
    </div>
    <div class="space-y-7 flex flex-col lg:items-start items-center" x-bind:class="{@js($reverse ? 'animate-fade-left' : 'animate-fade-right') : active}">
        <div class="text-xl">
        {{ $slot }}
        </div>
        <x-ui::button variant="primary" href="#contratar">
            Entrar em Contrato
        </x-ui::button>
    </div>

</div>
