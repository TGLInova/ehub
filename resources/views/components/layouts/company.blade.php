<x-layouts.base :title="$title ?? null" style="--color-primary: {{ $color }}">
    <x-ui::navbar :$links :$dark />
    {{ $slot }}
    <x-ui.footer :dark="!$dark" />
</x-layouts.base>
