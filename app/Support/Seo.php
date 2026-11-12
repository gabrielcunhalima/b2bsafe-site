<?php

namespace App\Support;

/**
 * SEO técnico (RF-011): páginas do sitemap e dados estruturados da empresa (schema.org).
 */
final class Seo
{
    /**
     * Páginas públicas indexáveis, com a rota e a prioridade no sitemap.
     *
     * @return list<array{rota: string, prioridade: string, frequencia: string}>
     */
    public static function paginas(): array
    {
        return [
            ['rota' => 'inicio', 'prioridade' => '1.0', 'frequencia' => 'weekly'],
            ['rota' => 'maquininha', 'prioridade' => '0.8', 'frequencia' => 'monthly'],
            ['rota' => 'privacidade', 'prioridade' => '0.3', 'frequencia' => 'yearly'],
            ['rota' => 'policy', 'prioridade' => '0.2', 'frequencia' => 'yearly'],
        ];
    }

    /**
     * FinancialService com os dois endereços (um LocalBusiness por empresa) e os contatos.
     *
     * @return array<string, mixed>
     */
    public static function dadosEstruturados(): array
    {
        $enderecos = [
            ['rua' => 'Av. Marechal Castelo Branco, 65', 'cidade' => 'São José', 'uf' => 'SC', 'cep' => '88101-020'],
            ['rua' => 'Rua Peruíbe, 397', 'cidade' => 'Vinhedo', 'uf' => 'SP', 'cep' => '13287-140'],
        ];
        $empresas = config('b2bsafe.empresas');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FinancialService',
            'name' => 'B2BSAFE',
            'description' => 'Escritório parceiro C6 Empresas: conta PJ, crédito, maquininha C6 Pay, câmbio, investimentos, consórcio e seguros.',
            'url' => route('inicio'),
            'logo' => asset('img/b2bsafe-logo.webp'),
            'image' => asset('img/og-b2bsafe.jpg'),
            'email' => config('b2bsafe.email_contato'),
            'telephone' => '+'.config('b2bsafe.whatsapp.geral'),
            'areaServed' => 'BR',
            'sameAs' => array_values(array_map(fn (array $rede) => $rede['url'], config('b2bsafe.redes_sociais'))),
            'address' => array_map(fn (array $e) => [
                '@type' => 'PostalAddress',
                'streetAddress' => $e['rua'],
                'addressLocality' => $e['cidade'],
                'addressRegion' => $e['uf'],
                'postalCode' => $e['cep'],
                'addressCountry' => 'BR',
            ], $enderecos),
            'subOrganization' => array_map(fn (array $empresa, array $e) => [
                '@type' => 'LocalBusiness',
                'name' => $empresa['nome'],
                'taxID' => $empresa['cnpj'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $e['rua'],
                    'addressLocality' => $e['cidade'],
                    'addressRegion' => $e['uf'],
                    'postalCode' => $e['cep'],
                    'addressCountry' => 'BR',
                ],
            ], $empresas, $enderecos),
        ];
    }
}
