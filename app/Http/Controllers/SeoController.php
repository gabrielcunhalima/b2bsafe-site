<?php

namespace App\Http\Controllers;

use App\Support\Seo;
use Illuminate\Http\Response;

/** robots.txt por ambiente e sitemap.xml das páginas públicas (RF-011). */
class SeoController extends Controller
{
    public function robots(): Response
    {
        // Demonstração e homologação ficam inteiras fora dos buscadores
        $conteudo = app()->isProduction()
            ? "User-agent: *\nDisallow: /painel\nDisallow: /saude\nDisallow: /contato\nDisallow: /whatsapp/\nDisallow: /cookies/\n\nSitemap: ".route('sitemap')."\n"
            : "User-agent: *\nDisallow: /\n";

        return response($conteudo, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    public function sitemap(): Response
    {
        $atualizadoEm = [
            'privacidade' => config('b2bsafe.documentos.privacidade_atualizada_em'),
            'policy' => config('b2bsafe.documentos.policy_atualizada_em'),
        ];

        return response()
            ->view('seo.sitemap', ['paginas' => Seo::paginas(), 'atualizadoEm' => $atualizadoEm])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
