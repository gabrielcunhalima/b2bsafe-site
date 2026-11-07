# ADR-005 — Chatbot em n8n com Mistral e RAG no Qdrant, via proxy Laravel

- **Data:** 2026-11-06 · **Status:** aceito

## Contexto
O responsável quer um assistente virtual como diferencial, em n8n com Mistral, construído do zero (o anterior se perdeu). A base inclui o conteúdo do site, um FAQ e materiais do C6/B2BSAFE. O n8n não roda na hospedagem compartilhada. O chatbot anterior (FAPEU) usava manual no prompt com recorte por seção e deixou lições sobre robustez e limite de tokens.

## Decisão
- **Widget próprio** no site; o navegador fala só com o Laravel.
- O **Laravel faz de proxy**: valida, aplica limites, mascara dados sensíveis, chama o webhook do n8n com segredo e timeout de 10 s, e grava conversas e leads. O n8n não acessa o banco do site.
- **n8n** com dois workflows versionados no repositório (sem credenciais):
  - **atendimento:** busca no Qdrant, prompt com as regras fixas primeiro, Mistral, resposta em JSON;
  - **ingestão:** documentos de `chatbot/base/`, trechos, `mistral-embed`, Qdrant.
- **Qdrant** como banco vetorial, em Docker junto com o n8n.
- Na demonstração, tudo em Docker no computador do responsável, exposto por Cloudflare Tunnel (trycloudflare).
- Lições aplicadas do bot anterior: o fluxo nunca devolve erro (sempre 200 com texto e um `diagnostico`), o JSON do modelo é lido por chaves balanceadas, o contexto é limitado, a chave fica em credencial do n8n e o webhook só aceita o Laravel.

## Consequências
- Na demonstração, o chat só funciona com o computador ligado; a URL do túnel muda a cada reinício (script para atualizar o `.env` do site).
- Produção exige hospedar n8n e Qdrant (VPS barata ou n8n Cloud com Qdrant Cloud gratuito), decisão antes do go-live.
- O RAG precisa de ajuste de trechos e limiares e de testes de conversa (RN-014).
- As conversas saem do Brasil (Mistral, França): aviso e consentimento no chat (RF-013).
