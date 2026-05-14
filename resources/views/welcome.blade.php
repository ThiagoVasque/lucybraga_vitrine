<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lucy Braga - L'Eleganza Senza Tempo. A essência da moda italiana, desenhada para o corpo da mulher brasileira.">
    <title>Lucy Braga | L'Eleganza Senza Tempo</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500&family=Playfair+Display:ital,wght@0,300;0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
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
                        sans: ['"Montserrat"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .hardware-accelerated {
            transform: translateZ(0);
            will-change: transform;
            backface-visibility: hidden;
        }

        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 2.5s infinite ease-in-out;
        }

        @keyframes slow-zoom {
            0% {
                transform: scale(1) translateZ(0);
            }

            100% {
                transform: scale(1.15) translateZ(0);
            }
        }

        .animate-slow-zoom {
            animation: slow-zoom 25s linear infinite alternate;
            will-change: transform;
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px) translateZ(0);
            }

            to {
                opacity: 1;
                transform: translateY(0) translateZ(0);
            }
        }

        .reveal-on-scroll {
            opacity: 0;
            will-change: opacity, transform;
        }

        .is-revealed {
            animation: fade-in-up 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes ticker {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-33.33%);
            }
        }

        .animate-ticker {
            display: flex;
            width: fit-content;
            animation: ticker 40s linear infinite;
        }
    </style>
</head>

<body
    class="min-h-screen flex flex-col bg-brand-black text-gray-200 font-sans antialiased selection:bg-brand-gold selection:text-brand-black"
    x-data="{ isMenuOpen: false, scrolled: false }"
    :class="isMenuOpen ? 'overflow-hidden' : ''"
    @scroll.window.throttle.50ms="scrolled = (window.pageYOffset > 50)">

    <div class="fixed top-0 left-0 w-full h-[2px] z-[60] flex opacity-80 hardware-accelerated">
        <div class="w-1/3 bg-[#009246]"></div>
        <div class="w-1/3 bg-[#F1F2F1]"></div>
        <div class="w-1/3 bg-[#CE2B37]"></div>
    </div>

    <header
        :class="scrolled ? 'bg-brand-black/95 backdrop-blur-md py-2 md:py-3 border-b border-brand-gold/10 shadow-2xl' : 'bg-transparent py-4 md:py-6'"
        class="fixed top-[2px] z-50 w-full transition-all duration-500 px-4 md:px-16 flex justify-between items-center hardware-accelerated">

        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="block py-2 ml-2 md:ml-8 md:py-4">
                <img src="{{ asset('images/logonav.png') }}" alt="Lucy Braga Logo" class="h-10 md:h-15 w-auto object-contain hover:scale-105 transition-all duration-500">
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-10">
            <a href="{{ route('home') }}" class="text-[11px] uppercase tracking-[0.2em] text-white/80 hover:text-brand-gold transition-colors">Início</a>
            <a href="#collezione" class="text-[11px] uppercase tracking-[0.2em] text-white/80 hover:text-brand-gold transition-colors">Coleção</a>
            <a href="#contatti" class="text-[11px] uppercase tracking-[0.2em] text-white/80 hover:text-brand-gold transition-colors">Contato</a>
        </nav>

        <button
            class="md:hidden flex flex-col gap-1.5 z-[60] relative focus:outline-none p-2 mr-2"
            aria-label="Abrir menu"
            :aria-expanded="isMenuOpen"
            @click="isMenuOpen = !isMenuOpen">
            <span class="w-6 h-[1px] bg-brand-gold transition-all duration-500" :class="isMenuOpen ? 'rotate-45 translate-y-2' : ''"></span>
            <span class="w-6 h-[1px] bg-brand-gold transition-all duration-500" :class="isMenuOpen ? 'opacity-0' : ''"></span>
            <span class="w-6 h-[1px] bg-brand-gold transition-all duration-500" :class="isMenuOpen ? '-rotate-45 -translate-y-[7px]' : ''"></span>
        </button>

        <template x-teleport="body">
            <div
                x-show="isMenuOpen"
                x-cloak
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-110"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-400"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-110"
                class="fixed inset-0 z-[55] bg-brand-black flex flex-col justify-between p-6 sm:p-8 md:hidden overflow-y-auto">

                <div class="absolute inset-0 opacity-5 pointer-events-none">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
                </div>

                <div class="flex justify-between items-center relative z-10 pt-4 pb-8">
                    <span class="text-[9px] uppercase tracking-[0.5em] text-brand-gold font-bold">Menu Exclusivo</span>
                </div>

                <nav class="flex flex-col gap-6 sm:gap-8 relative z-10 flex-grow justify-center">
                    <a href="{{ route('home') }}" @click="isMenuOpen = false" class="group flex items-end gap-3 sm:gap-4">
                        <span class="font-display text-3xl sm:text-5xl italic text-white group-hover:text-brand-gold transition-colors">Início</span>
                        <span class="text-[9px] sm:text-[10px] text-brand-gold/40 mb-1 sm:mb-2 uppercase tracking-widest">01</span>
                    </a>

                    <div x-data="{ openCat: false }" class="flex flex-col gap-4">
                        <button @click="openCat = !openCat" class="flex items-end gap-3 sm:gap-4 focus:outline-none group text-left">
                            <span class="font-display text-3xl sm:text-5xl italic text-white group-hover:text-brand-gold transition-colors">Coleções</span>
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-brand-gold mb-1 sm:mb-2 transition-transform duration-500" :class="openCat ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" stroke-width="1.5" />
                            </svg>
                        </button>

                        <div x-show="openCat" x-cloak x-collapse class="flex flex-col gap-4 pl-4 sm:pl-6 border-l border-brand-gold/20">
                            <a href="{{ route('home', ['category' => 'Roupas']) }}#collezione" @click="isMenuOpen = false" class="text-xs sm:text-sm uppercase tracking-[0.3em] text-gray-400 active:text-brand-gold">I Vestiti (Roupas)</a>
                            <a href="{{ route('home', ['category' => 'Sapatos']) }}#collezione" @click="isMenuOpen = false" class="text-xs sm:text-sm uppercase tracking-[0.3em] text-gray-400 active:text-brand-gold">Le Scarpe (Sapatos)</a>
                            <a href="{{ route('home', ['category' => 'Bolsas']) }}#collezione" @click="isMenuOpen = false" class="text-xs sm:text-sm uppercase tracking-[0.3em] text-gray-400 active:text-brand-gold">Le Borse (Bolsas)</a>
                        </div>
                    </div>

                    <a href="#contatti" @click="isMenuOpen = false" class="group flex items-end gap-3 sm:gap-4">
                        <span class="font-display text-3xl sm:text-5xl italic text-white group-hover:text-brand-gold transition-colors">Contato</span>
                        <span class="text-[9px] sm:text-[10px] text-brand-gold/40 mb-1 sm:mb-2 uppercase tracking-widest">02</span>
                    </a>
                </nav>

                <div class="relative z-10 border-t border-brand-gold/10 pt-6 mt-6 pb-2">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
                        <div class="flex flex-col gap-2">
                            <p class="text-[8px] uppercase tracking-widest text-gray-500 italic">Umuarama - PR</p>
                            <div class="flex gap-4">
                                <div class="w-3 h-3 rounded-full bg-[#009246]"></div>
                                <div class="w-3 h-3 rounded-full bg-white"></div>
                                <div class="w-3 h-3 rounded-full bg-[#CE2B37]"></div>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="inline-block text-center text-[9px] sm:text-[10px] uppercase tracking-widest text-brand-gold border border-brand-gold/30 px-4 py-2 w-max">Painel Admin</a>
                    </div>
                </div>
            </div>
        </template>
    </header>

    <section id="home" class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-[#0a0a0a]/40 z-10 hardware-accelerated"></div>
        <div class="absolute inset-0 bg-cover bg-center z-0 animate-slow-zoom" style="background-image: linear-gradient(to bottom, rgba(10,10,10,0.5), rgba(10,10,10,0.9)), url('{{ asset('images/capa.jpeg') }}');"></div>

        <div class="absolute inset-0 z-10 pointer-events-none opacity-20 hidden md:block">
            <div class="absolute left-16 top-0 bottom-0 w-[1px] bg-brand-gold"></div>
            <div class="absolute right-16 top-0 bottom-0 w-[1px] bg-brand-gold"></div>
        </div>

        <div class="relative z-20 text-center px-4 mt-12 md:mt-0 reveal-on-scroll hardware-accelerated">
            <div class="flex justify-center items-center gap-2 md:gap-4 mb-4 md:mb-6">
                <div class="w-4 sm:w-6 md:w-8 h-[1px] bg-brand-gold/50"></div>
                <span class="text-[8px] sm:text-[9px] md:text-[10px] uppercase tracking-[0.4em] sm:tracking-[0.5em] text-brand-gold font-semibold">Nuova Stagione</span>
                <div class="w-4 sm:w-6 md:w-8 h-[1px] bg-brand-gold/50"></div>
            </div>
            <h1 class="font-display text-4xl sm:text-6xl md:text-7xl lg:text-9xl mb-4 sm:mb-6 md:mb-8 font-light italic text-white leading-tight" style="text-shadow: 0 4px 12px rgba(0,0,0,0.5);">L'Eleganza <br /><span class="text-brand-gold">Senza Tempo</span></h1>
            <p class="text-[10px] sm:text-xs md:text-sm font-light max-w-xl mx-auto text-white/80 tracking-[0.15em] sm:tracking-[0.2em] md:tracking-[0.3em] leading-relaxed uppercase px-2">A essência da moda italiana, desenhada para o corpo da mulher brasileira.</p>
        </div>

        <!-- Wrapper externo: Cuida APENAS da posição absoluta e de cravar no meio da tela -->
        <div class="absolute bottom-10 md:bottom-12 left-1/2 -translate-x-1/2 z-20">

            <!-- Wrapper interno: Cuida APENAS da animação de subir/descer e do layout flex -->
            <div class="flex flex-col items-center gap-3 animate-bounce-slow hardware-accelerated">

                <!-- O ml-[0.4em] (margin-left) compensa o tracking para que a palavra fique matematicamente no centro da linha -->
                <span class="text-[7px] md:text-[8px] uppercase tracking-[0.4em] ml-[0.4em] text-brand-gold/80 font-bold">
                    Descubra
                </span>

                <div class="w-[1px] h-6 sm:h-8 md:h-12 bg-gradient-to-b from-brand-gold to-transparent"></div>
            </div>

        </div>
    </section>

    <div class="relative w-full bg-brand-gold py-2 md:py-3 overflow-hidden border-y border-white/10 hardware-accelerated shadow-2xl z-20">
        <div class="flex whitespace-nowrap animate-ticker items-center">
            @php
            $frases = [
            'COLLEZIONE INVERNO 2026',
            'L\'ELEGANZA SENZA TEMPO',
            'PEÇAS EXCLUSIVAS',
            'DESIGN ITALIANO',
            'ALTA SARTORIA',
            'ROBUSTEZ E SOFISTICAÇÃO',
            'LUCY BRAGA BOUTIQUE'
            ];
            @endphp

            @for ($i = 0; $i < 3; $i++)
                @foreach($frases as $frase)
                <span class="flex items-center mx-6 md:mx-10 text-[9px] sm:text-[10px] md:text-[11px] font-bold uppercase tracking-[0.3em] md:tracking-[0.4em] text-brand-black">
                {{ $frase }}
                <svg class="w-3 h-3 md:w-4 md:h-4 ml-10 md:ml-20 opacity-30" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
                </svg>
                </span>
                @endforeach
                @endfor
        </div>
    </div>

    <section id="collezione" class="py-16 md:py-24 px-4 md:px-12 max-w-[1800px] mx-auto w-full">
        <div class="mb-8 md:mb-12 text-center reveal-on-scroll">
            <span class="text-[8px] md:text-[10px] uppercase tracking-[0.4em] text-brand-gold mb-2 md:mb-4 block font-semibold">La Nostra Vetrina</span>
            <h2 class="font-display text-3xl sm:text-4xl md:text-6xl italic font-light text-white mb-4 md:mb-6">
                @if(request('category')) Coleção <span class="text-brand-gold">{{ request('category') }}</span> @else Collezione <span class="text-brand-gold">Completa</span> @endif
            </h2>
        </div>

        <!-- Sticky Filter Bar - Ajustada para mobile -->
        <div class="sticky top-[58px] sm:top-[70px] md:top-[88px] z-30 bg-brand-black/95 backdrop-blur-sm border-y border-brand-gold/20 py-3 md:py-4 mb-8 md:mb-20 shadow-xl hardware-accelerated">
            <form action="{{ route('home') }}#collezione" method="GET" class="flex flex-col md:flex-row justify-between md:items-center gap-3 px-2 md:px-0" x-data="{ openFilter: null }" x-ref="filterForm">
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

                <div class="flex flex-wrap items-center gap-2 sm:gap-4 w-full md:w-auto">
                    <div class="hidden md:flex items-center gap-2 border-r border-brand-gold/20 pr-6">
                        <svg class="w-4 h-4 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                        <span class="text-[9px] uppercase tracking-[0.3em] text-brand-gold font-bold">Filtrar por:</span>
                    </div>

                    <!-- Botão Categoria -->
                    <div class="relative">
                        <button type="button" @click="openFilter = openFilter === 'cat' ? null : 'cat'" class="text-[9px] sm:text-[10px] uppercase tracking-[0.2em] sm:tracking-[0.3em] text-white hover:text-brand-gold focus:outline-none flex items-center gap-1 font-medium bg-brand-gold/10 md:bg-transparent px-3 py-1.5 md:p-0 rounded-sm md:rounded-none">
                            Categoria <svg class="w-3 h-3 transition-transform" :class="openFilter === 'cat' ? 'rotate-180 text-brand-gold' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Modal Categoria -->
                        <div x-show="openFilter === 'cat'" x-cloak @click.outside="openFilter = null" x-transition class="absolute left-0 top-full mt-2 md:mt-6 w-[calc(100vw-2rem)] sm:w-64 bg-[#0a0a0a]/95 backdrop-blur-md border border-brand-gold/30 shadow-2xl p-5 md:p-6 flex flex-col gap-4 hardware-accelerated z-50">
                            @php $categorias = ['Roupas', 'Sapatos', 'Bolsas', 'Acessórios', 'Óculos', 'Cintos']; @endphp
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="category" value="" @change="$refs.filterForm.submit()" {{ empty(request('category')) ? 'checked' : '' }} class="hidden peer">
                                <div class="w-3 h-3 rounded-full border border-gray-600 mr-3 peer-checked:border-4 peer-checked:border-brand-gold transition-all"></div>
                                <span class="text-[11px] sm:text-xs tracking-widest text-gray-400 group-hover:text-white transition">Todas as Peças</span>
                            </label>
                            @foreach($categorias as $cat)
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="category" value="{{ $cat }}" @change="$refs.filterForm.submit()" {{ request('category') == $cat ? 'checked' : '' }} class="hidden peer">
                                <div class="w-3 h-3 rounded-full border border-gray-600 mr-3 peer-checked:border-4 peer-checked:border-brand-gold transition-all"></div>
                                <span class="text-[11px] sm:text-xs tracking-widest text-gray-400 group-hover:text-white transition">{{ $cat }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    @if(isset($sizes) && $sizes->count() > 0)
                    <!-- Botão Tamanho -->
                    <div class="relative">
                        <button type="button" @click="openFilter = openFilter === 'size' ? null : 'size'" class="text-[9px] sm:text-[10px] uppercase tracking-[0.2em] sm:tracking-[0.3em] text-white hover:text-brand-gold focus:outline-none flex items-center gap-1 font-medium bg-brand-gold/10 md:bg-transparent px-3 py-1.5 md:p-0 rounded-sm md:rounded-none">
                            Tamanho <svg class="w-3 h-3 transition-transform" :class="openFilter === 'size' ? 'rotate-180 text-brand-gold' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Modal Tamanho -->
                        <div x-show="openFilter === 'size'" x-cloak @click.outside="openFilter = null" x-transition class="absolute left-0 md:left-1/2 md:-translate-x-1/2 top-full mt-2 md:mt-6 w-[calc(100vw-2rem)] md:w-64 bg-[#0a0a0a]/95 backdrop-blur-md border border-brand-gold/30 shadow-2xl p-5 md:p-6 hardware-accelerated z-50">
                            <div class="flex flex-wrap gap-2">
                                @foreach($sizes as $size)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="size[]" value="{{ $size }}" @change="$refs.filterForm.submit()" {{ in_array($size, (array)request('size', [])) ? 'checked' : '' }} class="hidden peer">
                                    <span class="flex items-center justify-center min-w-[32px] px-3 py-2 border border-gray-700 text-[10px] font-bold text-gray-400 peer-checked:bg-brand-gold peer-checked:text-brand-black peer-checked:border-brand-gold hover:border-gray-300 transition">{{ $size }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Botão Valor -->
                    <div class="relative">
                        <button type="button" @click="openFilter = openFilter === 'price' ? null : 'price'" class="text-[9px] sm:text-[10px] uppercase tracking-[0.2em] sm:tracking-[0.3em] text-white hover:text-brand-gold focus:outline-none flex items-center gap-1 font-medium bg-brand-gold/10 md:bg-transparent px-3 py-1.5 md:p-0 rounded-sm md:rounded-none">
                            Valor <svg class="w-3 h-3 transition-transform" :class="openFilter === 'price' ? 'rotate-180 text-brand-gold' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Modal Valor -->
                        <div x-show="openFilter === 'price'" x-cloak @click.outside="openFilter = null" x-transition class="absolute left-0 sm:right-0 sm:left-auto md:left-0 md:right-auto top-full mt-2 md:mt-6 w-[calc(100vw-2rem)] md:w-64 bg-[#0a0a0a]/95 backdrop-blur-md border border-brand-gold/30 shadow-2xl p-5 md:p-6 hardware-accelerated z-50">
                            <div class="flex items-center gap-2 mb-4">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Mín" class="w-full bg-[#111111] border border-gray-700 p-2 text-xs text-white focus:outline-none focus:border-brand-gold text-center">
                                <span class="text-gray-500">-</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Máx" class="w-full bg-[#111111] border border-gray-700 p-2 text-xs text-white focus:outline-none focus:border-brand-gold text-center">
                            </div>
                            <button type="submit" class="w-full bg-brand-gold text-brand-black font-bold py-3 text-[9px] uppercase tracking-[0.2em] hover:bg-white transition-colors">Aplicar Filtro</button>
                        </div>
                    </div>

                    @if(request('category') || request('size') || request('min_price') || request('max_price'))
                    <a href="{{ route('home') }}#collezione" class="flex items-center gap-1 px-3 py-1.5 bg-red-900/10 border border-red-900/30 text-red-400 text-[8px] font-bold uppercase tracking-[0.2em] hover:bg-red-900/30 hover:text-red-300 transition-colors rounded-sm ml-auto md:ml-4">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="hidden sm:inline">Limpar Tudo</span>
                        <span class="sm:hidden">Limpar</span>
                    </a>
                    @endif
                </div>

                <div class="flex items-center justify-between w-full md:w-auto pt-2 mt-1 border-t border-brand-gold/10 md:border-0 md:pt-0 md:mt-0">
                    <label class="text-[8px] sm:text-[9px] uppercase tracking-widest text-gray-500 mr-2">Ordenar por:</label>
                    <select name="sort" @change="$refs.filterForm.submit()" class="bg-transparent text-[9px] sm:text-[10px] uppercase tracking-widest text-brand-gold border-b border-brand-gold/50 pb-1 focus:outline-none cursor-pointer">
                        <option value="newest" class="bg-brand-black" {{ request('sort') == 'newest' ? 'selected' : '' }}>Lançamentos</option>
                        <option value="price_asc" class="bg-brand-black" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Menor Preço</option>
                        <option value="price_desc" class="bg-brand-black" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Maior Preço</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-3 sm:gap-x-6 lg:gap-x-12 gap-y-10 sm:gap-y-16 md:gap-y-24">
            @forelse($products as $product)
            <a href="{{ route('product.show', $product->id) }}" class="group cursor-pointer block reveal-on-scroll" style="animation-delay: {{ $loop->index * 50 }}ms">
                <div class="relative aspect-[3/4] overflow-hidden mb-3 sm:mb-6 md:mb-8 border border-brand-gold/10 shadow-lg hardware-accelerated">
                    @php $mainImage = $product->images->where('is_main', true)->first() ?? $product->images->first(); @endphp

                    @if($mainImage)
                    <img src="{{ asset('storage/' . $mainImage->image_path) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 grayscale-[5%] group-hover:grayscale-0 hardware-accelerated">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-[#0a0a0a] text-gray-600 font-display italic text-[10px] sm:text-sm">Sem Fotografia</div>
                    @endif

                    <div class="absolute top-2 left-2 sm:top-4 sm:left-4 md:top-6 md:left-6 z-20">
                        <span class="text-[6px] sm:text-[8px] md:text-[9px] uppercase tracking-[0.2em] sm:tracking-[0.4em] text-brand-gold bg-brand-black/90 px-1.5 py-1 sm:px-3 sm:py-2 md:px-4 border border-brand-gold/20">{{ $product->category }}</span>
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-t from-brand-black/90 via-brand-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center p-2 sm:p-8 z-10 hardware-accelerated">
                        <span class="bg-brand-gold text-brand-black border border-brand-gold px-3 py-1.5 sm:px-6 md:px-8 sm:py-3 md:py-4 text-[7px] sm:text-[9px] md:text-[10px] font-bold uppercase tracking-widest transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-xl">
                            <span class="sm:hidden">Descobrir</span>
                            <span class="hidden sm:inline">Descobrir Peça</span>
                        </span>
                    </div>
                </div>

                <div class="text-center relative z-20 px-1">
                    <h3 class="font-display text-lg sm:text-2xl md:text-3xl italic mb-1 sm:mb-3 text-white/90 group-hover:text-brand-gold transition-colors">{{ $product->name }}</h3>

                    @if($product->discount_percent > 0)
                    <div class="flex items-center justify-center gap-1.5 sm:gap-3 mb-2 sm:mb-4">
                        <p class="text-gray-500 text-[10px] sm:text-sm line-through decoration-brand-gold/50 font-light">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </p>
                        <p class="text-brand-gold text-sm sm:text-xl tracking-[0.1em] font-medium">
                            R$ {{ number_format($product->price * (1 - ($product->discount_percent / 100)), 2, ',', '.') }}
                        </p>
                    </div>
                    <div class="absolute -top-2 right-2 sm:-top-4 sm:right-4 bg-red-900 text-white text-[6px] sm:text-[8px] font-bold px-1.5 py-0.5 uppercase tracking-tighter">
                        {{ $product->discount_percent }}% OFF
                    </div>
                    @else
                    <p class="text-brand-gold text-sm sm:text-lg tracking-[0.1em] sm:tracking-[0.2em] font-light mb-2 sm:mb-4">
                        R$ {{ number_format($product->price, 2, ',', '.') }}
                    </p>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-full py-16 sm:py-20 md:py-32 text-center border border-dashed border-brand-gold/30 reveal-on-scroll mx-2">
                <p class="text-brand-gold/60 text-[10px] sm:text-xs md:text-sm tracking-[0.2em] sm:tracking-[0.3em] uppercase mb-4">A coleção está sendo preparada.</p>
                <a href="{{ route('home') }}#collezione" class="text-white border-b border-brand-gold pb-1 text-[8px] sm:text-[9px] md:text-[10px] uppercase tracking-widest hover:text-brand-gold transition-colors">Voltar ao catálogo principal</a>
            </div>
            @endforelse
        </div>

        <div class="mt-16 sm:mt-20 md:mt-32 flex flex-col sm:flex-row justify-center items-center gap-4 md:gap-6 reveal-on-scroll">
            @if($products->previousPageUrl())
            <a href="{{ $products->appends(request()->query())->previousPageUrl() }}#collezione" class="w-full sm:w-auto text-center border border-brand-gold/30 text-brand-gold px-8 py-3 sm:py-4 md:px-10 md:py-5 text-[9px] md:text-[10px] uppercase tracking-[0.3em] hover:bg-brand-gold hover:text-black transition-colors">
                Página Anterior
            </a>
            @endif

            @if($products->hasMorePages())
            <a href="{{ $products->appends(request()->query())->nextPageUrl() }}#collezione" class="w-full sm:w-auto justify-center bg-brand-gold text-brand-black px-10 py-3 sm:py-4 md:px-12 md:py-5 text-[9px] sm:text-[10px] md:text-[11px] font-bold uppercase tracking-[0.2em] sm:tracking-[0.3em] hover:bg-white transition-colors flex items-center gap-3 sm:gap-4 shadow-[0_0_40px_rgba(197,160,89,0.3)]">
                Ver Mais Peças
                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </a>
            @endif
        </div>
    </section>

    <section class="py-16 sm:py-20 md:py-32 bg-[#111111] border-y border-brand-gold/10 overflow-hidden text-center px-4 sm:px-6 reveal-on-scroll hardware-accelerated">
        <div class="max-w-4xl mx-auto">
            <span class="text-2xl sm:text-3xl md:text-4xl text-brand-gold mb-4 sm:mb-6 md:mb-8 block font-display italic">“</span>
            <h2 class="font-display text-xl sm:text-2xl md:text-5xl italic font-light text-white/80 leading-relaxed mb-6 md:mb-8 px-2">La moda passa, lo stile resta. <br /><span class="text-brand-gold">Lucy Braga</span> é a essência da elegância para a mulher brasileira.</h2>
            <div class="flex justify-center w-full">
                <div class="w-2 sm:w-3 md:w-4 h-[2px] bg-[#009246]"></div>
                <div class="w-2 sm:w-3 md:w-4 h-[2px] bg-white"></div>
                <div class="w-2 sm:w-3 md:w-4 h-[2px] bg-[#CE2B37]"></div>
            </div>
        </div>
    </section>

    <section id="sobre" class="py-16 sm:py-24 md:py-32 px-4 sm:px-6 md:px-16 bg-brand-black overflow-hidden relative">
        <div class="absolute inset-y-0 right-0 pointer-events-none select-none h-full opacity-[0.02] transform translate-x-1/2">
            <img src="{{ asset('images/leao.png') }}" class="h-full w-auto object-contain" alt="" aria-hidden="true">
        </div>

        <div class="max-w-[1400px] mx-auto flex flex-col lg:flex-row items-center gap-10 sm:gap-16 md:gap-24">
            <div class="w-full lg:w-1/2 relative reveal-on-scroll hardware-accelerated px-2 sm:px-0">
                <div class="absolute -top-4 -left-4 sm:-top-6 sm:-left-6 w-full h-full border border-brand-gold/20 z-0"></div>

                <!-- Aspect-square no mobile, aspect-[4/5] no desktop -->
                <div class="relative z-10 aspect-square md:aspect-[4/5] overflow-hidden shadow-2xl">
                    <img src="{{ asset('images/lucy.jpg') }}" alt="Lucy Braga" class="w-full h-full object-cover grayscale-[30%] hover:grayscale-0 transition-all duration-1000">
                </div>

                <div class="absolute -bottom-6 -right-6 sm:-bottom-10 sm:-right-10 bg-[#111111] border border-brand-gold/30 p-4 sm:p-8 hidden sm:block z-20">
                    <div class="flex gap-1.5 sm:gap-2 mb-2 sm:mb-3">
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-[#009246]"></div>
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-white"></div>
                        <div class="w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-[#CE2B37]"></div>
                    </div>
                    <span class="text-[8px] sm:text-[10px] uppercase tracking-[0.4em] text-brand-gold font-bold">Originale</span>
                </div>
            </div>

            <div class="w-full lg:w-1/2 reveal-on-scroll hardware-accelerated mt-8 lg:mt-0" style="animation-delay: 200ms">
                <span class="text-[9px] sm:text-[10px] uppercase tracking-[0.5em] sm:tracking-[0.6em] text-brand-gold mb-4 sm:mb-6 block font-semibold text-center lg:text-left">L'Anima della Marca</span>
                <h2 class="font-display text-3xl sm:text-4xl md:text-6xl italic text-white mb-6 sm:mb-8 leading-tight text-center lg:text-left">
                    Lucy Braga: <br class="hidden lg:block">
                    <span class="text-brand-gold">Visão e Essência</span>
                </h2>

                <div class="space-y-4 sm:space-y-6 text-gray-400 font-light leading-relaxed tracking-wide text-xs sm:text-sm md:text-base px-2 sm:px-0 text-justify sm:text-left">
                    <p>A marca Lucy Braga nasceu da paixão por traduzir a sofisticação das passarelas de Milão para o dinamismo e a beleza da mulher brasileira. Fundada com o propósito de oferecer mais do que vestuário, a boutique foca na curadoria de peças que contam histórias.</p>
                    <p>Cada costura, tecido e acabamento é selecionado pessoalmente por Lucy, garantindo que a exclusividade seja a marca registrada de cada cliente. Nossa história é escrita através do olhar atento aos detalhes e da busca incessante pelo <span class="text-white italic">"bello e ben fatto"</span> (o belo e bem feito).</p>
                    <p class="font-display italic text-lg sm:text-xl text-brand-gold/80 pt-2 sm:pt-4 text-center lg:text-left">"Minha missão é fazer com que cada mulher sinta que sua elegância é, acima de tudo, uma expressão de sua força interior."</p>
                </div>

                <div class="mt-8 sm:mt-12 flex flex-col items-center lg:items-start">
                    <span class="font-display text-2xl sm:text-3xl md:text-4xl text-white italic tracking-tighter opacity-80">Lucy Braga</span>
                    <div class="w-16 sm:w-20 h-[1px] bg-brand-gold mt-2"></div>
                </div>
            </div>
        </div>
    </section>

    <footer id="contatti" class="bg-brand-black text-white pt-16 sm:pt-24 md:pt-32 pb-8 sm:pb-12 md:pb-16 px-4 sm:px-6 md:px-16 border-t border-brand-gold/10">
        <div class="max-w-[1600px] mx-auto text-center reveal-on-scroll hardware-accelerated">
            <div class="flex justify-center items-center mb-6 sm:mb-8 md:mb-10">
                <!-- Tamanho reduzido no mobile (h-24), padrão no md (h-56) -->
                <img src="{{ asset('images/logo.png') }}" alt="Lucy Braga Logo" class="h-24 sm:h-32 md:h-56 w-auto object-contain hover:scale-105 transition-all duration-500">
            </div>

            <p class="text-white/40 text-[9px] sm:text-[10px] md:text-xs tracking-widest mb-8 sm:mb-10 md:mb-12 uppercase">Design Italiano • Brasil</p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-5 sm:gap-6 md:gap-8 mb-8 sm:mb-10 md:mb-12 text-[8px] sm:text-[9px] md:text-[10px] uppercase tracking-[0.2em] sm:tracking-widest font-semibold">
                <a href="https://wa.me/554498675880" class="text-gray-500 hover:text-brand-gold transition-colors">WhatsApp</a>
                <a href="https://www.instagram.com/lucybragaboutique/" class="text-gray-500 hover:text-brand-gold transition-colors">Instagram</a>
                <a href="{{ route('login') }}" class="text-gray-500 hover:text-brand-gold transition-colors flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0110 0v4"></path>
                    </svg> Admin
                </a>
            </div>

            <p class="text-[7px] sm:text-[8px] md:text-[9px] uppercase tracking-[0.2em] sm:tracking-[0.3em] text-white/20">
                &copy; {{ date('Y') }} Lucy Braga Boutique. Desenvolvido com Maestria.
            </p>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.05
            });

            document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>