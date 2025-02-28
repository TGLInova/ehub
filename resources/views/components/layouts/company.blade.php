<x-layouts.base
    :title="$title ?? null"
    :description="$description ?? null"
    :company="$empresa->nome"
    :image="$image ?? null"
    style="--color-primary: {{ $empresa->cor }}">

    <x-ui::navbar :has-searchbar="true" home="/" :$links :$dark :logo="$empresa?->imagem?->url" />

    <main class="grow">
        <!-- MAIN -->
        {{ $slot }}
        <!-- /MAIN -->
    </main>
    <x-ui.footer :dark="!$dark" :empresa="$empresa" />
</x-layouts.base>
