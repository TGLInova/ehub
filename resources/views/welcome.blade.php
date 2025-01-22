<x-layouts.base>
    <section class="bg-primary-300 text-white">
        <x-ui::container class="grid grid-cols-2 items-center gap-16">
            <header class="space-y-6">
                <x-ui::h2 class="font-semibold">
                    Ofereça benefícios e torne sua empresa mais atrativa!
                </x-ui::h2>
                <p class="text-lg font-light">
                    Somos um portal que une os seus funcionários a
                    <span class="font-semibold">descontos, vantagens e benefícios de mais de 100 empresas parceiras.</span>
                </p>
                <form class="flex gap-4">
                    <x-ui::input name="email" class="variant-inverse" placeholder="E-mail corporativo" />
                    <x-ui::button class="variant-primary w-56 flex-none">
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
            <x-ui::button class="variant-primary">
                Experimentar EHub
            </x-ui::button>
        </x-ui::container>
    </x-ui::section>
</x-layouts.base>
