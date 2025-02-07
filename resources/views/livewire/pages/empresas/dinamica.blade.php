<main>
    @foreach ($empresaPagina->componentes as $item)
        @include('components.' . $item->componente, [...$item->dados, 'empresa' => $empresa, 'produtos' => $this->produtos])
    @endforeach
</main>
