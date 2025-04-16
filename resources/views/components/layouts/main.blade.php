<x-layouts.base :title="$title" :description="$description" :image="$image">
    <x-ui::navbar :$links :$dark >
        <x-slot name="extraActions">
            <x-ui::button href="#contratar" variant="primary-300">
                Quero contratar
            </x-ui::button>
        </x-slot>
    </x-ui::navbar>

    {{ $slot }}
    <x-ui.footer :dark="!$dark" />
</x-layouts.base>
