<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AiController;

// --- VITRINE PÚBLICA ---
Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/produto/{product}', [SiteController::class, 'show'])->name('product.show');

// --- REDIRECIONAMENTO BREEZE ---
Route::get('/dashboard', function () {
    return redirect()->route('admin.products.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- ÁREA ADMINISTRATIVA (PROTEGIDA) ---
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // CRUD de Produtos
    Route::resource('products', ProductController::class);

    // Rota da IA (Agora protegida e com nome admin.ai.describe)
    Route::post('/gerar-descricao-ia', [AiController::class, 'generateDescription'])->name('ai.describe');

    // Rota extra para apagar imagens
    Route::delete('product-images/{image}', [ProductController::class, 'destroyImage'])->name('product-images.destroy');
    
    // NOVAS ROTAS: Manipulação de imagens (Capa e Substituir)
    Route::patch('product-images/{image}/set-main', [ProductController::class, 'setMainImage'])->name('product-images.set-main');
    Route::put('product-images/{image}/replace', [ProductController::class, 'replaceImage'])->name('product-images.replace');
});

require __DIR__ . '/auth.php';