@props(['reverse' => false, 'icon' => 'mao-no-dinheiro'])
<div class="grid lg:grid-cols-2 gap-20 items-center">
    <div @class([
        'bg-primary-400 rounded-2xl rounded-tl-[6rem] relative lg:h-72 h-52 max-lg:px-16 items-center justify-center flex ',
        'lg:order-last' => $reverse
    ])>
        <img src="{{ asset($icon) }}" class="h-full lg:w-full object-center object-contain" />
    </div>
    <div class="space-y-7 flex flex-col lg:items-start items-center">
        <div class="text-xl">
        {{ $slot }}
        </div>
        <x-ui::button variant="primary">
            Entrar em Contrato
        </x-ui::button>
    </div>

</div>
