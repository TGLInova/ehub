<div>
    @foreach ($empresaPagina->dados as $item)
        @include('components.' . $item['type'], [
            ...$item['data'],
            'empresa'    => $empresa,
            'produtos'   => $this->produtos,
            'parceiros'  => $this->parceiros,
            'categorias' => $this->categorias,
        ])
    @endforeach
</div>
