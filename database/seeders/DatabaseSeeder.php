<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Cria a conta master da Lucy Braga
        User::factory()->create([
            'name' => 'Diretoria Lucy Braga',
            'email' => 'admin@email.com.br',
            'password' => Hash::make('senha'), 
        ]);
    }
}
