<x-layouts.base :title="$title ?? null">
    <x-ui::navbar :$links />
    {{ $slot }}
    <x-ui.footer />
</x-layouts.base>
