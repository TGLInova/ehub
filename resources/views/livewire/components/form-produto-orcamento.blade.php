<form wire:submit="submit">

    @if($msg = $errors->first())
    <div class="p-3">
        {{ $msg }}
    </div>
    @endif

    <x-ui::card :variant="['rounded']" class="bg-neutral-300 p-6 space-y-3 flex flex-col  gap-4 justify-center sticky top-4">
        <header class="text-center">
            <x-ui::h3 class="font-bold">
                Orçamento Online
            </x-ui::h3>
            <p>É rápido e sem compromisso</p>
        </header>
        <x-ui::input placeholder="Nome" wire:model="form.nome" />
        <x-ui::input placeholder="E-mail" wire:model="form.email" type="email" />
        <x-ui::input placeholder="Telefone" wire:model="form.telefone" x-mask="(99) 99999-9999" type="tel" />
        <x-ui::button variant="primary" type="submit" wire:loading.attr="disabled" >
            <span wire:loading.remove>Enviar</span>
            <span wire:loading>Enviando...</span>
        </x-ui::button>
    </x-ui::card>
</form>
