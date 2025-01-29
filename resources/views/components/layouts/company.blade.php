<x-layouts.base :title="$title ?? null">
    <x-ui::navbar :$links :$dark />
    {{ $slot }}
    <x-ui.footer :dark="!$dark" />
</x-layouts.base>
