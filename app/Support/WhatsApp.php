<?php

namespace App\Support;

/**
 * Links do WhatsApp com mensagem pronta por contexto (RN-021).
 * O número vem de config('b2bsafe.whatsapp'): "geral" ou "maquininha".
 */
final class WhatsApp
{
    public const MENSAGEM_GERAL = 'Olá! Vim pelo site da B2BSAFE.';

    /** Link wa.me do contexto ("geral" ou "maquininha") com a mensagem informada. */
    public static function link(string $contexto = 'geral', ?string $mensagem = null): string
    {
        $numero = config("b2bsafe.whatsapp.{$contexto}") ?? config('b2bsafe.whatsapp.geral');

        return 'https://wa.me/'.$numero.'?text='.rawurlencode($mensagem ?? self::MENSAGEM_GERAL);
    }

    /** Mensagem que cita o serviço de origem (RN-021). */
    public static function mensagemDoServico(string $servico): string
    {
        $nome = config("b2bsafe.servicos.{$servico}", $servico);

        return "Olá! Vim pelo site e quero saber sobre {$nome}.";
    }

    /** Link do serviço: a maquininha usa o número próprio (RN-021). */
    public static function linkDoServico(string $servico): string
    {
        $mensagem = $servico === 'maquininha'
            ? 'Olá! Vim pelo site e quero saber sobre a maquininha C6 Pay.'
            : self::mensagemDoServico($servico);

        return self::link($servico === 'maquininha' ? 'maquininha' : 'geral', $mensagem);
    }
}
