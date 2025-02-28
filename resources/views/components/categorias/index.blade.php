@props(['empresa', 'categorias'])
<div class="h-20 bg-primary/30 flex items-center" x-cloak>
    <x-ui::container>
        <x-ui::swiper options="{slidesPerView: 5.3}">
            @foreach($categorias as $item)
                <x-ui::swiper.item>
                    <a class="bg-white px-2 py-1 flex gap-2 items-center" href="{{ route('empresa.categoria', ['empresa' => $empresa, 'categoria' => $item]) }}">
                        <x-icon class="h-6 w-6 flex-none text-primary" :name="$item->icone ?? 'heroicon-o-x-mark'" />
                        <span class="text-xs font-semibold">{{ $item->nome }}</span>
                    </a>
                </x-ui::swiper.item>
            @endforeach
        </x-ui::swiper>
    </x-ui::container>
</div>
