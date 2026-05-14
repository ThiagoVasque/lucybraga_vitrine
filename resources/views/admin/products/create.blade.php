<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Peça | Lucy Braga Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            <h1 class="font-display text-4xl italic text-white mb-2">Adicionar <span class="text-[#c5a059]">Peça</span></h1>
            <p class="text-[10px] uppercase tracking-[0.3em] text-gray-500">Insira os detalhes e a categoria da nova peça</p>
        </header>

        <form action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-[#111111] border border-[#c5a059]/10 p-8 shadow-2xl space-y-8"
            x-data="{ price: 0, discount: 0 }">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="md:col-span-2">
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-2">Nome da Peça *</label>
                    <input type="text" name="name" required class="w-full bg-transparent border-b border-gray-700 pb-2 text-white focus:outline-none focus:border-[#c5a059]" placeholder="Ex: Vestido Milano Noir">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-2">Categoria *</label>
                    <select name="category" required class="w-full bg-[#0a0a0a] border-b border-gray-700 pb-2 text-white focus:outline-none focus:border-[#c5a059] p-2 cursor-pointer">
                        <option value="Roupas">Roupas</option>
                        <option value="Sapatos">Sapatos</option>
                        <option value="Bolsas">Bolsas</option>
                        <option value="Acessórios">Acessórios</option>
                        <option value="Óculos">Óculos</option>
                        <option value="Cintos">Cintos</option>
                    </select>
                </div>

                <div class="flex items-center md:justify-end">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#c5a059]"></div>
                        <span class="ml-3 text-[10px] uppercase tracking-[0.2em] text-gray-400">Ativo na Vitrine</span>
                    </label>
                </div>

                <div class="p-6 bg-[#0a0a0a] border border-[#c5a059]/5 space-y-6 md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                    <div>
                        <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-2">Valor Original (R$) *</label>
                        <input type="number" step="0.01" name="price" x-model="price" required class="w-full bg-transparent border-b border-gray-700 pb-2 text-white focus:outline-none focus:border-[#c5a059]" placeholder="0.00">
                    </div>

                    <div>
                        <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-2">Desconto (%)</label>
                        <input type="number" name="discount_percent" x-model="discount" min="0" max="100" class="w-full bg-transparent border-b border-gray-700 pb-2 text-white focus:outline-none focus:border-[#c5a059]" placeholder="0">
                    </div>

                    <div class="text-right border-l border-gray-800 pl-6">
                        <p class="text-[9px] uppercase tracking-widest text-gray-500 mb-1">Preço Final com Desconto</p>
                        <p class="text-2xl font-display italic text-[#c5a059]">
                            R$ <span x-text="(price - (price * (discount / 100))).toFixed(2).replace('.', ',')"></span>
                        </p>
                    </div>
                </div>
            </div>

            <div x-data="{ 
    loading: false,
    async gerarDescricao() {
        const nome = document.getElementsByName('name')[0].value;
        const categoria = document.getElementsByName('category')[0].value;
        
        if(!nome) { alert('Por favor, digite o nome da peça primeiro.'); return; }
        this.loading = true;
        
        try {
            const response = await fetch('/admin/gerar-descricao-ia', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ nome, categoria })
            });
            
            const data = await response.json();
            
            if (data.text) {
                document.getElementsByName('description')[0].value = data.text;
            } else {
                // Se não vier .text, mostra o erro real no console e um alerta
                console.error('Erro detalhado da IA:', data);
                alert('Erro da IA: ' + (data.RESPOSTA_BRUTA?.error?.message || 'Verifique o console (F12)'));
            }
        } catch (error) {
            alert('Erro de conexão com o servidor.');
        } finally {
            this.loading = false;
        }
    }
}">
                <div class="flex justify-between items-center mb-2">
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059]">Descrição / Destaques</label>

                    <button type="button" @click="gerarDescricao()" :disabled="loading"
                        class="flex items-center gap-2 text-[9px] uppercase tracking-widest text-[#c5a059] border border-[#c5a059]/30 px-3 py-1 hover:bg-[#c5a059] hover:text-black transition-all disabled:opacity-50">
                        <template x-if="!loading">
                            <div class="flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Gerar com IA
                            </div>
                        </template>
                        <template x-if="loading">
                            <div class="flex items-center gap-2 italic">
                                <svg class="animate-spin h-3 w-3 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Escrevendo...
                            </div>
                        </template>
                    </button>
                </div>

                <textarea name="description" rows="5"
                    class="w-full bg-[#0a0a0a] border border-gray-700 p-4 text-white focus:outline-none focus:border-[#c5a059] resize-none text-sm leading-relaxed placeholder-gray-800"
                    placeholder="Clique em 'Gerar com IA' para uma descrição luxuosa automática..."></textarea>
            </div>

            <div class="pt-4 border-t border-[#c5a059]/10" x-data="{ 
                previews: [],
                handleFiles(event) {
                    const files = Array.from(event.target.files);
                    files.forEach(file => {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.previews.push({
                                url: e.target.result,
                                name: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                },
                removeImage(index) {
                    this.previews.splice(index, 1);
                    // Nota: Para remover do input real é mais complexo, 
                    // mas visualmente ajuda o admin a decidir antes do submit.
                }
            }">
                <label class="block text-[10px] uppercase tracking-[0.2em] text-[#c5a059] mb-4">Fotos da Peça *</label>

                <div class="relative w-full border-2 border-dashed border-gray-800 hover:border-[#c5a059]/30 transition-colors p-10 text-center mb-6">
                    <input name="images[]" type="file" multiple accept="image/*" required
                        @change="handleFiles"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />

                    <svg class="w-8 h-8 text-[#c5a059]/40 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-[10px] uppercase tracking-widest text-gray-500">Arraste as fotos ou clique para selecionar</p>
                </div>

                <template x-if="previews.length > 0">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <template x-for="(image, index) in previews" :key="index">
                            <div class="relative group aspect-[3/4] border border-gray-800 overflow-hidden bg-black">
                                <img :src="image.url" class="w-full h-full object-cover grayscale-[30%] group-hover:grayscale-0 transition-all duration-500">

                                <button type="button" @click="removeImage(index)"
                                    class="absolute top-2 right-2 bg-red-900/80 text-white p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>

                                <div class="absolute bottom-0 left-0 w-full bg-black/60 py-1 px-2 text-[8px] truncate text-gray-400" x-text="image.name"></div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <div class="pt-6 flex justify-end">
                <button type="submit" class="bg-[#c5a059] text-black font-semibold text-[11px] uppercase tracking-widest px-12 py-5 hover:bg-white transition-all shadow-[0_10px_20px_rgba(197,160,89,0.2)]">Cadastrar Peça na Vitrine</button>
            </div>
        </form>
    </main>
</body>

</html>