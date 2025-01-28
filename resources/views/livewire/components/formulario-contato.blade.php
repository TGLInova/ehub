<div class="grid lg:grid-cols-2 gap-4">
    <x-ui::input variant="outlined" placeholder="Nome completo" wire:model="form.nome" />
    <x-ui::input variant="outlined" placeholder="E-mail cooporativo" wire:model="form.nome" />
    <x-ui::input variant="outlined" placeholder="Telefone (com DDD)" wire:model="form.telefone" />
    <x-ui::input variant="outlined" placeholder="Área de Atuação" wire:model="form.area_atuacao" />
    <x-ui::input variant="outlined" placeholder="Cargo" wire:model="form.cargo" />
    <x-ui::button variant="primary">Continuar Cadastro</x-ui::button>
</div>
