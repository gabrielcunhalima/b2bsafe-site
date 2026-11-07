# 03 — Regras de negócio

## Leads

### RN-001 — Dados mínimos de um lead
- **Regra:** pelo formulário são obrigatórios nome, WhatsApp, e-mail, serviço de interesse e o aceite da política; a mensagem é opcional. Pelo chatbot, o lead só é criado quando houver pelo menos nome e WhatsApp ou email.
- **Exemplo:** no chat, o visitante informa só o e-mail ou só o WhatsApp. Vira lead; o assistente pede o WhatsApp.
- **Exceções:** nenhuma.
- **RF:** RF-006, RF-015

### RN-002 — Telefone brasileiro válido e normalizado
- **Regra:** o WhatsApp precisa ter DDD válido e 8 ou 9 dígitos (celular com 9 iniciando por 9). É gravado normalizado no formato E.164 (`+55DDDNUMERO`).
- **Exemplo:** "(48) 99999-1234" vira `+5548999991234`.
- **Exceções:** números estrangeiros não são aceitos no MVP.
- **RF:** RF-005, RF-006, RF-015

### RN-003 — Lead duplicado
- **Regra:** se chegar um contato com o mesmo WhatsApp normalizado (ou o mesmo e-mail) de um lead aberto (Novo, Em contato ou Proposta) criado há até 30 dias, não se cria lead novo: o contato vira uma nova interação na ficha do existente, que é sinalizado como "voltou a entrar em contato", e a equipe é notificada. Se o lead existente estiver Convertido, Perdido ou tiver mais de 30 dias, cria-se um lead novo, com link para o anterior.
- **Exemplo:** a pessoa preenche o formulário e, dois dias depois, deixa os dados no chat: fica um lead só, com as duas interações.
- **Exceções:** nenhuma.
- **RF:** RF-006, RF-015, RF-024

### RN-004 — Status do lead e transições
- **Regra:** os status são Novo → Em contato → Proposta → Convertido, e Perdido. Qualquer transição é permitida, exceto voltar para Novo. Toda mudança registra quem fez, quando, e o status anterior.
- **Exemplo:** um lead Perdido por "sem retorno" responde depois e volta para Em contato.
- **Exceções:** um lead anonimizado não muda mais de status.
- **RF:** RF-024, RF-025

### RN-005 — Primeiro contato
- **Regra:** a data do primeiro contato é a da primeira saída do status Novo. O tempo até o primeiro contato é a diferença entre essa data e a criação do lead.
- **Exemplo:** criado às 9h, movido para Em contato às 11h30: 2h30.
- **Exceções:** um lead que vai direto de Novo para Perdido com motivo "Duplicado/spam" fica fora da média.
- **RF:** RF-020, RF-024

### RN-006 — Motivo de perda obrigatório
- **Regra:** mover para Perdido exige escolher um motivo: Sem interesse, Sem retorno, Não aprovado / não atende requisitos, Escolheu outra instituição, Duplicado/spam ou Outro (texto obrigatório).
- **Exemplo:** um lead de crédito com análise negada fica como "Não aprovado".
- **Exceções:** nenhuma.
- **RF:** RF-025

### RN-007 — Cálculo da taxa de conversão
- **Regra:** conversão do período = leads criados no período que estão Convertidos ÷ total de leads criados no período (visão por coorte de criação). Leads "Duplicado/spam" ficam fora do denominador.
- **Exemplo:** em outubro, 40 leads (2 spam) e 7 convertidos: 7 ÷ 38 = 18,4%.
- **Exceções:** nenhuma.
- **RF:** RF-020, RF-021

## Origem e captação

### RN-008 — Classificação do canal de origem
- **Regra:** vale o primeiro toque (first-touch). Classificação em ordem de prioridade:
  1. Com `gclid`: Google Ads.
  2. Com `fbclid` ou `utm_source` de Facebook/Instagram com mídia paga: Meta Ads.
  3. `utm_medium` igual a cpc, ppc, paid ou ads: Mídia paga (`utm_source`).
  4. Outro UTM: Campanha (`utm_source` / `utm_medium`).
  5. Referrer de buscador: Busca orgânica.
  6. Referrer de rede social: Redes sociais.
  7. Outro referrer: Referência (domínio).
  8. Nenhum dos anteriores: Direto.
- **Exemplo:** chegou por `?utm_source=instagram&utm_medium=bio`: Campanha (instagram / bio).
- **Exceções:** referrer do próprio site é ignorado.
- **RF:** RF-008, RF-021

### RN-009 — Guarda da origem conforme consentimento
- **Regra:** sem consentimento de cookies estatísticos, a origem fica só na sessão do site (perdida ao fechar o navegador). Com consentimento, o primeiro toque é mantido por 90 dias. Em ambos os casos, só é gravada no banco se o visitante virar lead ou clicar no WhatsApp.
- **Exemplo:** o visitante veio do Google Ads, aceitou cookies e voltou 10 dias depois para preencher o formulário: o lead fica como Google Ads.
- **Exceções:** nenhuma.
- **RF:** RF-008, RF-009

### RN-010 — Canais de captação e cliques no WhatsApp
- **Regra:** os canais de captação são formulário, chatbot e WhatsApp. Um clique no WhatsApp **não** é lead, porque não há dados do visitante: é contado como "clique no WhatsApp", com a origem, e aparece separado no dashboard.
- **Exemplo:** o dashboard mostra 30 leads (22 formulário e 8 chatbot) e 45 cliques no WhatsApp.
- **Exceções:** um transbordo do chatbot para o WhatsApp é um clique vinculado à conversa e ao lead, quando houver.
- **RF:** RF-005, RF-016, RF-020

## Consentimento e LGPD

### RN-011 — Consentimento versionado
- **Regra:** o aceite da política (no formulário ou no chat) e as preferências de cookies registram data, hora, versão do documento e categorias. A caixa de aceite nunca vem marcada. Quando a política de cookies muda de versão, o banner volta a aparecer.
- **Exemplo:** depois que a política vai para a v2, quem aceitou a v1 vê o banner de novo.
- **Exceções:** os cookies necessários (sessão, segurança) não dependem de consentimento.
- **RF:** RF-003, RF-006, RF-009, RF-013

### RN-012 — Retenção de 24 meses
- **Regra:** leads, conversas e cliques são anonimizados ou apagados 24 meses depois da última interação. Ficam só os dados agregados: canal, serviço, status, datas e motivo de perda. O log de auditoria também é mantido por 24 meses.
- **Exemplo:** um lead com a última anotação em 2026-12-01 é anonimizado em 2028-12-01.
- **Exceções:** a pedido do titular, o administrador anonimiza na hora (RF-030).
- **RF:** RF-029, RF-030

### RN-013 — Dados sensíveis no chat
- **Regra:** o chatbot não pede CPF, senha, dados bancários ou de cartão. Antes de repassar ao n8n e de gravar, o Laravel mascara padrões de CPF, CNPJ, cartão e senha numérica (ex.: `***.***.***-**`).
- **Exemplo:** "meu CPF é 123.456.789-00" é gravado e enviado como "meu CPF é ***.***.***-**".
- **Exceções:** nenhuma.
- **RF:** RF-014, RF-017

### RN-014 — Limites do assistente
- **Regra:** o assistente não promete aprovação de crédito, taxas finais ou prazos garantidos. Informa que as condições dependem de análise do C6 Bank e oferece um atendente. Também se apresenta como assistente virtual de um parceiro, não como canal oficial do C6.
- **Exemplo:** "Qual a minha taxa?": responde com faixas e condições gerais da base e oferece o atendimento humano.
- **Exceções:** nenhuma. A regra é implementada no prompt e na base RAG do n8n e verificada em testes de conversa.
- **RF:** RF-013, RF-016

### RN-015 — Aviso de parceiro
- **Regra:** todas as páginas públicas exibem o aviso de que o site é de um parceiro e distribuidor do C6 Bank, que as informações não são oficiais do C6, e os canais oficiais.
- **Exemplo:** no rodapé.
- **Exceções:** nenhuma.
- **RF:** RF-001

## Uso e segurança

### RN-016 — Limites anti-abuso
- **Regra:**
  - Formulário: até 5 envios por IP por hora.
  - Chat: mensagem de até 500 caracteres, até 30 mensagens por sessão por hora e até 50 por conversa.
  - Login: 5 tentativas erradas bloqueiam o acesso por 15 minutos.
- **Exemplo:** na 6ª tentativa de login errada, aparece "Muitas tentativas, tente em 15 minutos".
- **Exceções:** nenhuma.
- **RF:** RF-006, RF-014, RF-018

### RN-017 — Permissões por perfil
- **Regra:** o atendente vê e trata todos os leads, vê dashboard, origem e insights, e exporta CSV. Só o administrador gere usuários, anonimiza leads, consulta o log de auditoria e recebe o resumo semanal.
- **Exemplo:** um atendente não vê o menu "Usuários".
- **Exceções:** nenhuma.
- **RF:** RF-019, RF-026, RF-027, RF-030

### RN-018 — Sempre um administrador ativo
- **Regra:** não é permitido desativar, excluir ou rebaixar o último administrador ativo.
- **Exemplo:** o único admin tenta virar atendente e recebe um aviso de bloqueio.
- **Exceções:** nenhuma.
- **RF:** RF-019

### RN-019 — Senhas
- **Regra:** mínimo de 12 caracteres, sem bloquear frases longas. Senhas guardadas com hash forte (bcrypt/argon2). Convite e link de redefinição valem 24 horas.
- **Exemplo:** um convite aceito 2 dias depois mostra "Link expirado, peça outro ao administrador".
- **Exceções:** nenhuma.
- **RF:** RF-018, RF-019

### RN-020 — Fuso horário e agenda
- **Regra:** todas as datas aparecem no fuso America/Sao_Paulo. O resumo semanal sai às segundas, às 8h, e cobre a semana de segunda a domingo anterior.
- **Exemplo:** o resumo de 2026-11-16 cobre de 2026-11-09 a 2026-11-15.
- **Exceções:** nenhuma.
- **RF:** RF-020, RF-027

### RN-021 — WhatsApp por contexto
- **Regra:** o número geral é (11) 98420-5023. A página Maquininha usa (11) 92460-0991. A mensagem pronta cita a página ou o serviço de origem.
- **Exemplo:** na Maquininha: "Olá! Vim pelo site e quero saber sobre a maquininha C6 Pay."
- **Exceções:** nenhuma.
- **RF:** RF-002, RF-005, RF-016

## Histórico de alterações

| Data | ID | Mudança | Origem |
| --- | --- | --- | --- |
| 2026-11-06 | RN-001 a RN-021 | Criação do documento | /iniciar-projeto |
