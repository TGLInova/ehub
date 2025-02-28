<div class="sticky top-4">
    @if ($msg = $errors->first())
        <div class="p-3 bg-neutral-300 rounded-lg text-red-400 mb-5">
            {{ $msg }}
        </div>
    @endif
    <x-ui::card :variant="['rounded']" class="bg-neutral-300 p-6  gap-4 justify-center">
        @if ($sucesso)
            <div wire:transition class="flex flex-col items-center gap-4">
                <x-icon name="heroicon-o-check-circle" class='text-primary block w-32' />
                <div class="text-sm text-center"><strong>Seus dados foram recebidos!</strong><br> Em breve, nossa equipe entrará em contato com você!</div>
            </div>
        @else
            <div>
                <form wire:submit="submit" class="space-y-4 flex flex-col">
                    <header class="text-center">
                        <x-ui::h3 class="font-bold">
                            Orçamento Online
                        </x-ui::h3>
                        <p>É rápido e sem compromisso</p>
                    </header>
                    <x-ui::input placeholder="Nome" wire:model="form.nome" />
                    <x-ui::input placeholder="E-mail" wire:model="form.email" type="email" />
                    <x-ui::input placeholder="Telefone" wire:model="form.telefone" x-mask="(99) 99999-9999"
                        type="tel" />
                    <x-ui::button variant="primary" type="submit" wire:loading.attr="disabled">
                        <span wire:loading.remove>Enviar</span>
                        <span wire:loading>Enviando...</span>
                    </x-ui::button>
                </form>
            </div>
        @endif
    </x-ui::card>
</div>
