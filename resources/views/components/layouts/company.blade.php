<x-layouts.base :title="$title ?? null" style="--color-primary: {{ $color }}">
    <x-ui::navbar :$links :$dark :logo="$empresa?->imagem?->url">
    </x-ui::navbar>

    {{ $slot }}
    <x-ui.footer :dark="!$dark" :logo="$empresa?->imagem?->url" />
</x-layouts.base>
