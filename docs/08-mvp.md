# 08 — MVP

O MVP é a **versão de demonstração** para a B2BSAFE, em `b2bsafe.gabrielcunhalima.dev`, até **2026-12-06**. Ela tem que mostrar o ciclo completo: o visitante chega por uma campanha, conversa com o assistente ou preenche o formulário, o lead aparece no painel com a origem e a equipe trata o lead no funil.

## Entregas (decisão de 2026-11-09)

O MVP foi dividido em duas entregas. O foco agora é 100% na **Entrega 1**.

| Entrega | Escopo | Issues |
| --- | --- | --- |
| **1 — Landing page** | Site público completo: layout e Home, Maquininha, `/privacidade`, `/policy`, 404, atribuição de origem, formulário de lead com deduplicação e e-mail, WhatsApp com registro de clique, banner de cookies, GA4 com Consent Mode v2, SEO técnico (RF-011, antecipado da v1.0) e deploy na Hostinger | #1–#13, #36, #39 (SEO), #40 (deploy) |
| **2 — Assistente e painel** | Assistente virtual (n8n, Mistral, Qdrant), área restrita `/painel`, sino de notificações (RF-031), LGPD automatizada e backup | #14–#32, #38 (sino) |

Na Entrega 1, os leads do formulário ficam gravados no banco e chegam por e-mail. O painel para tratá-los chega na Entrega 2.

## Incluídos no MVP (26 RF, todos "must")

| Bloco | RF |
| --- | --- |
| Site público | RF-001 Home, RF-002 Maquininha, RF-003 `/privacidade`, RF-004 `/policy` (Connect) |
| Captação | RF-005 WhatsApp, RF-006 Formulário, RF-007 E-mail de lead, RF-008 Atribuição de origem |
| Consentimento e medição | RF-009 Banner de cookies, RF-010 GA4 com Consent Mode v2 |
| Assistente virtual | RF-013 Widget, RF-014 Proxy para o n8n, RF-015 Lead pelo chat, RF-016 Transbordo para o WhatsApp, RF-017 Histórico |
| Área restrita | RF-018 Autenticação, RF-019 Usuários, RF-020 Dashboard, RF-021 Origem e estratégia, RF-023 Lista, RF-024 Ficha, RF-025 Kanban, RF-026 CSV, RF-031 Notificação no painel |
| LGPD | RF-029 Retenção automática, RF-030 Direitos do titular e auditoria |

Entregas fora do Laravel que também fazem parte do MVP:
- Workflows do n8n (atendimento e ingestão) versionados, com a base inicial em `chatbot/base/`: conteúdo do site, FAQ e os materiais do C6/B2BSAFE que forem fornecidos.
- Ambiente Docker local (app, MariaDB, Mailpit, n8n, Qdrant, cloudflared) e o script que atualiza a URL do túnel no site.

## Fora do MVP

| RF | Por quê | Quando |
| --- | --- | --- |
| RF-012 Redirecionamentos das URLs antigas | Só se aplicam quando o domínio atual migrar do Wix | Antes da produção (v1.0) |
| RF-022 Métricas do GA4 no painel | Exige conta de serviço e dados acumulados; na demonstração o GA4 ainda não tem histórico | Logo após a demonstração (v1.0); entra no MVP se sobrar prazo |
| RF-027 Resumo semanal | Depende de dados de semanas inteiras | v1.0 |
| RF-028 Insights do chatbot | Depende de volume de conversas; os campos `topico` e `sem_resposta` já são gravados desde o MVP | v1.0 |
| Distribuição de leads e alerta de lead parado | Pedido como opcional | v1.1 |
| Custo e ROI de anúncios, blog, edição de conteúdo pelo painel, área do cliente, CRM | Fora de escopo (00-visao) | Avaliar após a v1.0 |

> **Antes da produção (v1.0):** além dos RF acima, hospedar o n8n e o Qdrant fora do computador do responsável (ADR-005), trocar o SMTP e o destinatário para contato@b2bsafe.com.br, confirmar o domínio definitivo e configurar o GA4 do proprietário.

## Critérios para considerar o MVP pronto

- [ ] Todos os 26 RF "must" atendem seus critérios de aceite, validados em `b2bsafe.gabrielcunhalima.dev`.
- [ ] Fluxo ponta a ponta demonstrável:
  - acesso com `?utm_source=instagram&utm_campaign=teste`;
  - aceite de cookies, com o GA4 recebendo `page_view` e `generate_lead`;
  - pergunta ao chatbot respondida pela base;
  - lead criado pelo chat;
  - e-mail no Gmail;
  - lead no painel com origem "Campanha (instagram)";
  - movido no kanban até Convertido;
  - aparece no dashboard e no relatório de origem.
- [ ] Com o n8n desligado, o chat mostra o fallback (WhatsApp e formulário) em até 10 s, e o restante do site funciona.
- [ ] Nenhum link quebrado; os problemas listados em "Observações para o novo site" estão corrigidos.
- [ ] Lighthouse mobile ≥ 90 nas quatro categorias da Home e da Maquininha; axe sem violações graves.
- [ ] Testes das regras de negócio (RN-001 a RN-021) passando no CI; E2E de formulário, chat com fallback, login e kanban.
- [ ] Nenhum segredo no repositório; `.env.example` documentado.
- [ ] Backup diário do banco funcionando e uma restauração testada.

## Plano de 4 semanas (estimativa)

| Semana | Foco |
| --- | --- |
| 1 (até 11-13) | Telas (`/desenhar-telas`), repositório, scaffold, CI, ambiente Docker com n8n e Qdrant |
| 2 (até 11-20) | Site público, formulário, WhatsApp, atribuição de origem, cookies e GA4, e-mail |
| 3 (até 11-27) | Chatbot: workflows n8n e base RAG, widget, proxy, lead pelo chat; área restrita: login, usuários, lista, ficha |
| 4 (até 12-06) | Dashboard, origem, kanban, CSV, LGPD (retenção e anonimização), testes, deploy na demonstração, ensaio da apresentação |

**Risco principal:** o prazo, para uma pessoa só. Se apertar, a ordem de corte é RF-026 (CSV) → RF-021 (origem: o dashboard já mostra o canal) → RF-019 (usuários; criar o admin por comando). O chatbot e o funil ficam, porque são o diferencial da demonstração.

## Histórico de alterações

| Data | ID | Mudança | Origem |
| --- | --- | --- | --- |
| 2026-11-06 | — | Criação do documento | /iniciar-projeto |
| 2026-11-07 | RF-031 | Notificação de novo lead no painel entra no MVP | /desenhar-telas |
| 2026-11-09 | RF-011, RF-007, RF-031 | MVP dividido em Entrega 1 (landing page) e Entrega 2 (assistente e painel); SEO técnico antecipado para a Entrega 1; e-mail de lead (RF-007) na Entrega 1 e sino (RF-031) na Entrega 2 | Pedido do responsável |
