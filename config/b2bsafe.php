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

    // Dados institucionais do rodapé e do credenciamento (RF-001, RN-015).
    'empresas' => [
        [
            'nome' => 'B2BSAFE Floripa Ltda',
            'cnpj' => '58.358.780/0001-26',
            'endereco' => 'Av. Marechal Castelo Branco, 65',
            'cidade' => 'São José (SC) · 88101-020',
        ],
        [
            'nome' => 'B2BSafe Consulting Partners Ltda',
            'cnpj' => '41.708.313/0001-86',
            'endereco' => 'Rua Peruíbe, 397',
            'cidade' => 'Vinhedo (SP) · 13287-140',
        ],
    ],

    // E-mail público de contato; o domínio definitivo entra só por configuração.
    'email_contato' => env('EMAIL_CONTATO', 'contato@b2bsafe.com.br'),

    // Redes sociais atuais da B2BSAFE (sem os perfis antigos "Connect Partners").
    'redes_sociais' => [
        'linkedin' => ['rotulo' => 'LinkedIn', 'url' => 'https://www.linkedin.com/company/b2bsafe-consulting/'],
        'instagram' => ['rotulo' => 'Instagram', 'url' => 'https://www.instagram.com/b2b_bancos/'],
        'facebook' => ['rotulo' => 'Facebook', 'url' => 'https://www.facebook.com/b2bsafe/'],
    ],

    // Canais oficiais do C6 Bank exibidos no aviso de parceiro (RN-015).
    'canais_c6' => [
        'SAC 24h' => '0800 660 0060',
        'Central' => '3003 6116',
        'Ouvidoria' => '0800 660 6060',
        'E-mail' => 'faleconosco@c6bank.com.br',
    ],

    // Página oficial de parceiros do C6, para o visitante conferir o credenciamento (RF-001).
    'verificacao_c6' => 'https://www.c6bank.com.br/parceiro-c6-empresas/',

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
