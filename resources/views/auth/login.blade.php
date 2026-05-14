<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Restrito | Lucy Braga</title>

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
</head>

<body class="min-h-screen flex items-center justify-center bg-brand-black font-sans text-gray-200 selection:bg-brand-gold selection:text-black relative overflow-hidden">

    <div class="absolute inset-0 z-0 bg-black overflow-hidden">
        <img src="{{ asset('images/fonte.jpeg') }}"
            alt="Fundo Login"
            class="w-full h-full object-cover opacity-30 scale-105">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-brand-black via-brand-black/90 to-brand-black/40"></div>

    <div class="relative z-10 w-full max-w-md px-6">

        <div class="text-center mb-10">
            <div class="flex justify-center items-center mb-8 md:mb-10">
                <img src="{{ asset('images/logoadm.png') }}"
                    alt="Lucy Braga Logo"
                    class="h-26 md:h-36 w-auto object-contain hover:scale-105 transition-all duration-500">
            </div>
            <div class="flex justify-center items-center gap-3">
                <div class="w-6 h-[1px] bg-brand-gold/40"></div>
                <span class="text-[9px] uppercase tracking-[0.4em] text-brand-gold/60 italic font-light">Login ADM</span>
                <div class="w-6 h-[1px] bg-brand-gold/40"></div>
            </div>
        </div>

        <div class="bg-[#111111]/90 backdrop-blur-xl border border-brand-gold/20 p-8 md:p-12 shadow-2xl relative">

            <div class="absolute top-0 left-0 w-4 h-4 border-t border-l border-brand-gold/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t border-r border-brand-gold/50"></div>
            <div class="absolute bottom-0 left-0 w-4 h-4 border-b border-l border-brand-gold/50"></div>
            <div class="absolute bottom-0 right-0 w-4 h-4 border-b border-r border-brand-gold/50"></div>

            <x-auth-session-status class="mb-4 text-brand-gold text-xs text-center uppercase tracking-widest" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-8">
                @csrf

                <div class="relative group">
                    <label for="email" class="block text-[9px] uppercase tracking-[0.3em] text-brand-gold mb-2">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full bg-transparent border-0 border-b border-gray-700 pb-2 text-white focus:ring-0 focus:border-brand-gold transition-colors text-sm font-light placeholder-gray-700" placeholder="admin@lucybraga.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-[10px] uppercase tracking-widest" />
                </div>

                <div class="relative group">
                    <label for="password" class="block text-[9px] uppercase tracking-[0.3em] text-brand-gold mb-2">Senha</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full bg-transparent border-0 border-b border-gray-700 pb-2 text-white focus:ring-0 focus:border-brand-gold transition-colors text-sm font-light placeholder-gray-700" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-[10px] uppercase tracking-widest" />
                </div>

                <div class="flex items-center justify-between mt-2">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" class="hidden peer" name="remember">
                        <div class="w-3 h-3 border border-gray-600 mr-3 peer-checked:bg-brand-gold peer-checked:border-brand-gold flex items-center justify-center transition-colors">
                            <svg class="w-2 h-2 text-brand-black opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-[9px] uppercase tracking-widest text-gray-400 group-hover:text-white transition">Lembrar-me</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a class="text-[9px] uppercase tracking-widest text-gray-400 hover:text-brand-gold transition" href="{{ route('password.request') }}">
                        Esqueceu a senha?
                    </a>
                    @endif
                </div>

                <button type="submit" class="mt-4 w-full bg-brand-gold text-brand-black py-4 text-[11px] font-bold uppercase tracking-[0.3em] hover:bg-white transition-colors shadow-[0_0_20px_rgba(197,160,89,0.15)] flex justify-center items-center gap-2 group">
                    Autenticar
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>
        </div>

        <div class="text-center mt-12 flex flex-col items-center gap-4">
            <div class="flex justify-center w-full opacity-50">
                <div class="w-4 h-[1px] bg-[#009246]"></div>
                <div class="w-4 h-[1px] bg-white"></div>
                <div class="w-4 h-[1px] bg-[#CE2B37]"></div>
            </div>
            <a href="{{ route('home') }}" class="text-[9px] uppercase tracking-[0.4em] text-white/40 hover:text-brand-gold transition-colors flex items-center gap-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar à Vitrine
            </a>
        </div>
    </div>

</body>

</html>