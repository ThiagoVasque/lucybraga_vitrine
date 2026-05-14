<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('brand')->nullable()->after('category'); // Marca do produto
        $table->string('size')->nullable()->after('brand');     // Tamanhos (ex: P, M, G, 38, Único)
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['brand', 'size']);
    });
}
};
