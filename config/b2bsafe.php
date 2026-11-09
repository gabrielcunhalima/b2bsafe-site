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

    // Cards de serviços da Home (RF-001): chave de "servicos", texto e ícone Lucide.
    'vitrine' => [
        'credito' => ['descricao' => 'Menores taxas, sem burocracia e com bons prazos de pagamento.', 'icone' => 'hand-coins'],
        'conta_corrente' => ['descricao' => 'Conta grátis, Pix e saques ilimitados e até 100 TEDs gratuitos.', 'icone' => 'landmark'],
        'cambio' => ['descricao' => 'Boas cotações para enviar e receber recursos do exterior.', 'icone' => 'arrow-left-right'],
        'investimentos' => ['descricao' => 'CDB com liquidez diária e prazos de 6 meses a 3 anos.', 'icone' => 'trending-up'],
        'cartao' => ['descricao' => 'Sem anuidade, com as funções de crédito e débito.', 'icone' => 'credit-card'],
        'consorcio' => ['descricao' => 'As melhores ofertas adaptadas à necessidade da sua empresa.', 'icone' => 'key-round'],
        'seguros_previdencia' => ['descricao' => 'Proteção e planejamento adaptados ao seu bolso e à sua vida.', 'icone' => 'shield-check'],
    ],

    // Página Maquininha (RF-002): taxas de referência da C6 Pay. Valores do site oficial do C6,
    // consultados em 07/11/2026; a confirmar com a B2BSAFE (pendência no docs/ESTADO.md).
    'maquininha' => [
        'taxas_referencia_em' => '2026-11-07',
        'taxas' => [
            ['modalidade' => 'Débito', 'taxa' => '1,39%', 'recebimento' => '1 dia útil'],
            ['modalidade' => 'Crédito à vista', 'taxa' => '3,49%', 'recebimento' => '1 dia útil'],
            ['modalidade' => 'Crédito parcelado (2x a 12x)', 'taxa' => '2,79%', 'recebimento' => 'Conforme o plano'],
        ],
        'bandeiras' => ['Visa', 'Mastercard', 'Elo', 'Hipercard', 'American Express'],
    ],

    // Escritórios parceiros listados no credenciamento (RF-001).
    'escritorios_parceiros' => [
        ['nome' => 'Rosiane Mazzorana Ltda', 'cnpj' => '54.192.797/0001-03'],
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
