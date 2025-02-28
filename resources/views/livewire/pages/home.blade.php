<div>
    <section class="bg-primary-300 text-white max-lg:pt-12" x-data="{ active: false }" x-intersect:enter="active = true"
        x-intersect:leave="active = false">
        <x-ui::container class="grid lg:grid-cols-2 items-center gap-16">
            <header class="space-y-6">
                <x-ui::h2 class="font-semibold" x-bind:class="{ 'animate-fade-up': active }">
                    Ofereça benefícios e torne sua empresa mais atrativa!
                </x-ui::h2>
                <p class="lg:text-lg font-light" x-bind:class="{ 'animate-fade-up animate-delay-200': active }">
                    Somos um portal que une os seus funcionários a
                    <span class="font-semibold">descontos, vantagens e benefícios de mais de 100 empresas
                        parceiras.</span>
                </p>
                <x-ui::button variant="primary" class="w-56 flex-none" href="#contratar">
                    Experimentar o EHub
                </x-ui::button>
            </header>
            <img src="{{ asset('static/img/ilustracao.svg') }}" class="h-full"
                x-bind:class="{ 'animate-fade-up animate-delay-600': active }">
        </x-ui::container>
    </section>

    <x-parceiros href="#contratar" />

    <x-home.how-it-works />
    <x-produtos :$produtos title="Benefícios que você encontra na nossa plataforma" />

    <x-ui::section x-data="{ active: false }" x-intersect.half:enter="active = true"
        x-intersect.half:leave="active = false">
        <x-ui::container>
            <div class="grid lg:grid-cols-3 grid-cols-1 gap-6 items-center">
                <div class="space-y-8">
                    <x-ui::h2 x-bind:class="{ 'animate-fade-up': active }">
                        Com a EHub,<br>
                        <strong>todo mundo sai ganhando!</strong>
                    </x-ui::h2>
                    <x-ui::button variant="primary" x-bind:class="{ 'animate-fade-up animate-delay-200': active }"
                        href="#contratar">
                        Entrar em contato
                    </x-ui::button>
                </div>
                <div class="lg:col-span-2">
                    <!-- Swiper -->
                    <x-ui::swiper options="{ slidesPerView: 1, autoplay: true }">
                        @foreach($cards as $item)
                        <x-ui::swiper.item>
                            <div
                                class="bg-primary-100 pl-6 pr-0 py-6 rounded-2xl lg:rounded-tr-[10rem] rounded-tr-[6rem] relative lg:h-72 items-center flex">
                                <div class="grow mr-28">
                                    <x-ui::h3 class="font-semibold mb-5"
                                        x-bind:class="{ 'animate-fade-up animate-delay-400': active }">
                                        {{ $item['titulo'] }}:</x-ui::h3>
                                    <ul class="[&>li]:flex [&>li]:gap-2 [&>li]:items-center space-y-5 lg:text-lg text-sm "
                                        x-bind:class="{ '[&>li]:animate-fade-up [&>li]:animate-delay-600': active }">

                                        @foreach($item['itens'] as $icon => $text)
                                        <li>
                                            <x-icon :name="$icon" class="h-6 w-6" />
                                            <span>{{ $text }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <img src="{{ $item['imagem'] }}"
                                    x-bind:class="{ 'animate-fade animate-delay-400': active }"
                                    class="lg:w-1/2 w-40 absolute lg:flex-none right-0 h-full top-0 object-contain object-bottom">
                            </div>
                        </x-ui::swiper.item>
                        @endforeach
                    </x-ui::swiper>
                </div>
            </div>
        </x-ui::container>
    </x-ui::section>

    <x-ui::section variant="primary-300" id="contratar">
        <x-ui::container class="grid lg:grid-cols-2 gap-4 items-center">
            <div class="space-y-5">
                <x-ui::h2 class="font-bold">Vamos nessa juntos?</x-ui::h2>
                <div>
                    <span>Preencha o formulário e comece a contratação do seu mais novo portal de benefícios.</span>
                </div>
            </div>
            <div>
                @livewire('components.formulario-inscricao')
            </div>
        </x-ui::container>
    </x-ui::section>
</div>
