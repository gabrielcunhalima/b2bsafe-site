# Changelog

Todas as mudanças relevantes deste projeto são registradas aqui.

O formato segue o [Keep a Changelog](https://keepachangelog.com/pt-BR/1.1.0/) e o projeto usa [versionamento semântico](https://semver.org/lang/pt-BR/).

## [Unreleased]

### Alterado

- Carrossel da Home: troca de slide só pelas setas e pelos nomes (sem arrasto; no celular as setas ficam na barra de nomes); Cartão C6 Business com a foto oficial do cartão; Consórcio com foto de especialista conversando com cliente, chaves e fachada de casa; Crédito sem os cards de destaque.
- Topo da Home vira um carrossel dos 8 serviços (cada slide com título, foto e composição próprios) que ocupa a primeira tela, com a barra de nomes dos serviços; passa sozinho a cada 7 s (mesmo com o mouse em cima) até a pessoa trocar de slide e então fica travado; setas no meio da altura, nas bordas do slide (a partir do tablet). A hero antiga fica guardada (HOME_HERO_ANTIGA) e a seção Maquininha sai da Home (o menu leva a /maquininha).
- Cantos padrão do site: botões, chips, cards, campos e fotos usam o mesmo canto do "Fale conosco" do cabeçalho (4 px); só formas redondas de verdade continuam redondas.
- Preferências de cookies: descrição dos estatísticos passa a ser "Estatísticas para melhorar nosso atendimento".
- Política de Privacidade e Termos de Uso com o texto original de b2bsafe.com.br/policy, sem alterações; /privacidade redireciona para /policy.
- Maquininha: logos oficiais das bandeiras aceitas (sobem um pouco no hover) e marca-texto animado nas palavras-chave dos cards de vantagens.
- No celular, a hero mostra a foto logo depois do título e o Fale conosco mostra os canais oficiais do C6 depois do formulário.
- Cursor de mãozinha em todos os elementos clicáveis (botões, preferências de cookies, seletores e caixas de marcar).
- Maquininha com fundo preto em largura total e círculo amarelo sólido; serviços em cards amarelos numa linha só; "Como trabalhamos" em trilha de 3 passos.
- Credenciamento em seção própria, antes do Fale conosco, com os dois jeitos de conferir no C6 (lista oficial em PDF e página Parceiro C6 Empresas) e botão para copiar o CNPJ; canais oficiais do C6 dentro do Fale conosco.
- Home com identidade própria: a foto do topo vira o corpo de um cadeado com a alça amarela do logo; saem os cartões flutuantes e o marca-texto amarelo.
- Conta PJ com foto de empreendedora usando o celular no próprio negócio, no lugar da arte do C6; Sobre só com o selo Conexão Awards 2025, maior.
- Nada no site sobe, desce, cresce ou dá zoom (hover, imagens e aparição ao rolar); o hover dos cards e botões muda só a cor.
- Formulário de lead só acusa erros depois do clique em Enviar.
- Home mais fluida: fundo único, hero e seções Sobre + Conta PJ e Fale conosco + Credenciamento em largura total; serviços em cards pequenos clicáveis abaixo do topo; foto de aperto de mãos em arco; foco dos campos só com sombra suave.

### Adicionado

- Documentação da descoberta: visão, atores, 31 requisitos funcionais, 21 regras de negócio, 33 requisitos não funcionais, modelo de dados, stack, ADRs, MVP e backlog com 32 histórias.
- UX: mapa de navegação, wireframes de 19 telas e 2 e-mails, design system (cores do logo, fonte Urbanist, regras de interface).
- Estrutura do repositório: modelos de issue e PR, CODEOWNERS, Dependabot, guia de contribuição e política de segurança.
- Base técnica: Laravel 13, painel Filament 5 em `/painel` (login, redefinição de senha, notificações), Flowforge e ícones Lucide.
- Modelo de dados: migrations, models, enums, factories e seeders das 12 tabelas do domínio (docs/06-modelo-de-dados.md).
- Ambiente local em Docker: MariaDB 11.8, Mailpit, n8n, Qdrant e túnel cloudflared; aplicação opcional em container.
- Health check em `/saude` (aplicação, banco e fila), páginas de erro amigáveis, layout base com os tokens do design system e fonte Urbanist local, logs em JSON.
- Traduções do Laravel em português (pt_BR) e factories de todas as tabelas do domínio.
- Layout base do site (#1): cabeçalho fixo com menu por âncoras e item da seção visível marcado, menu móvel em tela cheia (Esc fecha e o foco volta ao botão), rodapé com as duas empresas, contato, redes sociais atuais, links legais, preferências de cookies e aviso de parceiro C6 (RN-015).
- Ajustes da revisão do layout: formatação de telefones testada, aviso de link em nova aba, área de toque mínima nos links legais e item ativo também no menu do celular.
- Home institucional (#2): apresentação, 7 cards de serviço que abrem o WhatsApp citando o serviço, seção própria da Maquininha C6 Pay com o WhatsApp da maquininha, Sobre com o selo Conexão Awards 2025, Parcerias, Fale conosco, Credenciamento e Canais oficiais C6. Links de WhatsApp montados por `App\Support\WhatsApp` (RN-021) e marcados para o registro de clique (#11).
- Logo da B2BSAFE no cabeçalho e no menu do celular, versão clara no rodapé, imagem do selo Conexão Awards 2025 na seção Sobre e imagem da C6 Pay na seção Maquininha (originais em `docs/marca/`).
- Captação de leads (#7, #8, #9, #10, #11):
  - origem do visitante pelo primeiro toque (UTM, gclid, fbclid, referrer), classificada pela RN-008 e guardada conforme o consentimento (RN-009);
  - formulário de lead no Fale conosco, com validação no navegador e no servidor, máscara de WhatsApp, estados de erro, envio, falha e sucesso, armadilha para robôs e limite de 5 envios por hora (RN-001, RN-002, RN-011, RN-016);
  - deduplicação de 30 dias pelo WhatsApp ou e-mail (RN-003);
  - e-mail de novo lead e de "voltou a entrar em contato" pela fila;
  - registro dos cliques no WhatsApp por sendBeacon e botão flutuante (RN-010).
- Página Maquininha C6 Pay (#3): vantagens, tabela de taxas em configuração com data de referência e aviso do C6, condições, bandeiras e o formulário com o serviço Maquininha; todo o conteúdo usa o WhatsApp da maquininha (RN-021).
- Página 404 amigável (#6) com links para a Home, a Maquininha, o formulário e o WhatsApp.
- Política de Privacidade do site em `/privacidade` (#4), com versão e data em configuração, e `/policy` do B2BSafe Connect (#5) com as numerações corrigidas e 301 de `/policy.`; layout comum das páginas legais com índice.
- Banner e preferências de cookies (#12): faixa no rodapé com "Recusar" e "Aceitar todos" de mesmo peso, diálogo "Personalizar", registro da escolha com versão e categorias (RN-011), cookie de 12 meses e reabertura pelo rodapé.
- GA4 com Consent Mode v2 no modo básico (#13): o script do Google só carrega depois do aceite estatístico; eventos `generate_lead` e `click_whatsapp`; desligado nos ambientes local e de teste.
- SEO técnico (#39): título e descrição por página, URL canônica, Open Graph e Twitter Card com imagem de 1200 × 630, dados estruturados FinancialService com os dois endereços, `sitemap.xml`, `robots.txt` por ambiente, `noindex` no painel e preload da fonte. Lighthouse mobile (produção simulada): SEO, acessibilidade e boas práticas 100 nas quatro páginas.
- Seção "Conta PJ" na Home com a arte "Abra sua conta PJ no C6 Bank", topo preparado para a foto de pagamento com a C6 Pay, logo B2BSAFE com C6 Empresas no rodapé, Instagram @b2bsafefloripa e verificação de credenciamento pelo PDF oficial de escritórios parceiros do C6.
- Repaginada visual da Home: topo com foto e cartões flutuantes, faixa de confiança, serviços em mosaico com destaque em foto, seção "Como a B2BSAFE trabalha com você", Sobre com foto e selo, Parcerias com fotos, Fale conosco em fundo escuro, textura de pontos, marca-texto amarelo, botões arredondados e blocos que aparecem ao rolar (desligados com movimento reduzido). Fotos do Unsplash com licença registrada em `docs/marca/fotos-licencas.md`.
- Qualidade: Pint, Larastan (nível 6), Pest 5 com testes no navegador, Lefthook (formatação e Conventional Commits) e hook de formatação do Claude Code.
