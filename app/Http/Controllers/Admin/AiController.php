<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function generateDescription(Request $request)
    {
        $nome = $request->nome;
        $categoria = $request->categoria;

        // Pega a chave gsk_ que você colocou no .env
        $key = env('GROQ_API_KEY');
        $url = "https://api.groq.com/openai/v1/chat/completions";

        // Prompt focado no luxo da boutique
        $prompt = "Atue como redator de moda de luxo. Escreva uma descrição sofisticada para a peça '{$nome}' da categoria '{$categoria}'. 
                   Destaque elegância italiana e exclusividade da Boutique Lucy Braga. 
                   Seja conciso (máximo 2 parágrafos).";

        try {
            $response = Http::withToken($key)
                ->withoutVerifying() // Essencial para rodar no XAMPP/Windows
                ->timeout(20)
                ->post($url, [
                    'model' => 'llama-3.3-70b-versatile',
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'temperature' => 0.7
                ]);

            if ($response->successful()) {
                $data = $response->json();
                // Extrai o texto no formato que a Groq/OpenAI envia
                $text = $data['choices'][0]['message']['content'] ?? 'Texto não gerado.';
                
                // Retorna como 'text' para o seu JavaScript ler corretamente
                return response()->json(['text' => $text]);
            }

            return response()->json([
                'status' => $response->status(),
                'RESPOSTA_BRUTA' => $response->json()
            ], 500);

        } catch (\Exception $e) {
            return response()->json(['text' => 'Erro de conexão: ' . $e->getMessage()], 500);
        }
    }
}