<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with('images');

        // Filtro de Categoria
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        // Filtro Múltiplo de Marcas (Checkbox)
        if ($request->filled('brand')) {
            $query->whereIn('brand', (array) $request->brand);
        }

        // Filtro Múltiplo de Tamanhos (Busca dentro da string, já que você cadastra "P, M, G")
        if ($request->filled('size')) {
            $sizes = (array) $request->size;
            $query->where(function($q) use ($sizes) {
                foreach($sizes as $size) {
                    $q->orWhere('size', 'like', '%' . $size . '%');
                }
            });
        }

        // Filtro de Faixa de Preço
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Ordenação (Mais novos, Maior/Menor Preço)
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();

        // Pegar valores únicos para desenhar o menu lateral
        $brands = Product::where('is_active', true)->whereNotNull('brand')->where('brand', '!=', '')->distinct()->pluck('brand');
        
        // Extrai tamanhos únicos mesmo se estiverem salvos como "P, M, G"
        $allSizes = Product::where('is_active', true)->whereNotNull('size')->pluck('size');
        $sizes = collect();
        foreach($allSizes as $sizeString) {
            $exploded = array_map('trim', explode(',', $sizeString));
            $sizes = $sizes->merge($exploded);
        }
        $sizes = $sizes->unique()->filter()->values();

        return view('welcome', compact('products', 'brands', 'sizes'));
    }

    public function show(Product $product)
    {
        $product->load('images');
        return view('product-details', compact('product'));
    }
}