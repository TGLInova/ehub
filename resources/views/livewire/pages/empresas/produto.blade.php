<div>
    <x-ui::section style="--bg-cover: url({{ $produto->imagemCapa?->url ?? $produto->imagem?->url }})"
        class="flex items-center bg-(image:--bg-cover) bg-cover bg-[center_20%] bg-primary/60 text-white bg-blend-multiply lg:h-96 ">
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
                    @livewire('components.form-produto-orcamento', ['produto' => $produto])
                </div>
            </div>
        </x-ui::container>
    </x-ui::section>

</div>
