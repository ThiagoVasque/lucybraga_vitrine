<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Acesso | Lucy Braga</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500&family=Playfair+Display:ital,wght@0,300;0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { brand: { black: '#0a0a0a', gold: '#c5a059' } },
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

    <div class="absolute inset-0 bg-cover bg-center opacity-30 scale-105" style="background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80')"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-brand-black via-brand-black/90 to-brand-black/40"></div>

    <div class="relative z-10 w-full max-w-md px-6">
        
        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="font-display text-4xl font-bold tracking-[0.2em] uppercase text-brand-gold drop-shadow-lg block mb-2">
                Lucy Braga
            </a>
            <div class="flex justify-center items-center gap-3">
                <div class="w-6 h-[1px] bg-brand-gold/40"></div>
                <span class="text-[9px] uppercase tracking-[0.4em] text-brand-gold/60 italic font-light">Recuperação de Acesso</span>
                <div class="w-6 h-[1px] bg-brand-gold/40"></div>
            </div>
        </div>

        <div class="bg-[#111111]/90 backdrop-blur-xl border border-brand-gold/20 p-8 md:p-12 shadow-2xl relative">
            
            <div class="absolute top-0 left-0 w-4 h-4 border-t border-l border-brand-gold/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t border-r border-brand-gold/50"></div>
            <div class="absolute bottom-0 left-0 w-4 h-4 border-b border-l border-brand-gold/50"></div>
            <div class="absolute bottom-0 right-0 w-4 h-4 border-b border-r border-brand-gold/50"></div>

            <div class="mb-8 text-center">
                <p class="text-[10px] text-gray-400 font-light tracking-[0.2em] uppercase leading-relaxed">
                    Esqueceu sua senha? Informe seu endereço de e-mail e enviaremos instruções seguras para redefinir seu acesso exclusivo.
                </p>
            </div>

            <x-auth-session-status class="mb-6 text-brand-gold text-[10px] text-center uppercase tracking-widest border border-brand-gold/30 p-3" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-8">
                @csrf

                <div class="relative group">
                    <label for="email" class="block text-[9px] uppercase tracking-[0.3em] text-brand-gold mb-2">E-mail Cadastrado</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-transparent border-0 border-b border-gray-700 pb-2 text-white focus:ring-0 focus:border-brand-gold transition-colors text-sm font-light placeholder-gray-700" placeholder="admin@lucybraga.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-[10px] uppercase tracking-widest" />
                </div>

                <button type="submit" class="mt-2 w-full bg-brand-gold text-brand-black py-4 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-white transition-colors shadow-[0_0_20px_rgba(197,160,89,0.15)] flex justify-center items-center gap-2 group">
                    Enviar Link de Recuperação
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </button>
            </form>
        </div>

        <div class="text-center mt-12 flex flex-col items-center gap-4">
            <div class="flex justify-center w-full opacity-50">
                <div class="w-4 h-[1px] bg-[#009246]"></div><div class="w-4 h-[1px] bg-white"></div><div class="w-4 h-[1px] bg-[#CE2B37]"></div>
            </div>
            <a href="{{ route('login') }}" class="text-[9px] uppercase tracking-[0.4em] text-white/40 hover:text-brand-gold transition-colors flex items-center gap-2 mt-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Voltar ao Login
            </a>
        </div>
    </div>

</body>
</html>