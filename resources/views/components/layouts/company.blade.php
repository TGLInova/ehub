<x-layouts.base
    :title="$title ?? null"
    :description="$description ?? null"
    :company="$company"
    style="--color-primary: {{ $empresa->cor }}">

    <x-ui::navbar :$links :$dark :logo="$empresa?->imagem?->url">
    </x-ui::navbar>

    {{ $slot }}
    <x-ui.footer :dark="!$dark" :empresa="$empresa" />
</x-layouts.base>
