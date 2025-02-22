<main>

    <x-ui::section style="--bg-cover: url({{ $produto->imagemCapa?->url ?? $produto->imagem?->url }})"
        class="flex items-center bg-(image:--bg-cover) bg-cover bg-center bg-primary/60 text-white bg-blend-multiply lg:h-80">
        <x-ui::container class="grid lg:grid-cols-2">
            <div>
                <x-ui::h2 class="font-bold">
                    {{ $produto->nome }}
                </x-ui::h2>
                <p>{{ $produto->descricao }}</p>
            </div>

        </x-ui::container>
    </x-ui::section>
    <x-ui::section>
        <x-ui::container>
            <div class="grid lg:grid-cols-3 gap-16">
                <div class="lg:col-span-2 grid gap-8">
                    <div class="flex flex-wrap items-center gap-8">
                        <div class="text-xl">Parceiro:</div>
                        <div>
                            <img height="60" width="130" class="w-52 object-contain" src="{{ $produto->parceiro?->imagem?->url }}">
                        </div>
                        <div class="w-full flex-none text-sm">
                            {{ $produto->parceiro?->descricao }}
                        </div>
                    </div>
                    <hr>
                    <div class="prose [&_img]:rounded-tr-[8rem] [&_img]:rounded-lg">
                        {!! $produto->texto !!}
                    </div>
                </div>
                <div class="relative lg:-mt-64">
                    <x-ui::card :variant="['rounded']" class="bg-neutral-300 p-6 space-y-3 flex flex-col  gap-4 justify-center sticky top-4">
                        <header class="text-center">
                            <x-ui::h3 class="font-bold">
                                Orçamento Online
                            </x-ui::h3>
                            <p>É rápido e sem compromisso</p>
                        </header>
                        <x-ui::input placeholder="Nome"/>
                        <x-ui::input placeholder="E-mail" />
                        <x-ui::input placeholder="Telefone"/>
                        <x-ui::button variant="primary">Enviar</x-ui::button>
                    </x-ui::card>
                </div>
            </div>
        </x-ui::container>
    </x-ui::section>

</main>
