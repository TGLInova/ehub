<x-ui::section variant="primary-300">
    <x-ui::container>
        <x-ui::h2 class="font-bold text-center mb-12">Como funciona a nossa plataforma?</x-ui::h2>
        <div class="grid gap-16">
            <x-home.how-it-works.item number="01" :icon="asset('static/img/mao-no-dinheiro.svg')">

                Após a contratação, <strong>você recebe o sistema totalmente personalizado com a cara da sua
                    empresa</strong> e
                com todos os benefícios cadastrados.

            </x-home.how-it-works.item>
            <x-home.how-it-works.item number="02" reverse :icon="asset('static/img/arvore-dinheiro.svg')">
                <strong>Mensalmente, você receberá gratuitamente materiais de divulgação</strong> para serem veiculados
                nas suas redes e divulgados para sua base.
            </x-home.how-it-works.item>
            <x-home.how-it-works.item number="03" :icon="asset('static/img/correndo-pote-dinheiro.svg')">
                <strong>Novos parceiros e benefícios serão adicionados frequentemente</strong>, aumentando o leque de
                opções e vantagens aos seus colaboradores.
            </x-home.how-it-works.item>
            <x-home.how-it-works.item number="04" reverse :icon="asset('static/img/agaichamento.svg')">
                Pronto! <strong>Agora a sua empresa terá um portal personalizado</strong>, peças de marketing e um hub
                de soluções para você e seus funcionários.
            </x-home.how-it-works.item>
        </div>
    </x-ui::container>
</x-ui::section>
