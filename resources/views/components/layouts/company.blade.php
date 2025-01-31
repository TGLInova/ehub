<x-layouts.base :title="$title ?? null" :$company style="--color-primary: {{ $empresa->cor }}">
    <x-ui::navbar :$links :$dark :logo="$empresa?->imagem?->url">
    </x-ui::navbar>

    {{ $slot }}
    <x-ui.footer :dark="!$dark" :logo="$empresa?->imagem?->url" :links="$empresa->links" />
</x-layouts.base>
