# Estado do projeto

- **Fase atual:** Construção
- **Última skill executada:** /implementar 1 em 2026-11-09
- **Versão em produção:** nenhuma
- **Milestone atual:** Entrega 1 — Landing page (até 2026-12-06); Entrega 2 — Assistente e painel depois
- **Incidentes abertos:** nenhum

## Pendências
- Incluir o check "Título no padrão Conventional Commits" como obrigatório no ruleset da `main`.
- Logo da B2BSAFE aplicado (PNG de 191 × 41 px, em `docs/marca/`). Pedir o SVG ou um PNG com pelo menos 3x esse tamanho, porque em telas retina o logo fica levemente desfocado.
- Baixar os SVGs oficiais de LinkedIn, Instagram, Facebook e WhatsApp nos kits de marca (exigem aceitar os termos) para trocar os desenhos provisórios em `resources/views/components/icone-marca.blade.php` (revisão do PR #35, D-001, #36).
- Rodar `gh auth refresh -s project` para eu criar o GitHub Project (quadro Backlog → Concluído) e adicionar as 32 issues.
- Repositório público temporariamente (decisão do responsável): ruleset da `main`, secret scanning, push protection e revisor em `producao` ativos. Ao voltar a privado, esses recursos param no plano Free.
- Confirmar a versão do MariaDB da Hostinger (local usa 11.8.9).
- Revisar e aprovar os wireframes (`docs/ux/wireframes/index.html`) e as 4 propostas marcadas em `docs/10-ux.md`.
- Imagens da Home: o selo Conexão Awards 2025 já é a imagem oficial fornecida. A imagem da C6 Pay fornecida pelo responsável está na seção Maquininha; falta só confirmar com a B2BSAFE a permissão de uso da imagem do C6. A foto do hero segue como composição com ícones até haver foto licenciada.
- Revisão jurídica da Política de Privacidade do site (`/privacidade`, texto novo) pela B2BSAFE antes da produção.
- Confirmar com a B2BSAFE a tabela de taxas da C6 Pay (valores de referência do site do C6, consultados em 2026-11-07) e a permissão de uso da imagem da C6 Pay e dos logos de adquirentes.
- Confirmar o domínio definitivo (informado como "b2b.com.br"; pode ser `b2bsafe.com.br`).
- Fornecer os materiais do C6/B2BSAFE para a base do chatbot e confirmar se podem ser usados.
- Verificar a licença das imagens do site atual antes de reutilizá-las.
- Criar a senha de app do Gmail (demonstração) e as chaves da Mistral; cadastrar só no `.env` e nas credenciais do n8n.
- Criar a propriedade GA4 da demonstração.
- Conferir na `/configurar-infra` o PHP de linha de comando da Hostinger (funções `proc_open`/`exec` para o agendador), a versão do MariaDB e o armazenamento do backup externo.
- Antes da produção: hospedar o n8n e o Qdrant fora do computador do responsável (ADR-005).

## Próximos passos
1. `/revisar` do PR da Home (#2) e merge.
2. `/implementar 8` — formulário de lead no Fale conosco (com #7 origem e #9 deduplicação), depois #10 (e-mail), #11 (WhatsApp), #3 (Maquininha), #4/#5 (políticas), #12/#13 (cookies e GA4), #39 (SEO) e #40 (deploy).

## Auditorias (última execução)
| Tipo | Data | Resultado |
| --- | --- | --- |

## Histórico
| Data | Skill | Resumo |
| --- | --- | --- |
| 2026-11-06 | /site-para-markdown | Conteúdo do site atual (b2bsafe.com.br) extraído em `conteudo/www.b2bsafe.com.br.md`. |
| 2026-11-06 | /iniciar-projeto | Descoberta concluída: 30 RF (25 no MVP), 21 RN, 33 RNF, 12 tabelas, 7 ADRs, 19 telas + 2 e-mails, 32 histórias. |
| 2026-11-07 | /desenhar-telas | Mapa de navegação, 19 telas + 2 e-mails em wireframes, design system (WCAG AA). RF-001 e RF-002 alterados, RF-031 novo (sino de notificações): 31 RF, 26 no MVP. |
| 2026-11-07 | /configurar-repositorio | Repositório privado github.com/gabrielcunhalima/b2bsafe-site; 16 labels, milestones MVP e v1.0, 32 issues (#1–#32), merge só por squash, environments, Dependabot. Ruleset, secret scanning e revisor obrigatório recusados pelo plano Free. |
| 2026-11-07 | (repositório) | Repositório tornado público; ruleset da `main`, secret scanning, push protection, relato privado e revisor em `producao` aplicados. |
| 2026-11-07 | /scaffold | Laravel 13.40 + Filament 5.11 + Flowforge, 12 models/migrations do domínio, enums, Docker (MariaDB 11.8.9, Mailpit, n8n 2.46.6, Qdrant 1.20, cloudflared), Pint, Larastan 6, Pest 5 (15 testes + 2 E2E), Lefthook, hook do Claude Code. Setup do zero e check verdes. |
| 2026-11-09 | /configurar-ci | Workflows CI (Pint, Larastan, Pest no MariaDB com cobertura mínima 70% — atual 98,2%, build, audit, Gitleaks), E2E, CodeQL e título do PR; 9 checks obrigatórios na `main`; docs/infra.md e selos no README. |
| 2026-11-09 | /implementar 1 | Layout base: cabeçalho com âncoras e item ativo, menu móvel acessível, rodapé com dados legais, redes e aviso de parceiro C6 (RN-015). 7 testes de feature e 11 no navegador. |
| 2026-11-09 | /revisar 35 | Layout base aprovado com ressalvas, sem bloqueantes. Ajustados: item ativo ao voltar ao topo, formatação de telefone testada (`App\Support\Telefone`), aviso de nova aba, área de toque dos links legais, item ativo no menu móvel. Logos oficiais das redes viraram o débito D-001. |
| 2026-11-09 | (planejamento) | MVP dividido em Entrega 1 (landing page: #1–#13, #36, SEO #39, deploy #40) e Entrega 2 (assistente e painel: #14–#32, sino #38). #10 ficou só com o e-mail. |
| 2026-11-09 | /implementar 2 | Home institucional com as 8 seções do T-01; 13 testes novos (feature e navegador). Lighthouse mobile: desempenho 97, acessibilidade 100, boas práticas 100, SEO 63 só pelo `noindex` proposital da demonstração. |
| 2026-11-09 | /implementar 7, 8, 9, 10, 11 | Captação: primeiro toque e classificação do canal, formulário de lead com deduplicação, e-mail pela fila (conferido no Mailpit) e registro de cliques no WhatsApp com botão flutuante. 47 testes novos. |
| 2026-11-09 | /implementar 3, 6 | Página Maquininha (taxas em configuração, formulário com o serviço já escolhido) e 404 com links úteis. |
| 2026-11-09 | /implementar 4, 5 | `/privacidade` (texto novo, versão e data em configuração) e `/policy` do Connect com as seções corrigidas e 301 de `/policy.`. |
