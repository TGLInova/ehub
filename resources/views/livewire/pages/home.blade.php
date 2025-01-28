<div>
    <section class="bg-primary-300 text-white max-lg:pt-12">
        <x-ui::container class="grid lg:grid-cols-2 items-center gap-16">
            <header class="space-y-6">
                <x-ui::h2 class="font-semibold">
                    Ofereça benefícios e torne sua empresa mais atrativa!
                </x-ui::h2>
                <p class="lg:text-lg font-light">
                    Somos um portal que une os seus funcionários a
                    <span class="font-semibold">descontos, vantagens e benefícios de mais de 100 empresas
                        parceiras.</span>
                </p>
                <form class="flex gap-4">
                    <x-ui::input name="email" class="variant-inverse" placeholder="E-mail corporativo" />
                    <x-ui::button variant="primary" class="w-56 flex-none">
                        Experimentar o EHub
                    </x-ui::button>
                </form>
            </header>
            <img src="{{ asset('static/img/ilustracao.svg') }}" class="h-full">
        </x-ui::container>
    </section>

    <x-ui::section>
        <x-ui::container class='text-center space-y-8'>
            <x-ui::h2>
                <strong>A EHub</strong> é para empresas, sindicatos, entidades de classes e mais…
            </x-ui::h2>
            <div class="grid grid-cols-6 gap-8">
                @foreach (range(1, 6) as $x)
                    <img src="/storage/parceiros/porto.webp" />
                @endforeach
            </div>
            <x-ui::button variant="primary">
                Experimentar EHub
            </x-ui::button>
        </x-ui::container>
    </x-ui::section>

    <x-home.how-it-works />
    <x-ui::section>
        <x-ui::container>
            <div class="grid lg:grid-cols-3 grid-cols-1 gap-6 items-center">
                <div class="space-y-8">
                    <x-ui::h2>
                        Com a EHub,<br>
                        <strong>todo mundo sai ganhando!</strong>
                    </x-ui::h2>
                    <x-ui::button variant="primary">
                        Entrar em contato
                    </x-ui::button>
                </div>
                <div class="lg:col-span-2">
                    <div
                        class="bg-primary-100 pl-6 pr-0 py-6 rounded-2xl lg:rounded-tr-[10rem] rounded-tr-[6rem] relative lg:h-72 items-center flex">
                        <div class="grow mr-28">
                            <x-ui::h3 class="font-semibold mb-5">Para sua empresa:</x-ui::h3>
                            <ul class="[&>li]:flex [&>li]:gap-2 [&>li]:items-center space-y-5 lg:text-lg text-sm">
                                <li>
                                    <x-icon name="presente" class="h-6 w-6" />
                                    <span>Atração e retenção de talentos;</span>
                                </li>
                                <li>
                                    <x-icon name="rock-and-roll" class="h-6 w-6" />
                                    Aumento da satisfação da equipe;
                                </li>
                                <li>
                                    <x-icon name="trofeu" class="h-6 w-6" />
                                    Diferencial competitivo.
                                </li>
                            </ul>
                        </div>
                        <img src="{{ asset('static/img/empresario.png') }}"
                            class="lg:w-1/2 w-40 absolute lg:flex-none right-0 h-full top-0 object-contain object-bottom">
                    </div>
                </div>
            </div>
        </x-ui::container>
    </x-ui::section>

    <x-ui::section variant="primary-300">
        <x-ui::container class="grid lg:grid-cols-2 gap-4">
            <div class="space-y-5">
                <x-ui::h2 class="font-bold">Vamos nessa juntos?</x-ui::h2>
                <div>
                    <span>Preencha o formulário e comece a contratação do seu mais novo portal de benefícios.</span>
                </div>
            </div>
            <div>
                @livewire('components.formulario-contato')
            </div>
        </x-ui::container>
    </x-ui::section>
</div>
