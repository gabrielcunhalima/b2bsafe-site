<?php

/*
 * Dados do negócio que mudam pouco e ficam no código (docs/06-modelo-de-dados.md).
 * Valores sensíveis ou por ambiente vêm do .env.
 */

return [

    // Serviços de interesse do formulário e do chatbot (RF-006).
    'servicos' => [
        'credito' => 'Crédito',
        'maquininha' => 'Maquininha C6 Pay',
        'conta_corrente' => 'Conta Corrente',
        'cambio' => 'Câmbio',
        'investimentos' => 'Investimentos',
        'cartao' => 'Cartão C6 Business',
        'consorcio' => 'Consórcio',
        'seguros_previdencia' => 'Seguros e Previdência',
        'parceria' => 'Parceria / trabalhe conosco',
        'outro' => 'Outro',
    ],

    // Números de WhatsApp por contexto, só dígitos com DDI (RN-021).
    'whatsapp' => [
        'geral' => env('WHATSAPP_GERAL', '5511984205023'),
        'maquininha' => env('WHATSAPP_MAQUININHA', '5511924600991'),
    ],

    // Versões dos documentos aceitos; mudar a versão reabre o banner de cookies (RN-011).
    'versoes' => [
        'politica_privacidade' => env('VERSAO_POLITICA_PRIVACIDADE', '1'),
        'aviso_chat' => env('VERSAO_AVISO_CHAT', '1'),
        'cookies' => env('VERSAO_COOKIES', '1'),
    ],

    // Destinatário dos avisos de novo lead (RF-007).
    'email_leads' => env('EMAIL_LEADS'),

    // Assistente virtual: webhook do n8n, só no servidor (RF-014).
    'chatbot' => [
        'url' => env('CHATBOT_N8N_URL'),
        'segredo' => env('CHATBOT_N8N_SEGREDO'),
        'tempo_limite' => (int) env('CHATBOT_TEMPO_LIMITE', 10),
    ],

    // Google Analytics 4 (RF-010).
    'ga4_id' => env('GA4_ID_MEDICAO'),

    // Fuso das datas exibidas; no banco tudo fica em UTC (RN-020).
    'fuso_exibicao' => env('APP_TIMEZONE_EXIBICAO', 'America/Sao_Paulo'),

];
