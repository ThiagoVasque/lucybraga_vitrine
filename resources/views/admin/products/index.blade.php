<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo Admin | Lucy Braga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="bg-[#0a0a0a] text-gray-200 min-h-screen">

    <nav class="border-b border-[#c5a059]/20 bg-[#111111] py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50 shadow-md">

        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logonav.png') }}"
                alt="Lucy Braga Logo"
                class="h-12 md:h-15 w-auto object-contain hover:scale-105 transition-all duration-500">
            <div class="hidden md:block w-[1px] h-5 bg-[#c5a059]/30"></div>
            <span class="text-[9px] md:text-[10px] text-gray-500 tracking-[0.2em] uppercase mt-1">
                Setor Administrativo
            </span>
        </div>

        <div class="flex items-center gap-5 md:gap-6">

            <a href="{{ route('home') }}" target="_blank" class="group flex items-center gap-1.5 text-gray-400 hover:text-[#c5a059] transition-colors text-[10px] uppercase tracking-widest font-semibold">
                <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span class="hidden sm:block">Ver Loja</span>
            </a>

            <div class="w-[1px] h-4 bg-gray-800"></div>

            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="group flex items-center gap-1.5 text-red-500/70 hover:text-red-400 transition-colors uppercase tracking-widest text-[10px] font-semibold">
                    <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="hidden sm:block">Sair</span>
                </button>
            </form>

        </div>
    </nav>

    <main class="max-w-6xl mx-auto py-12 px-6">
        <header class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <h1 class="font-display text-4xl italic text-white mb-2">Coleção <span class="text-[#c5a059]">Atual</span></h1>
                <p class="text-[10px] uppercase tracking-[0.3em] text-gray-500">Gerencie as peças disponíveis na vitrine</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="bg-[#c5a059] text-black font-semibold text-[10px] uppercase tracking-widest px-8 py-3 hover:bg-white transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nova Peça
            </a>
        </header>

        @if(session('success'))
        <div class="bg-green-900/30 border border-green-500/50 text-green-400 p-4 mb-8 text-sm tracking-wide">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-[#111111] border border-[#c5a059]/10 shadow-2xl overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#c5a059]/20 text-[10px] uppercase tracking-[0.2em] text-[#c5a059]">
                        <th class="p-4 font-normal">Peça</th>
                        <th class="p-4 font-normal">Valor</th>
                        <th class="p-4 font-normal">Status</th>
                        <th class="p-4 font-normal text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-300">
                    @forelse($products as $product)
                    <tr class="border-b border-gray-800/50 hover:bg-[#c5a059]/5 transition-colors">
                        <td class="p-4 flex items-center gap-4">
                            <div class="w-12 h-16 bg-[#0a0a0a] border border-[#c5a059]/20 overflow-hidden flex-shrink-0">
                                @php $mainImg = $product->images->where('is_main', true)->first() ?? $product->images->first(); @endphp
                                @if($mainImg)
                                <img src="{{ asset('storage/' . $mainImg->image_path) }}" class="w-full h-full object-cover grayscale-[30%]" alt="Foto">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-[8px] text-gray-600">SEM FOTO</div>
                                @endif
                            </div>
                            <span class="font-display text-lg italic">{{ $product->name }}</span>
                        </td>
                        <td class="p-4 text-[#c5a059] tracking-wider">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </td>
                        <td class="p-4">
                            @if($product->is_active)
                            <span class="bg-green-900/50 text-green-400 border border-green-500/30 px-3 py-1 text-[9px] uppercase tracking-widest">Na Vitrine</span>
                            @else
                            <span class="bg-red-900/50 text-red-400 border border-red-500/30 px-3 py-1 text-[9px] uppercase tracking-widest">Oculto</span>
                            @endif
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-gray-400 hover:text-[#c5a059] transition" title="Editar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Excluir esta peça permanentemente da coleção?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Excluir">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500 text-xs uppercase tracking-widest border-b border-gray-800">
                            Nenhuma peça cadastrada na coleção.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </main>

</body>

</html>