<x-ui::section @class($dark ? ['bg-primary/15 text-neutral-700'] : [])>
    <x-ui::container class="space-y-12">
        <div class="flex max-lg:flex-col lg:gap-12 lg:items-center">
            <figure>
                @if($logo)
                    <img width="150" height="50" src="{{ $logo }}" class="object-contain object-center h-full" />
                @else
                    <x-icon name="icon-logo" @class([$dark ? 'text-white' : 'text-primary-300']) />
                @endif
            </figure>
            <div class="grow">
                <div class="font-bold mb-4">Entre em contato com a gente!</div>
                <div class="grid lg:grid-cols-4 gap-12">
                    <div class="flex flex-col space-y-2">
                        @foreach($telefones as $telefone)
                        <a href="{{ $telefone->url }}" title="{{ $telefone->nome }}">
                            {{ $telefone->numero }}
                        </a>
                        @endforeach
                    </div>
                    <div>{{ $empresa?->email ?? 'contato@ehub.com.br' }}</div>
                    <div class="lg:col-span-2">{{ $endereco?->endereco_completo }}</div>
                </div>
            </div>
        </div>

        <div @class(['h-px w-full',  $dark ? 'bg-white' : 'bg-primary-300'])></div>

        <div class="grid lg:grid-cols-4 gap-8 [&>section]:flex lg:[&>section]:flex-col max-lg:[&>section]:grow-0 max-lg:[&>section]:gap-8 [&>section>nav>a]:underline [&>section>nav]:space-y-5 [&>section>h4]:font-bold [&>section>h4]:mb-8">
            <section>
                <h4>Redes Sociais</h4>
                <nav class="flex flex-col">
                    @foreach($links as $link)
                        <a href="{{ $link->url }}">{{ $link->nome }}</a>
                    @endforeach
                </nav>
            </section>
            <section>
                <h4>Mapa do Site</h4>
                <nav class="flex flex-col">
                    @foreach($siteLinks as $link)
                        <a href="{{ $link['url'] }}">{{ $link['nome'] }}</a>
                    @endforeach
                </nav>
            </section>
            <section>
                <h4>Outras Informações</h4>
                <nav class="flex flex-col">
                    <a>Política de Privacidade</a>
                    <a>Aviso sobre Cookies</a>
                    <a>Dados da EHub</a>
                </nav>
            </section>
        </div>
    </x-ui::container>
</x-ui::section>
