@props(['dark' => false, 'logo' => null])
<x-ui::section @class($dark ? ['bg-primary text-white'] : [])>
    <x-ui::container class="space-y-12">
        <div class="flex max-lg:flex-col lg:gap-12 lg:items-center">
            <figure>
                @if($logo)
                    <img width="150" height="50" src="{{ $logo }}" class="brightness-[100] object-contain object-center h-full" />
                @else
                    <x-icon name="icon-logo" @class([$dark ? 'text-white' : 'text-primary-300']) />
                @endif
            </figure>
            <div class="grow">
                <div class="font-bold">Entre em contato com a gente!</div>
                <div class="flex max-lg:flex-col gap-8">
                    <span>(99) 99999-99999</span>
                    <span>contato@teste.com</span>
                    <span>Av. Paraná, 821 - Sala 404 - Belo Horizonte, MG</span>
                </div>
            </div>
        </div>

        <div @class(['h-px w-full',  $dark ? 'bg-white' : 'bg-primary-300'])></div>

        <div class="grid lg:grid-cols-4 gap-8 [&>section]:flex lg:[&>section]:flex-col max-lg:[&>section]:grow-0 max-lg:[&>section]:gap-8 [&>section>nav>a]:underline [&>section>nav]:space-y-5 [&>section>h4]:font-bold [&>section>h4]:mb-8">
            <section>
                <h4>Redes Sociais</h4>
                <nav class="flex flex-col">
                    <a>Nosso Instragram</a>
                    <a>Nosso TikTok</a>
                    <a>Nosso LinkedIn</a>
                </nav>
            </section>
            <section>
                <h4>Mapa do Site</h4>
                <nav class="flex flex-col">
                    <a>Nosso Instragram</a>
                    <a>Nosso TikTok</a>
                    <a>Nosso LinkedIn</a>
                </nav>
            </section>
            <section>
                <h4>Redes Sociais</h4>
                <nav class="flex flex-col">
                    <a>Nosso Instragram</a>
                    <a>Nosso TikTok</a>
                    <a>Nosso LinkedIn</a>
                </nav>
            </section>
        </div>
    </x-ui::container>
</x-ui::section>
