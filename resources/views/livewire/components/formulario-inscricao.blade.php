<div>
    @if($sucesso)
        <div class="bg-teal-600 text-white px-4 py-2 rounded-lg shadow-lg">
            Enviado com sucesso!
        </div>
    @else
        @if($msg = $errors->first())
            <div class="text-white mb-3">{{ $msg }}</div>
        @endif
        <form class="grid lg:grid-cols-2 gap-4" wire:submit.prevent="submit">
            <x-ui::input variant="outlined" placeholder="Nome completo" wire:model="form.nome" />
            <x-ui::input variant="outlined" placeholder="E-mail cooporativo" wire:model="form.email" type="email" />
            <x-ui::input variant="outlined" placeholder="Telefone (com DDD)" wire:model="form.telefone" type="tel" x-mask="(99) 99999-9999" />
            <x-ui::input variant="outlined" placeholder="Área de Atuação" wire:model="form.area_atuacao" />
            <x-ui::input variant="outlined" placeholder="Cargo" wire:model="form.cargo" />
            <x-ui::button variant="primary">Enviar</x-ui::button>
        </form>
    @endif
</div>
