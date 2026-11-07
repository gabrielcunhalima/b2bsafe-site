# Estado do projeto

- **Fase atual:** UX
- **Última skill executada:** /desenhar-telas em 2026-11-07
- **Versão em produção:** nenhuma
- **Milestone atual:** MVP (demonstração até 2026-12-06)
- **Incidentes abertos:** nenhum

## Pendências
- Revisar e aprovar os wireframes (`docs/ux/wireframes/index.html`) e as 4 propostas marcadas em `docs/10-ux.md`.
- Confirmar com a B2BSAFE a tabela de taxas da C6 Pay (valores de referência do site do C6, consultados em 2026-11-07) e a permissão de uso da imagem da C6 Pay e dos logos de adquirentes.
- Confirmar o domínio definitivo (informado como "b2b.com.br"; pode ser `b2bsafe.com.br`).
- Fornecer os materiais do C6/B2BSAFE para a base do chatbot e confirmar se podem ser usados.
- Verificar a licença das imagens do site atual antes de reutilizá-las.
- Criar a senha de app do Gmail (demonstração) e as chaves da Mistral; cadastrar só no `.env` e nas credenciais do n8n.
- Criar a propriedade GA4 da demonstração.
- Conferir na `/configurar-infra` o PHP de linha de comando da Hostinger (funções `proc_open`/`exec` para o agendador), a versão do MariaDB e o armazenamento do backup externo.
- Antes da produção: hospedar o n8n e o Qdrant fora do computador do responsável (ADR-005).

## Próximos passos
1. `/configurar-repositorio` — repositório privado `gabrielcunhalima/b2bsafe-site`, labels, milestone MVP e as 32 histórias do backlog como issues.
2. `/scaffold` — Laravel 13 + Filament 5 + Docker (MariaDB, Mailpit, n8n, Qdrant, cloudflared).
3. `/configurar-ci`.

## Auditorias (última execução)
| Tipo | Data | Resultado |
| --- | --- | --- |

## Histórico
| Data | Skill | Resumo |
| --- | --- | --- |
| 2026-11-06 | /site-para-markdown | Conteúdo do site atual (b2bsafe.com.br) extraído em `conteudo/www.b2bsafe.com.br.md`. |
| 2026-11-06 | /iniciar-projeto | Descoberta concluída: 30 RF (25 no MVP), 21 RN, 33 RNF, 12 tabelas, 7 ADRs, 19 telas + 2 e-mails, 32 histórias. |
| 2026-11-07 | /desenhar-telas | Mapa de navegação, 19 telas + 2 e-mails em wireframes, design system (WCAG AA). RF-001 e RF-002 alterados, RF-031 novo (sino de notificações): 31 RF, 26 no MVP. |
