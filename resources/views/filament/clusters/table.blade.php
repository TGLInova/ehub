<x-filament-panels::page>
    @foreach($this->getActions() as $action)
        {{ $action }}
    @endforeach
    <div>
    {{ $this->table }}
    </div>
</x-filament-panels::page>
