<?php

namespace App\Actions;

/**
 * Classifica o canal de origem do primeiro toque, na ordem de prioridade da RN-008.
 *
 * @phpstan-type Toque array{utm_source?: ?string, utm_medium?: ?string, utm_campaign?: ?string, gclid?: ?string, fbclid?: ?string, referrer?: ?string}
 */
class ClassificarCanal
{
    private const MIDIA_PAGA = ['cpc', 'ppc', 'paid', 'ads'];

    private const FONTES_META = ['facebook', 'instagram', 'fb', 'ig', 'meta'];

    private const BUSCADORES = ['google.', 'bing.', 'yahoo.', 'duckduckgo.', 'ecosia.', 'yandex.', 'baidu.', 'search.brave.'];

    private const REDES_SOCIAIS = ['facebook.', 'instagram.', 'linkedin.', 'lnkd.in', 't.co', 'twitter.', 'x.com', 'youtube.', 'tiktok.', 'pinterest.', 'whatsapp.', 'threads.'];

    /**
     * @param  Toque  $toque
     * @param  string|null  $hostProprio  host do site, para ignorar o referrer interno
     */
    public function executar(array $toque, ?string $hostProprio = null): string
    {
        $fonte = $this->texto($toque['utm_source'] ?? null);
        $midia = $this->texto($toque['utm_medium'] ?? null);
        $campanha = $this->texto($toque['utm_campaign'] ?? null);

        if ($this->texto($toque['gclid'] ?? null) !== null) {
            return 'Google Ads';
        }

        $midiaPaga = $midia !== null && in_array(mb_strtolower($midia), self::MIDIA_PAGA, true);

        if ($this->texto($toque['fbclid'] ?? null) !== null
            || ($midiaPaga && $fonte !== null && in_array(mb_strtolower($fonte), self::FONTES_META, true))) {
            return 'Meta Ads';
        }

        if ($midiaPaga) {
            return 'Mídia paga ('.($fonte ?? 'sem fonte').')';
        }

        if ($fonte !== null || $midia !== null || $campanha !== null) {
            return 'Campanha ('.($fonte ?? 'sem fonte').' / '.($midia ?? 'sem mídia').')';
        }

        $host = $this->host($toque['referrer'] ?? null);

        if ($host === null || ($hostProprio !== null && $host === $this->semWww(mb_strtolower($hostProprio)))) {
            return 'Direto';
        }

        if ($this->contem($host, self::BUSCADORES)) {
            return 'Busca orgânica';
        }

        if ($this->contem($host, self::REDES_SOCIAIS)) {
            return 'Redes sociais';
        }

        return mb_substr("Referência ({$host})", 0, 100);
    }

    private function texto(?string $valor): ?string
    {
        $valor = $valor === null ? null : trim($valor);

        return $valor === '' ? null : $valor;
    }

    private function host(?string $referrer): ?string
    {
        $host = $referrer ? parse_url($referrer, PHP_URL_HOST) : null;

        return is_string($host) && $host !== '' ? $this->semWww(mb_strtolower($host)) : null;
    }

    private function semWww(string $host): string
    {
        return str_starts_with($host, 'www.') ? substr($host, 4) : $host;
    }

    /** @param  list<string>  $dominios */
    private function contem(string $host, array $dominios): bool
    {
        foreach ($dominios as $dominio) {
            if (str_starts_with($host, $dominio) || str_contains($host, '.'.$dominio) || $host === rtrim($dominio, '.')) {
                return true;
            }
        }

        return false;
    }
}
