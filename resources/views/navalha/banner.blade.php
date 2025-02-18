<x-ui::section style="--bg-cover: url({{ asset('static/img/home/banner.webp') }})"
    class="bg-(image:--bg-cover) bg-cover bg-center bg-primary/60 bg-blend-multiply">
    <x-ui::container class="grid lg:grid-cols-2">
        <x-ui::card variant="rounded-r" class="bg-primary text-white space-y-5">
            <x-ui::h2 x-text="title" />
            <p x-text="description" />
            <x-ui::button class="bg-black/30" wire:navigate ::href="buttonUrl" x-text="buttonText">
            </x-ui::button>
        </x-ui::card>
    </x-ui::container>
</x-ui::section>
