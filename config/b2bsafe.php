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
        'instagram' => ['rotulo' => 'Instagram', 'url' => 'https://www.instagram.com/b2bsafefloripa/'],
        'facebook' => ['rotulo' => 'Facebook', 'url' => 'https://www.facebook.com/b2bsafe/'],
    ],

    // Canais oficiais do C6 Bank exibidos no aviso de parceiro (RN-015).
    'canais_c6' => [
        'SAC 24h' => '0800 660 0060',
        'Central' => '3003 6116',
        'Ouvidoria' => '0800 660 6060',
        'E-mail' => 'faleconosco@c6bank.com.br',
    ],

    // Lista oficial (PDF) de escritórios parceiros do C6 Empresas, para o visitante conferir o credenciamento (RF-001).
    'verificacao_c6' => 'https://cms-assets-p.c6bank.com.br/uploads/escritorios-parceiros-c6-empresas.pdf',

    // Página "Parceiro C6 Empresas" do site do C6 Bank, com a área de consulta de escritórios autorizados (link do site antigo).
    'verificacao_c6_pagina' => 'https://www.c6bank.com.br/parceiro-c6-empresas/',

    // Versões dos documentos aceitos; mudar a versão reabre o banner de cookies (RN-011).
    'versoes' => [
        'politica_privacidade' => env('VERSAO_POLITICA_PRIVACIDADE', '1'),
        'aviso_chat' => env('VERSAO_AVISO_CHAT', '1'),
        'cookies' => env('VERSAO_COOKIES', '1'),
    ],

    // Datas da última atualização exibidas nas páginas legais (RF-003, RF-004).
    'documentos' => [
        'privacidade_atualizada_em' => env('PRIVACIDADE_ATUALIZADA_EM', '2026-11-09'),
        'policy_atualizada_em' => env('POLICY_ATUALIZADA_EM', '2026-11-09'),
    ],

    // Encarregado de Proteção de Dados (DPO), citado na Política de Privacidade (RF-003).
    'email_encarregado' => env('EMAIL_ENCARREGADO', 'ti@b2bsafe.com.br'),

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

    // Home: a hero antiga ("Sua empresa em boas mãos.", foto em arco) fica guardada no código e só aparece com true.
    // A hero atual é o carrossel de serviços (resources/views/paginas/inicio/carrossel-servicos.blade.php).
    'home' => [
        'hero_antiga' => (bool) env('HOME_HERO_ANTIGA', false),
    ],

    // Slides do carrossel de serviços da Home: título (a parte entre ** fica amarela), 3 destaques e foto.
    // Textos só com o que o site antigo e o atual já dizem; fotos e licenças em docs/marca/fotos-licencas.md.
    'carrossel' => [
        'credito' => [
            'titulo' => 'Crédito: **menores taxas, sem burocracia.**',
            'texto' => 'Para o equilíbrio financeiro da sua empresa, com o crédito do C6 Empresas e o acompanhamento da B2BSAFE.',
            'destaques' => [],
            'imagem' => 'img/servicos/credito.webp',
            'alt' => 'Dois empresários conversando sobre números num notebook, numa mesa de reunião',
        ],
        'maquininha' => [
            'titulo' => 'Maquininha C6 Pay: **venda mais, pague menos.**',
            'texto' => 'Receba no débito, no crédito à vista ou parcelado e no Pix, na maquininha ou on-line com o link de pagamento.',
            'destaques' => [['calendar-clock', 'Parcele em até 12x e receba em até 2 dias úteis'], ['wifi', 'Chip e plano de dados grátis, e funciona também no Wi-Fi'], ['shuffle', 'A máquina escolhe a bandeira com a melhor taxa']],
            'imagem' => 'img/maquininha-c6-pay.webp',
            'alt' => 'Maquininha C6 Pay com tela de pagamento e teclado, aceitando Elo, Mastercard, Hipercard e Visa',
        ],
        'conta_corrente' => [
            'titulo' => 'Conta PJ **grátis e completa.**',
            'texto' => 'Abra a conta da sua empresa no C6 Bank com quem entende do C6: a B2BSAFE acompanha do primeiro contato à conta funcionando.',
            'destaques' => [['badge-percent', 'Conta grátis'], ['zap', 'Pix e saques ilimitados'], ['arrow-left-right', 'Até 100 TEDs gratuitos']],
            'imagem' => 'img/servicos/conta-corrente.webp',
            'alt' => 'Empreendedora sorrindo enquanto usa o celular na mesa do escritório',
        ],
        'cambio' => [
            'titulo' => 'Câmbio com **as melhores cotações.**',
            'texto' => 'Cotações oferecidas pelo C6 Bank e por parceiros para enviar e receber recursos do exterior, em sistema de marketplace.',
            'destaques' => [['globe', 'Envio ao exterior'], ['arrow-left-right', 'Recebimento do exterior'], ['store', 'Marketplace de cotações']],
            'imagem' => 'img/servicos/cambio.webp',
            'alt' => 'Mão segurando notas de euro e de dólar',
        ],
        'investimentos' => [
            'titulo' => 'Investimentos: **seu dinheiro rendendo.**',
            'texto' => 'CDB, um título de renda fixa: um crédito privado em que você é remunerado com juros.',
            'destaques' => [['droplet', 'Liquidez diária'], ['landmark', 'Renda fixa'], ['calendar-range', 'Prazos de 6 meses a 3 anos']],
            'imagem' => 'img/servicos/investimentos.webp',
            'alt' => 'Dois homens de terno conversando no escritório, um apresentando uma proposta ao outro',
        ],
        'cartao' => [
            'titulo' => 'Cartão C6 Business **sem anuidade.**',
            'texto' => 'O cartão da sua empresa sem tarifas, com isenção de anuidade para sempre.',
            'destaques' => [['badge-percent', 'Sem tarifas'], ['infinity', 'Anuidade zero para sempre'], ['credit-card', 'Crédito e débito']],
            'imagem' => 'img/servicos/cartao.webp',
            'alt' => 'Cartão C6 Business preto, da Mastercard, ao lado do logo do C6 Bank',
        ],
        'consorcio' => [
            'titulo' => 'Consórcio: **o bem da sua empresa, planejado.**',
            'texto' => 'O C6 Bank atua nesse segmento e busca as melhores ofertas do mercado, adaptadas à necessidade da sua empresa.',
            'destaques' => [['search-check', 'Melhores ofertas do mercado'], ['sliders-horizontal', 'Adaptado à necessidade da empresa'], ['user-round-check', 'Um especialista indica a melhor opção']],
            'imagem' => 'img/servicos/consorcio-conversa.webp',
            'alt' => 'Especialista conversando com um cliente numa mesa de reunião',
            'imagem_2' => 'img/servicos/consorcio-imovel.webp',
            'alt_2' => 'Mão segurando chaves sobre miniaturas de casas',
            'imagem_3' => 'img/servicos/consorcio-casa.webp',
            'alt_3' => 'Fachada de uma casa moderna com jardim',
        ],
        'seguros_previdencia' => [
            'titulo' => 'Seguros e previdência **para o seu bolso e a sua vida.**',
            'texto' => 'Consulte as melhores ofertas de proteção e planejamento, adaptadas ao seu momento.',
            'destaques' => [['shield-check', 'Proteção'], ['piggy-bank', 'Previdência'], ['wallet', 'Adaptado ao seu bolso']],
            'imagem' => 'img/servicos/seguros.webp',
            'alt' => 'Criança abraçando a mãe ao ar livre, ao pôr do sol',
        ],
    ],

    // Fuso das datas exibidas; no banco tudo fica em UTC (RN-020).
    'fuso_exibicao' => env('APP_TIMEZONE_EXIBICAO', 'America/Sao_Paulo'),

];
