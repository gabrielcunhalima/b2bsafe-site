<?php

namespace App\Actions;

use App\Models\CliqueWhatsapp;
use App\Models\Origem;

/**
 * Conta um clique no WhatsApp com a página, o serviço e a origem. Clique não é lead (RN-010).
 */
class RegistrarCliqueWhatsapp
{
    public function executar(string $numero, ?string $pagina, ?string $servico, ?Origem $origem): CliqueWhatsapp
    {
        return CliqueWhatsapp::create([
            'numero' => $numero,
            'pagina' => $pagina !== null ? mb_substr($pagina, 0, 2048) : null,
            'servico' => $servico,
            'origem_id' => $origem?->id,
        ]);
    }
}
