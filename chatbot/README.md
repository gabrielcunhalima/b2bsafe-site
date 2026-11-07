# Assistente virtual (n8n + Mistral + Qdrant)

Arquitetura e contrato do webhook: [docs/05-integracoes-e-restricoes.md](../docs/05-integracoes-e-restricoes.md) e [ADR-005](../docs/adr/ADR-005-chatbot-n8n-rag.md).

| Pasta | Conteúdo |
| --- | --- |
| `base/` | Documentos `.md` da base de conhecimento (conteúdo do site, FAQ, materiais do C6/B2BSAFE). Montada no n8n como `/documentos/b2bsafe` (só leitura). |
| `workflows/` | Workflows do n8n exportados **sem credenciais** (atendimento e ingestão). |

As credenciais (chave da Mistral, segredo do webhook, chave do Qdrant) ficam **só** no n8n local. Nunca exporte um workflow com credenciais nem coloque chaves nestes arquivos.

Subir o ambiente: `docker compose up -d` (n8n em http://localhost:5679). Túnel da demonstração: `docker compose --profile tunel up -d`. A URL gerada aparece em `docker compose logs cloudflared`.
