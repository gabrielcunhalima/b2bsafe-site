# Backlog do MVP

Histórias do MVP (demonstração até 2026-12-06), prontas para a `/configurar-repositorio` transformar em issues. Ordem sugerida de implementação: épicos 1 → 7, respeitando as dependências.

## Épico: Site público (area:site)

### US-001 — Layout base: cabeçalho, rodapé e navegação
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** visitante, **quero** um menu que leve a cada seção e um rodapé com os dados da empresa, **para** encontrar rápido o que procuro e confiar que é um parceiro oficial.
- **Critérios de aceite:**
  - [ ] Menu com âncoras para as seções da Home e link para a Maquininha; rolagem suave e menu móvel acessível.
  - [ ] Rodapé com os CNPJs, os dois endereços, os e-mails, as redes sociais atuais (sem os links "Connect Partners"), os links legais, "Preferências de cookies" e o aviso de parceiro C6 (RN-015).
  - [ ] Layout de 360 px a 1920 px, sem rolagem horizontal; navegação por teclado e foco visível.
- **RF:** RF-001 · **RN:** RN-015
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** nenhuma
- **Telas:** T-10

### US-002 — Home institucional
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** visitante, **quero** conhecer a B2BSAFE e os serviços do C6 Empresas numa página só, **para** decidir com qual serviço quero falar.
- **Critérios de aceite:**
  - [ ] Seções Apresentação, Serviços (7 cards), Maquininha C6 Pay (seção própria com imagem, chamada para o WhatsApp (11) 92460-0991 e link para `/maquininha`), Sobre (selo Conexão Awards 2025), Parcerias / Trabalhe conosco, Fale conosco, Credenciamento (com "Verificar no C6 Bank") e Canais oficiais C6.
  - [ ] Cada card mostra "Fale com um atendente" no hover/foco (sempre visível no celular) e abre o WhatsApp com o serviço na mensagem; o clique é registrado (RN-010).
  - [ ] Textos revisados a partir de `conteudo/www.b2bsafe.com.br.md`; imagens otimizadas e com licença verificada.
  - [ ] Lighthouse mobile ≥ 90 nas quatro categorias.
- **RF:** RF-001 · **RN:** RN-010, RN-015, RN-021
- **Prioridade:** must
- **Tamanho:** G
- **Dependências:** US-001
- **Telas:** T-01

### US-003 — Página Maquininha (C6 Pay)
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** lojista, **quero** ver as vantagens da maquininha e pedir a minha, **para** começar a receber pagamentos.
- **Critérios de aceite:**
  - [ ] Tabela de taxas (débito, crédito à vista, parcelado) em configuração, com data de referência e aviso de sujeição à análise do C6.
  - [ ] Conteúdo de vantagens, condições e adquirentes; chamadas "Quero minha C6 Pay" e "Abrir conta grátis" levam ao formulário (serviço Maquininha) ou ao WhatsApp, nunca a uma página inexistente.
  - [ ] WhatsApp desta página: (11) 92460-0991.
- **RF:** RF-002 · **RN:** RN-021
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-001
- **Telas:** T-02

### US-004 — Política de Privacidade do site
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** visitante, **quero** saber como meus dados são usados, **para** decidir se envio meus dados ou converso com o assistente.
- **Critérios de aceite:**
  - [ ] Página `/privacidade` cobrindo o formulário, o chatbot (Mistral, França), os cookies e o GA4, a retenção de 24 meses, os direitos do titular e o DPO ti@b2bsafe.com.br.
  - [ ] Versão e data de atualização visíveis; a versão fica em configuração e é usada no registro de consentimento.
  - [ ] Numeração de seções correta.
- **RF:** RF-003 · **RN:** RN-011, RN-012
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** US-001
- **Telas:** T-04

### US-005 — Política e Termos do B2BSafe Connect em /policy
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** responsável pelo B2BSafe Connect, **quero** manter `/policy` no ar, **para** cumprir a exigência da Meta.
- **Critérios de aceite:**
  - [ ] `/policy` com o texto atual, com as numerações de seção e o link `/policy.` corrigidos.
  - [ ] `/policy.` redireciona (301) para `/policy`.
- **RF:** RF-004
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** US-001
- **Telas:** T-05

### US-006 — Página 404 amigável
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** visitante que caiu num link errado, **quero** uma página com caminhos úteis, **para** não desistir do contato.
- **Critérios de aceite:**
  - [ ] Página 404 com links para a Home, a Maquininha, o formulário e o WhatsApp, no layout do site.
- **RF:** RF-012 (parcial)
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** US-001
- **Telas:** T-09

## Épico: Captação de leads (area:leads)

### US-007 — Atribuição de origem do visitante
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** proprietário, **quero** saber de qual canal e campanha veio cada contato, **para** investir na estratégia que dá mais resultado.
- **Critérios de aceite:**
  - [ ] Um middleware guarda o primeiro toque (UTM, gclid, fbclid, referrer, página de entrada) na sessão; com consentimento estatístico, também num cookie de 90 dias (RN-009).
  - [ ] Classificação do canal conforme RN-008, com testes para cada regra de prioridade.
  - [ ] A origem só é gravada no banco quando o visitante vira lead, conversa no chat ou clica no WhatsApp.
- **RF:** RF-008 · **RN:** RN-008, RN-009
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** nenhuma
- **Telas:** —

### US-008 — Formulário de lead
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** visitante, **quero** deixar meus dados e o serviço de interesse, **para** ser contatado pela B2BSAFE.
- **Critérios de aceite:**
  - [ ] Campos nome, WhatsApp, e-mail, serviço, mensagem (opcional) e aceite da política (desmarcado); validação no navegador e no servidor (RN-001, RN-002).
  - [ ] Honeypot e limite de 5 envios por IP por hora (RN-016).
  - [ ] Grava o lead como "Novo", com canal "formulário", origem e consentimento (versão da política).
  - [ ] Mensagem de sucesso com a opção de seguir pelo WhatsApp; erros acessíveis (anunciados ao leitor de tela).
- **RF:** RF-006 · **RN:** RN-001, RN-002, RN-011, RN-016
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-002, US-007
- **Telas:** T-03

### US-009 — Deduplicação de leads
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** atendente, **quero** que contatos repetidos da mesma pessoa caiam no mesmo lead, **para** não atender duas vezes nem perder o histórico.
- **Critérios de aceite:**
  - [ ] Mesmo WhatsApp normalizado ou mesmo e-mail com lead aberto há até 30 dias: grava uma interação no lead existente e marca "voltou a entrar em contato".
  - [ ] Lead Convertido, Perdido ou com mais de 30 dias: cria um lead novo com `lead_anterior_id`.
  - [ ] Vale para o formulário e para o chatbot.
- **RF:** RF-006, RF-015 · **RN:** RN-003
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-008
- **Telas:** T-16

### US-010 — Aviso de novo lead por e-mail e no painel
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** equipe comercial, **quero** receber um e-mail e uma notificação no painel a cada lead novo, **para** responder rápido.
- **Critérios de aceite:**
  - [ ] E-mail com os dados, a origem, o serviço e o link para a ficha; variante "voltou a entrar em contato".
  - [ ] Enviado pela fila (`database`, processada pelo cron); falha no SMTP não impede gravar o lead e gera nova tentativa.
  - [ ] Destinatário e SMTP no `.env` (Gmail na demonstração).
  - [ ] Notificação no sino do Filament para os usuários ativos, com link para a ficha; atualiza a cada 30 s (RF-031).
- **RF:** RF-007, RF-031 · **RN:** RN-003
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** US-008
- **Telas:** E-01

### US-011 — Botões de WhatsApp com registro de clique
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** visitante, **quero** falar no WhatsApp com uma mensagem pronta, **para** não ter que explicar de onde vim.
- **Critérios de aceite:**
  - [ ] Botão flutuante e chamadas para ação no formato `https://wa.me/55...?text=...`; número geral (11) 98420-5023, Maquininha (11) 92460-0991 (RN-021); números em configuração.
  - [ ] Cada clique grava `cliques_whatsapp` com a página, o serviço e a origem, sem atrasar a abertura do WhatsApp.
  - [ ] O clique não é lead (RN-010).
- **RF:** RF-005 · **RN:** RN-010, RN-021
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** US-001, US-007
- **Telas:** T-08

## Épico: Consentimento e medição (area:analytics)

### US-012 — Banner e preferências de cookies
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** visitante, **quero** escolher quais cookies aceito, **para** controlar meus dados.
- **Critérios de aceite:**
  - [ ] "Aceitar todos", "Recusar" (com o mesmo destaque) e "Personalizar" (necessários e estatísticos).
  - [ ] Escolha válida por 12 meses, com registro em `consentimentos` (visitante anônimo, versão, categorias); o banner reaparece quando a versão muda (RN-011).
  - [ ] Reabrível pelo link do rodapé; acessível e sem bloquear o conteúdo.
- **RF:** RF-009 · **RN:** RN-011
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-001
- **Telas:** T-06

### US-013 — GA4 com Consent Mode v2 e eventos de conversão
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** proprietário, **quero** medir as visitas e as conversões no Google Analytics, **para** comparar os canais.
- **Critérios de aceite:**
  - [ ] Consent Mode v2 com padrão negado; sem consentimento, nenhum cookie `_ga`.
  - [ ] Eventos `generate_lead` (canal, serviço), `click_whatsapp`, `chat_start`, `chat_lead`.
  - [ ] ID de medição em configuração; desligado em ambiente local e de teste.
- **RF:** RF-010 · **RN:** RN-011
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** US-012
- **Telas:** T-06

## Épico: Assistente virtual (area:chatbot)

### US-014 — Ambiente do n8n, Qdrant e túnel em Docker
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** responsável, **quero** subir o n8n, o Qdrant e o túnel com um comando, **para** desenvolver e demonstrar o assistente.
- **Critérios de aceite:**
  - [ ] Serviços `n8n`, `qdrant` e `cloudflared` no `docker compose`, com volumes persistentes e `chatbot/base/` montado como `/documentos/b2bsafe`.
  - [ ] Script que lê a URL trycloudflare gerada e atualiza `CHATBOT_WEBHOOK_URL` no `.env` local e, opcionalmente, no servidor de demonstração.
  - [ ] Nenhuma chave no repositório: Mistral e Qdrant ficam como credenciais do n8n; o segredo do webhook fica no `.env`.
- **RF:** RF-014 · **RN:** —
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** nenhuma (entra junto com o scaffold)
- **Telas:** —

### US-015 — Base de conhecimento e workflow de ingestão
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** responsável, **quero** alimentar a base do assistente com o conteúdo do site, o FAQ e os materiais do C6, **para** que ele responda com informação correta.
- **Critérios de aceite:**
  - [ ] Documentos em Markdown em `chatbot/base/` (site revisado, FAQ, materiais fornecidos), com origem e data em cada arquivo.
  - [ ] Workflow de ingestão: divide em trechos, gera embeddings (`mistral-embed`) e grava na coleção `b2bsafe_base` do Qdrant; reexecutar substitui a base sem duplicar.
  - [ ] Workflow exportado em `chatbot/workflows/` sem credenciais.
- **RF:** RF-014 · **RN:** RN-014
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-014
- **Telas:** —

### US-016 — Workflow de atendimento (RAG + Mistral)
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** visitante, **quero** respostas corretas sobre os produtos, **para** tirar dúvidas na hora.
- **Critérios de aceite:**
  - [ ] Webhook valida o segredo; busca top-k no Qdrant com limiar; prompt com as regras fixas primeiro (identidade de assistente de parceiro, RN-014, não pedir dados sensíveis), depois os trechos, o contexto e o histórico (últimas 6 trocas).
  - [ ] Resposta no contrato `{reply, lead, handoff, unanswered, topic}`; JSON do modelo lido por chaves balanceadas; sempre HTTP 200 com texto legível e `diagnostico` em caso de falha.
  - [ ] Roteiro de testes de conversa (mínimo 20 perguntas, incluindo fora do escopo, taxa e aprovação de crédito, pedido de atendente e tentativa de envio de CPF) com os resultados registrados.
- **RF:** RF-014, RF-015, RF-016 · **RN:** RN-013, RN-014
- **Prioridade:** must
- **Tamanho:** G
- **Dependências:** US-015
- **Telas:** —

### US-017 — Widget do assistente no site
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** visitante, **quero** conversar com o assistente em qualquer página, **para** ser atendido logo no primeiro acesso.
- **Critérios de aceite:**
  - [ ] Botão de chat em todas as páginas públicas; aviso de IA e de processamento pela Mistral, com o link para a política; a conversa só começa depois do "Concordo" (consentimento gravado).
  - [ ] Depois do "Concordo", saudação e 4 sugestões de pergunta em botões; o assistente pede nome e WhatsApp na conversa.
  - [ ] Estados: digitando, erro, indisponível (WhatsApp e formulário), transbordo.
  - [ ] A conversa continua entre páginas (UUID da conversa); carregado só depois da página (RNF-015).
  - [ ] Acessível (WCAG 2.2 AA) e sem sobrepor o botão do WhatsApp no celular.
- **RF:** RF-013 · **RN:** RN-011
- **Prioridade:** must
- **Tamanho:** G
- **Dependências:** US-001
- **Telas:** T-07

### US-018 — Proxy do chat no Laravel com fallback e mascaramento
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** responsável, **quero** que o site intermedeie o chat, **para** proteger o n8n e nunca mostrar erro ao visitante.
- **Critérios de aceite:**
  - [ ] `POST /chat/mensagens`: valida, limita (500 caracteres, 30 mensagens por sessão por hora, 50 por conversa) e mascara CPF, CNPJ, cartão e senha antes de enviar e de gravar (RN-013).
  - [ ] Chama o n8n com o segredo e um timeout de 10 s; com n8n fora do ar ou resposta inválida, devolve o fallback (WhatsApp e formulário).
  - [ ] Testes com o n8n simulado (resposta ok, lenta, inválida, fora do ar).
- **RF:** RF-014 · **RN:** RN-013, RN-016
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-017
- **Telas:** T-07

### US-019 — Lead criado pela conversa
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** atendente, **quero** que os dados informados no chat virem lead automaticamente, **para** dar sequência sem copiar nada.
- **Critérios de aceite:**
  - [ ] Quando o n8n devolve `lead` com nome e WhatsApp válidos, cria ou atualiza o lead (canal "chatbot", origem, serviço, consentimento do chat) e dispara o e-mail.
  - [ ] Sem duplicação dentro da mesma conversa; aplica a deduplicação da US-009.
  - [ ] Evento `chat_lead` no GA4 (com consentimento).
- **RF:** RF-015 · **RN:** RN-001, RN-002, RN-003
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-009, US-010, US-016, US-018
- **Telas:** T-07

### US-020 — Transbordo para atendente no WhatsApp
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** visitante, **quero** passar para uma pessoa quando o assistente não resolver, **para** não ficar sem resposta.
- **Critérios de aceite:**
  - [ ] Com `handoff` (ou o pedido explícito do visitante), mostra "Falar com um atendente no WhatsApp" com uma mensagem pronta resumindo o assunto.
  - [ ] O clique fica registrado e vinculado à conversa e ao lead; a conversa é marcada como transbordo.
- **RF:** RF-016 · **RN:** RN-010, RN-021
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** US-011, US-018
- **Telas:** T-07

### US-021 — Histórico das conversas
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** atendente, **quero** ler a conversa que o lead teve com o assistente, **para** retomar o atendimento já sabendo o contexto.
- **Critérios de aceite:**
  - [ ] Cada mensagem gravada (papel, conteúdo mascarado, data, `topico`, `sem_resposta`, `diagnostico`).
  - [ ] A conversa aparece na ficha do lead, em ordem, com a indicação de transbordo.
- **RF:** RF-017 · **RN:** RN-013
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** US-018
- **Telas:** T-16

## Épico: Área restrita (area:painel)

### US-022 — Login e recuperação de senha
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** membro da equipe, **quero** entrar no painel com segurança, **para** acessar os leads.
- **Critérios de aceite:**
  - [ ] Login por e-mail e senha no Filament (`/painel`), logout, recuperação de senha por e-mail (link de 24 h).
  - [ ] Bloqueio de 15 min depois de 5 tentativas erradas; usuário desativado não entra; sessão expira com 2 h de inatividade.
  - [ ] Comando para criar o primeiro administrador; `/painel` com `noindex`.
- **RF:** RF-018 · **RN:** RN-016, RN-019
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** nenhuma
- **Telas:** T-11, T-19

### US-023 — Gestão de usuários
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** administrador, **quero** convidar e gerir a equipe, **para** controlar quem acessa os leads.
- **Critérios de aceite:**
  - [ ] Criar (com convite por e-mail para definir a senha), editar, desativar, reativar e mudar o perfil.
  - [ ] Atendente não vê o menu Usuários (RN-017); o último administrador ativo não pode ser desativado nem rebaixado (RN-018).
  - [ ] Ações registradas na auditoria.
- **RF:** RF-019 · **RN:** RN-017, RN-018, RN-019
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-022
- **Telas:** T-17, E-02

### US-024 — Lista de leads com busca e filtros
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** atendente, **quero** buscar e filtrar os leads, **para** organizar meu trabalho.
- **Critérios de aceite:**
  - [ ] Busca por nome, e-mail e telefone; filtros de status, serviço, canal, origem e período; ordenação e paginação; filtros na URL.
  - [ ] Indicador visual de "voltou a entrar em contato".
- **RF:** RF-023 · **RN:** RN-017
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-008, US-022
- **Telas:** T-14

### US-025 — Ficha do lead
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** atendente, **quero** ver tudo sobre o lead num lugar só, **para** fazer um bom primeiro contato.
- **Critérios de aceite:**
  - [ ] Duas colunas (empilhadas no celular): à esquerda dados, origem, consentimentos e ações; à direita a linha do tempo única (status, interações, anotações e conversa do chat).
  - [ ] Adicionar uma anotação (autor e data); mudar o status (registra o histórico e, na primeira saída de Novo, o primeiro contato, RN-005).
  - [ ] Botão "Chamar no WhatsApp" com mensagem pronta usando o nome e o serviço.
- **RF:** RF-024 · **RN:** RN-004, RN-005
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-024, US-021
- **Telas:** T-16

### US-026 — Funil em kanban
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** atendente, **quero** arrastar os leads entre as etapas, **para** acompanhar o funil visualmente.
- **Critérios de aceite:**
  - [ ] Colunas Novo, Em contato, Proposta, Convertido e Perdido (Flowforge); arrastar muda o status e registra o histórico.
  - [ ] Card com nome, serviço, etiqueta do canal de origem e botão de WhatsApp.
  - [ ] Mover para Perdido exige o motivo (RN-006); não é permitido voltar para Novo (RN-004).
  - [ ] Alternativa por teclado e uso no celular; filtros de serviço e período.
- **RF:** RF-025 · **RN:** RN-004, RN-005, RN-006
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-025
- **Telas:** T-15

### US-027 — Dashboard de indicadores
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** proprietário, **quero** ver os números do comercial ao entrar, **para** saber como está o resultado.
- **Critérios de aceite:**
  - [ ] Leads de hoje, da semana e do mês, com a variação contra o período anterior; taxa de conversão (RN-007); tempo médio até o primeiro contato (RN-005); leads por serviço e por canal; cliques no WhatsApp; últimos leads.
  - [ ] Filtro de período (7, 30, 90 dias ou personalizado); gráficos com tabela alternativa acessível.
  - [ ] Testes dos cálculos com dados conhecidos.
- **RF:** RF-020 · **RN:** RN-005, RN-007, RN-010, RN-020
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-024
- **Telas:** T-12

### US-028 — Relatório de origem e estratégia
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** proprietário, **quero** comparar leads e conversões por canal e campanha, **para** descobrir qual estratégia é mais assertiva.
- **Critérios de aceite:**
  - [ ] Tabela e gráfico por canal, `utm_source`, `utm_campaign` e serviço, com leads, convertidos e taxa; cliques no WhatsApp por origem.
  - [ ] Os mesmos filtros de período; clicar numa linha abre a lista filtrada.
  - [ ] Espaço reservado para as métricas do GA4 (RF-022, v1.0).
- **RF:** RF-021 · **RN:** RN-007, RN-008
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-007, US-027
- **Telas:** T-13

### US-029 — Exportação CSV
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** atendente, **quero** exportar os leads filtrados, **para** trabalhar numa planilha quando precisar.
- **Critérios de aceite:**
  - [ ] CSV UTF-8 com BOM, separador `;`, que abre corretamente no Excel em português; respeita os filtros da lista.
  - [ ] Exportação registrada na auditoria.
- **RF:** RF-026 · **RN:** RN-017
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** US-024, US-031
- **Telas:** T-14

## Épico: LGPD (area:lgpd)

### US-030 — Retenção e anonimização automática
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** encarregado de dados, **quero** que os dados antigos sejam anonimizados sozinhos, **para** cumprir a retenção de 24 meses.
- **Critérios de aceite:**
  - [ ] Tarefa diária: anonimiza os leads e apaga as conversas, mensagens, interações e anotações cuja última interação passou de 24 meses; mantém os agregados (RN-012).
  - [ ] Limpa o IP do log de auditoria com mais de 30 dias e as entradas de auditoria com mais de 24 meses.
  - [ ] Testes com datas simuladas.
- **RF:** RF-029 · **RN:** RN-012
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** US-008, US-021
- **Telas:** —

### US-031 — Direitos do titular e log de auditoria
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** administrador, **quero** atender o pedido de um titular e consultar as ações sensíveis, **para** demonstrar conformidade.
- **Critérios de aceite:**
  - [ ] Na ficha: "Exportar dados do titular" (JSON/CSV) e "Anonimizar agora" (com confirmação, sem volta); só o administrador vê essas ações.
  - [ ] Log de auditoria (exportações, anonimizações, gestão de usuários, logins) consultável só pelo administrador, com filtros.
- **RF:** RF-030 · **RN:** RN-012, RN-017
- **Prioridade:** must
- **Tamanho:** M
- **Dependências:** US-025
- **Telas:** T-16, T-18

## Épico: Operação (area:infra)

### US-032 — Backup diário do banco
- **Issue:** (preenchido pela /configurar-repositorio)
- **Como** responsável, **quero** um backup diário fora da hospedagem, **para** cumprir o RPO de 24 h.
- **Critérios de aceite:**
  - [ ] Tarefa agendada gera o dump compactado e envia para o armazenamento externo (definido na `/configurar-infra`); mantém 30 dias.
  - [ ] Alerta por e-mail em caso de falha; restauração testada e documentada no runbook.
- **RF:** — · **RN:** — · **RNF:** RNF-003, RNF-004, RNF-005
- **Prioridade:** must
- **Tamanho:** P
- **Dependências:** nenhuma
- **Telas:** —

## Resumo

| Épico | Histórias | P | M | G |
| --- | --- | --- | --- | --- |
| Site público | 6 | 3 | 2 | 1 |
| Captação de leads | 5 | 2 | 3 | 0 |
| Consentimento e medição | 2 | 1 | 1 | 0 |
| Assistente virtual | 8 | 2 | 4 | 2 |
| Área restrita | 8 | 1 | 7 | 0 |
| LGPD | 2 | 1 | 1 | 0 |
| Operação | 1 | 1 | 0 | 0 |
| **Total** | **32** | **11** | **18** | **3** |
