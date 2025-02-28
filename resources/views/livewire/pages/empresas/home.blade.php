<div>
    <x-ui.empresa-hero :$empresa />

    <x-produtos :$produtos :$empresa title="Produtos e Serviços com descontos exclusivos!">
        <x-slot name="subtitle">
            Reunimos empresas sólidas, com representatividade nacional e internacional, para criar
            <strong>algo que realmente faça sentido em sua vida</strong>.
        </x-slot>
    </x-produtos>

    <x-produtos.destaque :image="$produtos[0]?->imagem?->url" :title="$produtos[0]->nome" :text="$produtos[0]->descricao" :$empresa />

    <x-parceiros title="Benefícios que você encontra por aqui:" :$empresa />
</div>
