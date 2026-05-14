<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        // 1. Validação (Aumentei o max para 30MB para aceitar fotos pesadas que serão reduzidas)
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:30720' 
        ]);

        // 2. Criar o Produto (Apenas uma vez)
        $product = Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->has('is_active'),
            'brand' => $request->brand,
            'size' => $request->size,
            'discount_percent' => $request->discount_percent ?? 0,
        ]);

        // 3. Processar e Redimensionar Imagens
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                
                // Ler a imagem
                $img = Image::read($file);

                // Redimensionar para 1200px de largura mantendo a proporção
                $img->scale(width: 1200);

                // Gerar nome único
                $filename = time() . '_' . uniqid() . '.jpg';
                $path = 'products/' . $filename;

                // Salvar no storage/app/public/products com compressão
                // Certifique-se que a pasta 'products' existe em storage/app/public
                $img->toJpeg(80)->save(storage_path('app/public/' . $path));

                // Salvar referência no banco
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_main' => $index === 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Peça cadastrada e otimizada com sucesso!');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:30720',
        ]);

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->has('is_active'),
            'brand' => $request->brand,
            'size' => $request->size,
            'discount_percent' => $request->discount_percent ?? 0,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $img = Image::read($file);
                $img->scale(width: 1200);
                
                $filename = time() . '_' . uniqid() . '.jpg';
                $path = 'products/' . $filename;
                $img->toJpeg(80)->save(storage_path('app/public/' . $path));

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_main' => false,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produto atualizado!');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Removido com sucesso.');
    }

    public function destroyImage(ProductImage $image)
    {
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();
        return back()->with('success', 'Imagem removida!');
    }

    public function setMainImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // Remove o status de capa de todas as outras imagens deste produto
        ProductImage::where('product_id', $image->product_id)
            ->update(['is_main' => false]);

        // Define a imagem selecionada como capa
        $image->update(['is_main' => true]);

        return back()->with('success', 'A capa da peça foi atualizada!');
    }

    /**
     * Substitui uma imagem existente por uma nova sem alterar seu status de capa
     */
    public function replaceImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // Máx 5MB
        ]);

        $productImage = ProductImage::findOrFail($id);

        // Apaga a foto antiga do servidor
        if ($productImage->image_path && Storage::disk('public')->exists($productImage->image_path)) {
            Storage::disk('public')->delete($productImage->image_path);
        }

        // Faz o upload da nova foto
        $path = $request->file('image')->store('products', 'public');

        // Atualiza o caminho no banco de dados
        $productImage->update([
            'image_path' => $path
        ]);

        return back()->with('success', 'Fotografia substituída com sucesso!');
    }
}