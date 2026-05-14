<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Lucy Braga Sartoria</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Playfair+Display:ital,wght@0,300;0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            black: '#0a0a0a',
                            gold: '#c5a059'
                        }
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        sans: ['"Montserrat"', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        /* Esconde a barra de rolagem mas mantém a funcionalidade nas miniaturas */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-brand-black text-gray-200 font-sans antialiased min-h-screen flex flex-col selection:bg-brand-gold selection:text-black">

    <header class="bg-[#0a0a0a]/90 backdrop-blur-md border-b border-brand-gold/10 py-6 px-6 md:px-16 flex justify-between items-center sticky top-0 z-40">
        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="block py-4 ml-8">
                <img src="{{ asset('images/logonav.png') }}"
                    alt="Lucy Braga Logo"
                    class="h-12 md:h-15 w-auto object-contain hover:scale-105 transition-all duration-500">
            </a>
        </div>
        <a href="{{ route('home') }}" class="text-[10px] uppercase tracking-[0.3em] text-white/60 hover:text-brand-gold transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="hidden md:inline">Voltar à Coleção</span>
        </a>
    </header>

    @php
    $mainImg = $product->images->where('is_main', true)->first() ?? $product->images->first();
    $mainImgUrl = $mainImg ? asset('storage/' . $mainImg->image_path) : '';
    @endphp

    <main class="flex-grow container mx-auto px-6 py-12 max-w-[1400px]"
        x-data="{ 
            mainImage: '{{ $mainImgUrl }}', 
            quantity: 1, 
            lightboxOpen: false,
            activeTab: 'desc',
            get whatsappLink() {
                let msg = 'Ciao! Fiquei encantada com a peça: *{{ $product->name }}*.\n\nCategoria: {{ $product->category }}\nQuantidade: ' + this.quantity + ' unidade(s)\nValor Total: R$ ' + ({{ $product->price }} * this.quantity).toFixed(2).replace('.', ',') + '\n\nPoderia me ajudar com a finalização e entrega?';
                return 'https://wa.me/554498675880?text=' + encodeURIComponent(msg);
            }
        }">

        <nav class="text-[9px] uppercase tracking-[0.4em] text-gray-500 mb-12 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-brand-gold transition">Boutique</a>
            <span>/</span>
            <span class="text-white/40">{{ $product->category }}</span>
            <span>/</span>
            <span class="text-brand-gold truncate max-w-[200px]">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">

            <div class="lg:col-span-7 flex flex-col md:flex-row-reverse gap-6 lg:sticky lg:top-32 h-fit">

                <div class="w-full relative aspect-[3/4] md:aspect-[4/5] border border-brand-gold/20 overflow-hidden bg-[#111111] group cursor-zoom-in" @click="if(mainImage) lightboxOpen = true">
                    <template x-if="mainImage">
                        <img :src="mainImage" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    </template>
                    <template x-if="!mainImage">
                        <div class="w-full h-full flex items-center justify-center text-gray-600 text-xs tracking-widest uppercase">Sem Imagem</div>
                    </template>

                    <div class="absolute bottom-6 right-6 bg-brand-black/80 backdrop-blur text-brand-gold p-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                    </div>
                </div>

                @if($product->images->count() > 1)
                <div class="w-full md:w-24 flex md:flex-col gap-4 overflow-x-auto md:overflow-y-auto no-scrollbar py-2 md:py-0">
                    @foreach($product->images as $image)
                    <div @click="mainImage = '{{ asset('storage/' . $image->image_path) }}'"
                        class="w-20 md:w-full flex-shrink-0 aspect-[3/4] border border-brand-gold/20 cursor-pointer overflow-hidden transition-all duration-300 relative"
                        :class="mainImage === '{{ asset('storage/' . $image->image_path) }}' ? 'border-brand-gold opacity-100 ring-1 ring-brand-gold ring-offset-2 ring-offset-[#0a0a0a]' : 'opacity-50 hover:opacity-100'">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover grayscale-[20%] hover:grayscale-0">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="lg:col-span-5 flex flex-col justify-start">

                <span class="text-[10px] uppercase tracking-[0.5em] text-brand-gold mb-4 block">{{ $product->category }}</span>
                <h1 class="font-display text-4xl md:text-5xl italic text-white mb-4 leading-tight">{{ $product->name }}</h1>

                <div class="text-3xl text-white tracking-widest font-light mb-8 flex items-baseline gap-2">
                    <span class="text-brand-gold text-lg">R$</span> {{ number_format($product->price, 2, ',', '.') }}
                </div>

                <div class="mb-10">
                    <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-500 mb-3">Quantidade</label>
                    <div class="flex items-center border border-gray-700 w-fit">
                        <button @click="if(quantity > 1) quantity--" class="px-5 py-3 text-gray-400 hover:text-brand-gold hover:bg-[#111111] transition-colors focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        </button>
                        <input type="text" x-model="quantity" readonly class="w-12 text-center bg-transparent text-white focus:outline-none font-light text-lg pointer-events-none">
                        <button @click="quantity++" class="px-5 py-3 text-gray-400 hover:text-brand-gold hover:bg-[#111111] transition-colors focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex flex-col gap-4 mb-12">
                    <a :href="whatsappLink" target="_blank" class="w-full bg-brand-gold text-brand-black px-8 py-5 flex items-center justify-center gap-3 text-[11px] font-bold uppercase tracking-[0.2em] hover:bg-white transition-colors relative overflow-hidden group">
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                        <svg class="w-5 h-5 relative z-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" />
                        </svg>
                        <span class="relative z-10">Adquirir Coleção <span x-text="quantity > 1 ? '(' + quantity + ')' : ''"></span></span>
                    </a>

                    <p class="text-[9px] uppercase tracking-[0.2em] text-gray-500 text-center flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Compra segura & Atendimento Exclusivo
                    </p>
                </div>

                <div class="border-t border-gray-800">
                    <div class="border-b border-gray-800">
                        <button @click="activeTab = activeTab === 'desc' ? null : 'desc'" class="w-full py-5 flex justify-between items-center text-left focus:outline-none group">
                            <span class="text-[11px] uppercase tracking-[0.2em] text-white group-hover:text-brand-gold transition-colors">Detalhes da Peça</span>
                            <svg class="w-5 h-5 text-brand-gold transform transition-transform" :class="activeTab === 'desc' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="activeTab === 'desc'" x-collapse class="pb-6">
                            <div class="prose prose-invert prose-sm text-gray-400 font-light leading-relaxed tracking-wide">
                                {!! nl2br(e($product->description)) ?? 'A essência do design italiano em uma peça exclusiva. Entre em contato para mais detalhes técnicos.' !!}
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-800">
                        <button @click="activeTab = activeTab === 'medidas' ? null : 'medidas'" class="w-full py-5 flex justify-between items-center text-left focus:outline-none group">
                            <span class="text-[11px] uppercase tracking-[0.2em] text-white group-hover:text-brand-gold transition-colors">Guia de Tamanhos e Caimento</span>
                            <svg class="w-5 h-5 text-brand-gold transform transition-transform" :class="activeTab === 'medidas' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="activeTab === 'medidas'" x-collapse class="pb-6">
                            <p class="text-sm text-gray-400 font-light leading-relaxed mb-4">Todas as nossas peças seguem o rigoroso padrão europeu de alfaiataria. Nossas consultoras estão prontas via WhatsApp para auxiliar na escolha da medida perfeita para o seu corpo.</p>
                            <ul class="text-[10px] uppercase tracking-widest text-brand-gold space-y-2">
                                <li>• P (36-38) - Busto: 84cm | Cintura: 66cm</li>
                                <li>• M (40-42) - Busto: 90cm | Cintura: 72cm</li>
                                <li>• G (44) - Busto: 96cm | Cintura: 78cm</li>
                            </ul>
                        </div>
                    </div>

                    <div class="border-b border-gray-800">
                        <button @click="activeTab = activeTab === 'envio' ? null : 'envio'" class="w-full py-5 flex justify-between items-center text-left focus:outline-none group">
                            <span class="text-[11px] uppercase tracking-[0.2em] text-white group-hover:text-brand-gold transition-colors">Envio & Sofisticação</span>
                            <svg class="w-5 h-5 text-brand-gold transform transition-transform" :class="activeTab === 'envio' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="activeTab === 'envio'" x-collapse class="pb-6">
                            <div class="flex items-start gap-4 text-gray-400 text-sm font-light">
                                <svg class="w-6 h-6 flex-shrink-0 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <div>
                                    <p class="mb-2"><strong>Embalagem Premium:</strong> Sua peça é preparada com extremo cuidado, perfumada e embalada em nossa caixa exclusiva Lucy Braga Noir.</p>
                                    <p>Entregamos em todo o Brasil. O prazo e o valor do frete são calculados diretamente com sua consultora.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div x-show="lightboxOpen" style="display: none;" class="fixed inset-0 z-50 bg-[#0a0a0a]/95 backdrop-blur-xl flex items-center justify-center p-4"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <button @click="lightboxOpen = false" class="absolute top-6 right-6 text-brand-gold hover:text-white transition-colors bg-black/50 p-2 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <img :src="mainImage" @click.outside="lightboxOpen = false" class="max-w-full max-h-[90vh] object-contain shadow-2xl border border-brand-gold/10">
        </div>
    </main>

    <footer class="mt-auto border-t border-brand-gold/10 py-10 px-6 text-center bg-[#111111]">
        <div class="font-display text-2xl tracking-[0.2em] uppercase text-brand-gold mb-4">Lucy Braga</div>
        <p class="text-[9px] uppercase tracking-[0.3em] text-white/30">&copy; {{ date('Y') }} La Bella Vita - CNPJ Fictício. Umuarama, PR.</p>
    </footer>

</body>

</html>