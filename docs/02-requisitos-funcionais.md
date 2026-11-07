# 02 — Requisitos funcionais

Prioridade MoSCoW: **must** (indispensável para a demonstração), **should** (importante, entra se o prazo permitir), **could** (desejável), **won't** (fora desta versão).

## Site público

### RF-001 — Home institucional
- **Ator:** Visitante · **Prioridade:** must
- **Descrição:** página única com as seções Apresentação, Serviços (7 cards: Crédito, Conta Corrente, Câmbio, Investimentos, Cartão C6, Consórcio, Seguros e Previdência), Maquininha C6 Pay (seção própria com a imagem da máquina, texto de chamada, WhatsApp (11) 92460-0991 e link para `/maquininha`), Sobre a B2BSAFE (com o selo Conexão Awards 2025), Parcerias / Trabalhe conosco, Fale conosco (formulário), Credenciamento (CNPJs e verificação no C6) e Canais oficiais C6, além do aviso legal de parceiro.
- **Critérios de aceite:**
  - [ ] Cada item do menu leva à seção correspondente (âncoras funcionando, com rolagem suave).
  - [ ] Cada card de serviço mostra "Fale com um atendente" (no hover e no foco; no celular, sempre visível) e, ao ser clicado, abre o WhatsApp com a mensagem pronta citando o serviço (RN-021). O clique é registrado como clique no WhatsApp com o serviço (RN-010).
  - [ ] O formulário do Fale conosco continua disponível na seção própria, com o seletor de serviço.
  - [ ] O link "Verificar no C6 Bank" aponta para a página oficial de parceiros do C6.
  - [ ] Conteúdo revisado a partir de `conteudo/www.b2bsafe.com.br.md`, sem os erros listados lá.

### RF-002 — Página Maquininha (C6 Pay)
- **Ator:** Visitante · **Prioridade:** must
- **Descrição:** página `/maquininha` com vantagens, tabela de taxas (débito, crédito à vista e parcelado; valores em configuração, com a data de referência e o aviso de que estão sujeitas a análise do C6), condições, adquirentes, chamada para pedir a maquininha (formulário com o serviço "Maquininha") e WhatsApp específico (11) 92460-0991.
- **Critérios de aceite:**
  - [ ] Os botões "Quero minha C6 Pay" e "Abrir conta grátis" levam ao formulário ou ao WhatsApp, nunca a uma página inexistente.
  - [ ] O WhatsApp desta página usa o número (11) 92460-0991.

### RF-003 — Política de Privacidade do site
- **Ator:** Visitante · **Prioridade:** must
- **Descrição:** página `/privacidade` cobrindo o formulário, o chatbot (IA processada pela Mistral, na França), os cookies e o GA4, a retenção de 24 meses, os direitos do titular e o contato do encarregado (ti@b2bsafe.com.br).
- **Critérios de aceite:**
  - [ ] Link no rodapé, no banner de cookies, no formulário e no aviso do chat.
  - [ ] Numeração de seções correta e data da última atualização visível.

### RF-004 — Política e Termos do B2BSafe Connect
- **Ator:** Visitante · **Prioridade:** must
- **Descrição:** manter `/policy` com o texto atual do B2BSafe Connect (exigido pela Meta), corrigindo a numeração das seções e o link quebrado `/policy.`.
- **Critérios de aceite:**
  - [ ] `/policy` responde 200 com o mesmo conteúdo jurídico, já com as correções.
  - [ ] `/policy.` redireciona (301) para `/policy`.

### RF-005 — Botões de WhatsApp
- **Ator:** Visitante · **Prioridade:** must
- **Descrição:** botão flutuante e chamadas para ação que abrem o WhatsApp (`wa.me`) com mensagem pronta citando a página ou o serviço. Número geral: (11) 98420-5023; Maquininha: (11) 92460-0991.
- **Critérios de aceite:**
  - [ ] Links no formato `https://wa.me/55DDDNUMERO?text=...`, sem DDI duplicado.
  - [ ] Cada clique é registrado no banco (canal "whatsapp", com a origem do visitante) e, havendo consentimento, enviado ao GA4 como evento.
  - [ ] Os números ficam em configuração, não espalhados no código.

### RF-006 — Formulário de lead
- **Ator:** Visitante · **Prioridade:** must
- **Descrição:** campos nome, WhatsApp, e-mail, serviço de interesse (os 8 serviços, "Parceria / trabalhe conosco" e "Outro"), mensagem (opcional) e aceite da Política de Privacidade.
- **Critérios de aceite:**
  - [ ] Validação no navegador e no servidor, com mensagens em português e acessíveis.
  - [ ] Proteção anti-spam sem atrito (honeypot e limite de envios por IP); sem CAPTCHA visível.
  - [ ] Ao enviar, o lead é gravado com status "Novo", canal "formulário" e a origem (RF-008); o visitante vê uma confirmação com opção de seguir pelo WhatsApp.
  - [ ] O aceite da política fica registrado com data, hora e versão da política.

### RF-007 — Notificação de novo lead por e-mail
- **Ator:** Sistema · **Prioridade:** must
- **Descrição:** cada lead novo (formulário ou chatbot) envia e-mail para o endereço configurado, com os dados, a origem e um link para a ficha.
- **Critérios de aceite:**
  - [ ] O destinatário e o SMTP vêm do `.env` (Gmail na demonstração; contato@b2bsafe.com.br em produção).
  - [ ] Falha no e-mail não impede gravar o lead (envio em fila, com nova tentativa).

### RF-008 — Atribuição de origem do lead
- **Ator:** Sistema · **Prioridade:** must
- **Descrição:** no primeiro acesso da sessão, guardar `utm_source`, `utm_medium`, `utm_campaign`, `utm_term`, `utm_content`, `gclid`, `fbclid`, referrer e página de entrada (first-touch) e associar ao lead quando ele for criado. Sem parâmetros, a origem é classificada pelo referrer (busca orgânica, redes sociais, outro site) ou como "Direto".
- **Critérios de aceite:**
  - [ ] Funciona mesmo sem consentimento de cookies estatísticos: os dados ficam na sessão do próprio site e só são gravados se o visitante virar lead.
  - [ ] Todo lead tem um canal de origem classificado (nunca vazio).

### RF-009 — Banner e preferências de cookies
- **Ator:** Visitante · **Prioridade:** must
- **Descrição:** banner no primeiro acesso com "Aceitar todos", "Recusar" e "Personalizar" (categorias: necessários, sempre ativos; estatísticos, para o GA4). Link "Preferências de cookies" no rodapé para mudar a escolha.
- **Critérios de aceite:**
  - [ ] "Recusar" tem o mesmo destaque visual que "Aceitar".
  - [ ] A escolha fica salva por 12 meses, com registro da data e da versão.
  - [ ] Acessível por teclado e leitor de tela; não bloqueia o conteúdo.

### RF-010 — Google Analytics 4 com Consent Mode v2
- **Ator:** Sistema · **Prioridade:** must
- **Descrição:** GA4 com Consent Mode v2 em modo padrão negado; só passa a coletar depois do consentimento estatístico. Eventos: `generate_lead` (com canal e serviço), `click_whatsapp`, `chat_start`, `chat_lead`.
- **Critérios de aceite:**
  - [ ] Sem consentimento, nenhum cookie `_ga` é criado.
  - [ ] O ID de medição vem de configuração.

### RF-011 — SEO técnico
- **Ator:** Visitante · **Prioridade:** should
- **Descrição:** títulos e descrições por página, Open Graph, `sitemap.xml`, `robots.txt`, dados estruturados (`FinancialService` / `LocalBusiness` com os dois endereços) e URLs canônicas.
- **Critérios de aceite:**
  - [ ] Lighthouse SEO ≥ 90.
  - [ ] O ambiente de homologação ou demonstração responde com `noindex`.

### RF-012 — Redirecionamentos das URLs antigas
- **Ator:** Visitante · **Prioridade:** should
- **Descrição:** 301 de `/members` para `/`, de `/pol%C3%ADtica-de-privacidade-list` para `/maquininha#pedir`, de `/policy.` para `/policy`, e uma página 404 amigável com links úteis e WhatsApp.
- **Critérios de aceite:**
  - [ ] Nenhum link interno quebrado (verificação automática no CI).

## Assistente virtual (chatbot)

### RF-013 — Widget de chat
- **Ator:** Visitante · **Prioridade:** must
- **Descrição:** botão de chat em todas as páginas públicas, abrindo uma janela própria. Na abertura mostra o aviso de que é uma IA, que a conversa é processada por terceiros (Mistral, França) e o link para a política; a conversa começa depois do "Concordo".
- **Critérios de aceite:**
  - [ ] Acessível (foco, teclado, leitor de tela, contraste) e responsivo.
  - [ ] Convive com o botão flutuante do WhatsApp sem sobreposição no celular.
  - [ ] A conversa continua se o visitante mudar de página (identificador de sessão).

### RF-014 — Proxy de mensagens para o n8n
- **Ator:** Sistema · **Prioridade:** must
- **Descrição:** o navegador envia a mensagem ao Laravel, que repassa ao webhook do n8n (URL e segredo só no servidor) e devolve a resposta. O n8n responde em JSON com `reply`, `lead` (dados detectados, opcional) e `handoff` (booleano).
- **Critérios de aceite:**
  - [ ] Limite de mensagens por sessão e por IP; tamanho máximo da mensagem.
  - [ ] Tempo limite configurável; se o n8n não responder ou estiver fora do ar, o widget mostra uma mensagem amigável com WhatsApp e formulário, sem erro técnico.
  - [ ] A autenticação com o n8n usa um segredo compartilhado (cabeçalho), nunca exposto ao navegador.

### RF-015 — Captação de lead pelo chat
- **Ator:** Assistente virtual · **Prioridade:** must
- **Descrição:** quando o n8n devolver os dados de lead (nome e WhatsApp, no mínimo), o Laravel cria ou atualiza o lead com canal "chatbot", a origem (RF-008) e o serviço de interesse, e dispara o RF-007.
- **Critérios de aceite:**
  - [ ] O mesmo visitante na mesma conversa não gera leads duplicados.
  - [ ] O consentimento dado no início do chat fica registrado no lead.

### RF-016 — Transbordo para o WhatsApp
- **Ator:** Assistente virtual · **Prioridade:** must
- **Descrição:** quando o n8n sinalizar `handoff` ou o visitante pedir um atendente, o widget mostra o botão "Falar com um atendente no WhatsApp", com mensagem pronta contendo um resumo do assunto.
- **Critérios de aceite:**
  - [ ] O clique é registrado (RF-005) e vinculado à conversa.

### RF-017 — Histórico de conversas
- **Ator:** Sistema · **Prioridade:** must
- **Descrição:** gravar cada mensagem (visitante e assistente) com data e hora, vinculada à sessão de chat e ao lead, quando houver.
- **Critérios de aceite:**
  - [ ] A ficha do lead mostra a conversa completa (RF-024).
  - [ ] Conversas sem lead também entram na retenção de 24 meses (RF-029).

## Área restrita

### RF-018 — Autenticação
- **Ator:** Atendente, Administrador · **Prioridade:** must
- **Descrição:** login por e-mail e senha, logout, recuperação de senha por e-mail e bloqueio temporário depois de várias tentativas erradas.
- **Critérios de aceite:**
  - [ ] Usuário desativado não consegue entrar.
  - [ ] A área restrita fica fora do sitemap e com `noindex`.

### RF-019 — Gestão de usuários
- **Ator:** Administrador · **Prioridade:** must
- **Descrição:** criar, editar, desativar e reativar usuários; definir o perfil (Administrador ou Atendente). O novo usuário recebe um convite por e-mail para definir a senha.
- **Critérios de aceite:**
  - [ ] Não é possível desativar ou rebaixar o último administrador ativo.

### RF-020 — Dashboard
- **Ator:** Atendente, Administrador · **Prioridade:** must
- **Descrição:** página inicial da área restrita com leads de hoje, da semana e do mês (com variação contra o período anterior), taxa de conversão, tempo médio até o primeiro contato, leads por serviço e por canal de captação (formulário, chatbot, WhatsApp) e os últimos leads.
- **Critérios de aceite:**
  - [ ] Filtro de período (7, 30 e 90 dias, ou personalizado).
  - [ ] Gráficos acessíveis (com tabela alternativa).

### RF-021 — Origem e estratégia (dados do site)
- **Ator:** Atendente, Administrador · **Prioridade:** must
- **Descrição:** relatório de leads e conversões por canal de origem, `utm_source`, `utm_campaign` e serviço, com a taxa de conversão de cada um, para comparar estratégias.
- **Critérios de aceite:**
  - [ ] Os mesmos filtros de período do dashboard.
  - [ ] Clicar numa linha abre a lista de leads já filtrada.

### RF-022 — Métricas do Google Analytics no painel
- **Ator:** Atendente, Administrador · **Prioridade:** should
- **Descrição:** na tela de Origem, mostrar dados do GA4 lidos pela API de dados (Google Analytics Data API) com conta de serviço: usuários, sessões por canal, campanhas, páginas mais vistas e eventos de conversão. Os dados ficam em cache (atualizados de hora em hora pelo agendador).
- **Critérios de aceite:**
  - [ ] Credencial e ID da propriedade só no servidor.
  - [ ] Se a API falhar, a tela mostra o último dado em cache com a data, sem quebrar.
  - [ ] Aviso de que o GA4 só conta visitantes que aceitaram cookies.

### RF-023 — Lista de leads
- **Ator:** Atendente, Administrador · **Prioridade:** must
- **Descrição:** tabela com busca (nome, e-mail, telefone) e filtros por status, serviço, canal, origem e período; ordenação; paginação.
- **Critérios de aceite:**
  - [ ] Os filtros ficam na URL (dá para compartilhar o link).

### RF-024 — Ficha do lead
- **Ator:** Atendente, Administrador · **Prioridade:** must
- **Descrição:** dados do lead, origem completa, consentimentos, histórico de status (quem mudou e quando), anotações da equipe, conversa do chatbot e botão "Chamar no WhatsApp" com mensagem pronta usando o nome e o serviço.
- **Critérios de aceite:**
  - [ ] Adicionar uma anotação registra o autor, a data e a hora.
  - [ ] A primeira mudança de "Novo" para outro status registra a data do primeiro contato (usada no RF-020).

### RF-025 — Funil em kanban
- **Ator:** Atendente, Administrador · **Prioridade:** must
- **Descrição:** quadro com as colunas Novo, Em contato, Proposta, Convertido e Perdido; arrastar um card muda o status. Mover para "Perdido" exige o motivo.
- **Critérios de aceite:**
  - [ ] Funciona por teclado (alternativa ao arrastar) e no celular.
  - [ ] Os filtros de serviço e período se aplicam ao quadro.

### RF-026 — Exportação CSV
- **Ator:** Atendente, Administrador · **Prioridade:** must
- **Descrição:** exportar os leads filtrados em CSV (UTF-8 com BOM, separador `;`, compatível com o Excel em português).
- **Critérios de aceite:**
  - [ ] Cada exportação fica registrada no log de auditoria (RF-030).

### RF-027 — Resumo semanal por e-mail
- **Ator:** Sistema → Administrador · **Prioridade:** should
- **Descrição:** toda segunda-feira às 8h, e-mail para os administradores com os leads da semana, a conversão, os melhores canais e campanhas e os destaques do chatbot, comparando com a semana anterior.
- **Critérios de aceite:**
  - [ ] O administrador pode desligar o recebimento no próprio perfil.

### RF-028 — Insights do chatbot
- **Ator:** Atendente, Administrador · **Prioridade:** should
- **Descrição:** tela com o número de conversas, a taxa de conversa que vira lead, a taxa de transbordo, os assuntos mais frequentes e a lista de perguntas sem resposta (sinalizadas pelo n8n ou pelo transbordo), para melhorar a base RAG.
- **Critérios de aceite:**
  - [ ] Cada pergunta sem resposta pode ser marcada como "resolvida na base".

### RF-029 — Retenção e anonimização automática
- **Ator:** Agendador · **Prioridade:** must
- **Descrição:** diariamente, anonimizar os leads e apagar as conversas com mais de 24 meses, mantendo os números agregados (canal, serviço, status, datas) para os relatórios.
- **Critérios de aceite:**
  - [ ] Depois de anonimizado, o lead não guarda nome, e-mail, telefone, mensagem nem conversa.

### RF-030 — Direitos do titular e auditoria
- **Ator:** Administrador · **Prioridade:** must
- **Descrição:** na ficha do lead, o administrador pode anonimizar o lead na hora (pedido do titular) ou exportar os dados dele. As ações sensíveis (exportação, anonimização, gestão de usuários) ficam num log de auditoria que só o administrador consulta.
- **Critérios de aceite:**
  - [ ] A anonimização pede confirmação e não pode ser desfeita.

### RF-031 — Notificação de novo lead no painel
- **Ator:** Sistema → Atendente, Administrador · **Prioridade:** must
- **Descrição:** cada lead novo (ou "voltou a entrar em contato") gera uma notificação no sino do painel para todos os usuários ativos, com o nome, o serviço e o canal, e link para a ficha.
- **Critérios de aceite:**
  - [ ] O sino mostra o número de não lidas e atualiza sozinho a cada 30 s (sem processo persistente).
  - [ ] Marcar como lida, individualmente ou todas.

## Histórico de alterações

| Data | ID | Mudança | Origem |
| --- | --- | --- | --- |
| 2026-11-06 | RF-001 a RF-030 | Criação do documento | /iniciar-projeto |
| 2026-11-07 | RF-001 | Cards de serviço levam ao WhatsApp com o serviço na mensagem (antes: formulário com serviço pré-selecionado) | /desenhar-telas — tela T-01 |
| 2026-11-07 | RF-031 | Notificação de novo lead no sino do painel | /desenhar-telas — tela T-12 |
| 2026-11-07 | RF-002 | Tabela de taxas da C6 Pay na página, com data de referência | /desenhar-telas — tela T-02 |
