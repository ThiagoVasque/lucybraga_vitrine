<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Peça | Lucy Braga Admin</title>
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

    <nav class="border-b border-[#c5a059]/20 bg-[#111111] py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50">

        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logonav.png') }}"
                alt="Lucy Braga Logo"
                class="h-10 md:h-12 w-auto object-contain hover:scale-105 transition-all duration-500">

            <div class="hidden md:block w-[1px] h-5 bg-[#c5a059]/30"></div>

            <span class="text-[9px] md:text-[10px] text-gray-500 tracking-[0.2em] uppercase mt-1">
                Setor Administrativo
            </span>
        </div>

        <a href="{{ route('admin.products.index') }}"
            class="text-[#c5a059] border border-[#c5a059]/30 px-5 md:px-6 py-2 text-[9px] md:text-[10px] uppercase tracking-widest hover:bg-[#c5a059] hover:text-black transition-all duration-300 font-semibold">
            Voltar ao Catálogo
        </a>

    </nav>

    <main class="max-w-4xl mx-auto py-12 px-6">
        <header class="mb-10">
            <h1 class="font-display text-4xl italic text-white mb-2">Editar <span class="text-[#c5a059]">{{ $product->name }}</span></h1>
            <p class="text-[10px] uppercase tracking-[0.3em] text-gray-500">Atualize os dados ou gerencie as fotos da peça</p>
        </header>

        @if(session('success'))
        <div class="bg-green-900/30 border border-green-500/50 text-green-400 p-4 mb-8 text-sm tracking-wide">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-[#111111] border border-[#c5a059]/10 p-8 shadow-2xl space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-2">Nome da Peça *</label>
                    <input type="text" name="name" value="{{ $product->name }}" required class="w-full bg-transparent border-b border-gray-700 pb-2 text-white focus:outline-none focus:border-[#c5a059]">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-2">Categoria *</label>
                    <select name="category" required class="w-full bg-[#0a0a0a] border-b border-gray-700 pb-2 text-white focus:outline-none focus:border-[#c5a059] p-2">
                        <option value="Roupas" {{ $product->category == 'Roupas' ? 'selected' : '' }}>Roupas</option>
                        <option value="Sapatos" {{ $product->category == 'Sapatos' ? 'selected' : '' }}>Sapatos</option>
                        <option value="Bolsas" {{ $product->category == 'Bolsas' ? 'selected' : '' }}>Bolsas</option>
                        <option value="Acessórios" {{ $product->category == 'Acessórios' ? 'selected' : '' }}>Acessórios</option>
                        <option value="Óculos" {{ $product->category == 'Óculos' ? 'selected' : '' }}>Óculos</option>
                        <option value="Cintos" {{ $product->category == 'Cintos' ? 'selected' : '' }}>Cintos</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-2">Valor (R$) *</label>
                    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required class="w-full bg-transparent border-b border-gray-700 pb-2 text-white focus:outline-none focus:border-[#c5a059]">
                </div>

                <div class="flex items-center mt-6">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $product->is_active ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#c5a059]"></div>
                        <span class="ml-3 text-[10px] uppercase tracking-[0.2em] text-gray-400">Ativo na Vitrine</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-2">Descrição / Destaques</label>
                <textarea name="description" rows="4" class="w-full bg-[#0a0a0a] border border-gray-700 p-3 text-white focus:outline-none focus:border-[#c5a059] resize-none text-sm">{{ $product->description }}</textarea>
            </div>

            <div class="pt-4 border-t border-[#c5a059]/10">
                <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-4">Adicionar Novas Fotos</label>
                <input name="images[]" type="file" multiple accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#c5a059]/10 file:text-[#c5a059] hover:file:bg-[#c5a059]/20" />
            </div>

            <div class="pt-6 flex justify-end">
                <button type="submit" class="bg-[#c5a059] text-black font-semibold text-[11px] uppercase tracking-widest px-10 py-4 hover:bg-white transition-colors">Salvar Alterações</button>
            </div>
        </form>

        <div class="mt-12 bg-[#111111] border border-[#c5a059]/10 p-8 shadow-2xl">
            <h3 class="text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-6">Fotos Atuais da Peça</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($product->images as $image)
                <div class="relative group aspect-[3/4] border border-gray-800 overflow-hidden shadow-lg">
                    
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    
                    <!-- Overlay de Ações -->
                    <div class="absolute inset-0 bg-[#0a0a0a]/90 backdrop-blur-sm flex flex-col items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300 p-6 z-20">
                        
                        <!-- Botão: Tornar Capa -->
                        @if(!$image->is_main)
                        <form action="{{ route('admin.product-images.set-main', $image->id) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full border border-[#c5a059] bg-transparent text-[#c5a059] px-4 py-3 text-[9px] font-bold uppercase tracking-widest hover:bg-[#c5a059] hover:text-black transition-colors">
                                Tornar Capa
                            </button>
                        </form>
                        @endif

                        <!-- Botão: Substituir Imagem -->
                        <form action="{{ route('admin.product-images.replace', $image->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                            @csrf
                            @method('PUT')
                            <label class="w-full block bg-white/5 border border-white/10 text-white px-4 py-3 text-[9px] uppercase tracking-widest hover:bg-white hover:text-black transition-colors text-center cursor-pointer">
                                Substituir Foto
                                <!-- O onchange faz o formulário ser enviado assim que a imagem for escolhida -->
                                <input type="file" name="image" class="hidden" onchange="this.form.submit()" accept="image/*">
                            </label>
                        </form>

                        <!-- Botão: Excluir -->
                        <form action="{{ route('admin.product-images.destroy', $image->id) }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Deseja apagar esta foto permanentemente?');" class="w-full bg-red-900/30 border border-red-500/30 text-red-400 px-4 py-3 text-[9px] uppercase tracking-widest hover:bg-red-600 hover:text-white transition-colors">
                                Excluir
                            </button>
                        </form>

                    </div>

                    <!-- Badge de Capa -->
                    @if($image->is_main)
                    <span class="absolute top-3 left-3 bg-[#c5a059] text-black text-[9px] px-3 py-1 font-bold uppercase tracking-widest shadow-lg z-10">Capa da Peça</span>
                    @endif
                </div>
                @endforeach
            </div>
            
        </div>
    </main>
</body>

</html>