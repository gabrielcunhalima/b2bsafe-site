# 05 — Integrações e restrições

## Sistemas externos

| Sistema | Uso | Direção | Autenticação | Demonstração | Produção | Falha esperada |
| --- | --- | --- | --- | --- | --- | --- |
| **n8n (chatbot)** | Atendimento (busca RAG + geração), detecção de lead, transbordo; workflow de ingestão da base | Laravel → webhook n8n (HTTPS, POST JSON) | Segredo compartilhado em cabeçalho (`X-Chatbot-Secret`), validado no primeiro nó | n8n em Docker no computador do responsável, exposto por **Cloudflare Tunnel** (container `cloudflared` no compose) | A definir antes da produção (VPS barata ou n8n Cloud) | Tempo limite de 10 s, então fallback para WhatsApp/formulário (RNF-006) |
| **Qdrant** | Banco vetorial da base RAG (coleção `b2bsafe_base`) | n8n → Qdrant (rede interna do Docker) | Chave de API do Qdrant, guardada nas credenciais do n8n | Container no compose, com volume persistente | Junto com o n8n | Sem busca, o fluxo responde com o fallback |
| **Mistral AI** | Chat (geração) e embeddings (`mistral-embed`) do RAG, chamada **pelo n8n** (o site não fala com a Mistral) | n8n → API Mistral | Chave de API em **credencial do n8n** (nunca escrita no workflow exportado) | Chave do responsável | Chave da B2BSAFE ou do responsável (a definir) | Tratada no workflow do n8n |
| **Google Analytics 4** | Coleta de eventos no navegador (com consentimento) | Navegador → Google | ID de medição (público) | Propriedade GA4 do responsável | Propriedade GA4 do proprietário | Sem impacto no site |
| **Google Analytics Data API** | Métricas do GA4 no painel (RF-022) | Laravel (cron) → API | Conta de serviço (JSON fora da pasta pública) com papel de leitor na propriedade | Conta de serviço do responsável | Conta de serviço com acesso à propriedade do proprietário | Mostra o último cache com a data |
| **SMTP** | Notificação de lead, convites, redefinição de senha, resumo semanal | Laravel → SMTP | Usuário e senha no `.env` | **Gmail pessoal do responsável** (senha de app, com verificação em 2 etapas) | contato@b2bsafe.com.br (SMTP do provedor do domínio ou e-mail da Hostinger) | Fila com nova tentativa; o lead é gravado mesmo assim |
| **WhatsApp** | Links `wa.me` com mensagem pronta (sem API) | Navegador → WhatsApp | — | Números atuais | Números atuais | — |
| **Monitor de uptime** | Verifica `/up` a cada 5 min | Serviço → site | — | Plano gratuito (ex.: UptimeRobot) | Idem | — |
| **Armazenamento de backup** | Cópia diária do dump do banco (RNF-005) | Servidor → armazenamento externo | Credencial no servidor | A definir na `/configurar-infra` | Idem | Alerta por e-mail |

### Contrato do webhook do chatbot (rascunho)

Requisição (Laravel → n8n):

```json
{
  "session_id": "uuid",
  "message": "texto já com dados sensíveis mascarados (RN-013)",
  "history": [{"role": "user|assistant", "content": "..."}],
  "context": {"page": "/maquininha", "service": "maquininha"}
}
```

Resposta (n8n → Laravel):

```json
{
  "reply": "texto para o visitante",
  "lead": {"name": "...", "whatsapp": "...", "email": "...", "service": "..."},
  "handoff": false,
  "unanswered": false,
  "topic": "maquininha"
}
```

`lead` é opcional. `unanswered` marca perguntas que o bot não soube responder (RF-028). O workflow é construído do zero; o contrato final é fechado na implementação do chatbot.

### Workflows do n8n (entregas do projeto)

1. **Atendimento:** Webhook → valida o segredo → extrai a pergunta e o histórico (últimas 6 trocas) → busca no Qdrant os trechos mais próximos (top-k, com limite de similaridade) → monta o prompt (regras fixas do bot primeiro, para aproveitar o cache de prompt da Mistral; depois os trechos recuperados, o contexto da página e o histórico) → Mistral (saída em JSON) → interpreta a resposta → responde ao webhook.
2. **Ingestão da base:** lê os documentos da pasta montada (`/documentos/b2bsafe`), divide em trechos, gera os embeddings (`mistral-embed`) e grava no Qdrant. Roda manualmente ou quando a base muda.

Lições do chatbot anterior (Portal do Fornecedor FAPEU) aplicadas:
- O fluxo **nunca** devolve erro ao site: sempre HTTP 200 com texto legível. A causa técnica vai num campo `diagnostico`, visível só nos logs.
- A resposta do modelo é lida extraindo o primeiro objeto JSON por chaves balanceadas, nunca com `JSON.parse` do texto inteiro (o modelo às vezes cola sujeira em volta).
- Contexto limitado: o histórico é cortado e só os trechos recuperados entram no prompt, para não estourar o limite de tokens por minuto da Mistral (no bot anterior isso causou erro 429).
- O webhook não aceita qualquer origem (`allowedOrigins` restrito): só o Laravel chama, com o segredo.
- A chave da Mistral fica em credencial do n8n, não no cabeçalho do nó HTTP.

### Base de conhecimento

Os documentos ficam versionados em `chatbot/base/` no repositório: conteúdo do site revisado, FAQ escrito para o projeto e materiais do C6/B2BSAFE convertidos em Markdown. Esses materiais são fornecidos pelo responsável, e é preciso confirmar se podem ser usados. A pasta é montada no container do n8n como `/documentos/b2bsafe`.

## Autenticação institucional

Não há (nem LDAP, SSO ou gov.br). A área restrita usa usuário e senha próprios (RF-018).

## Hospedagem e rede

- **Provedor:** Hostinger, **hospedagem compartilhada, plano Business** (já contratado; conta `u828679584`, que já hospeda outros sites do responsável). PHP 7.3 a 8.5 disponíveis; SSH, Git e cron incluídos.
- **Restrições:**
  - sem Docker e sem processos persistentes (sem `queue:work` contínuo, WebSocket ou Redis);
  - filas e agendamentos rodam pelo cron a cada minuto;
  - o banco MySQL/MariaDB fica no mesmo servidor (conectar por `127.0.0.1` ou `localhost`);
  - o deploy via SSH/Git ou pela integração Git da Hostinger.
- **Acesso pela internet:** sim, o servidor é público, o que permite CD via GitHub Actions por SSH.
- **Ambientes:**
  - **local:** Docker no computador do responsável, com o mesmo banco de produção;
  - **demonstração/homologação:** `b2bsafe.gabrielcunhalima.dev`, um subdomínio do domínio do responsável na mesma conta Hostinger, com HTTPS e `noindex`;
  - **produção:** domínio definitivo informado como "b2b.com.br" (**a confirmar**: pode ser `b2bsafe.com.br`). Hoje o domínio aponta para o Wix e a troca de DNS é feita depois da aprovação.
- **n8n + Qdrant:** ficam fora da Hostinger, em Docker no computador do responsável, no mesmo `docker compose` do ambiente local. Na demonstração, o chat só funciona com o computador ligado e o Cloudflare Tunnel ativo. Para uma URL fixa, o túnel com nome precisa de um domínio na Cloudflare; sem domínio, usa-se uma URL temporária `trycloudflare.com`, que muda a cada reinício e obriga a atualizar o `.env` do site.

## Licenças e marcas

- Logos, nomes e selos do C6 Bank e C6 Empresas: usar só os materiais permitidos ao parceiro credenciado e manter o aviso de parceiro (RN-015).
- Imagens do site atual do Wix: verificar a licença antes de reutilizar (algumas são banco de imagens do Wix). Na dúvida, trocar por imagens com licença livre ou fornecidas pela B2BSAFE.
- Dependências do projeto: só licenças permissivas (MIT, BSD, Apache 2.0).

## GitHub

- **Conta:** pessoal `gabrielcunhalima`.
- **Repositório:** privado (nome sugerido: `b2bsafe-site`, confirmado na `/configurar-repositorio`).
- GitHub Flow, environments `homologacao` e `producao` (produção com aprovação manual).

## Pessoas-chave

| Papel | Pessoa |
| --- | --- |
| Usuário-chave (homologação) | Gabriel (responsável pelo projeto) |
| Aprovador de deploy em produção | Gabriel (responsável pelo projeto) |
| Cliente que valida a demonstração | B2BSAFE Floripa |
| Encarregado de dados (DPO) | ti@b2bsafe.com.br |

## Restrições gerais

- **Prazo:** demonstração no ar até 2026-12-06.
- **Orçamento:** baixo. Só a hospedagem compartilhada e o domínio são pagos; o resto fica em planos gratuitos.
- **Equipe:** uma pessoa (o responsável), que domina PHP/Laravel.
- **Demonstração isolada:** a demonstração não usa nada do site atual (e-mail, domínio, contas).

## Histórico de alterações

| Data | ID | Mudança | Origem |
| --- | --- | --- | --- |
| 2026-11-06 | — | Criação do documento | /iniciar-projeto |
