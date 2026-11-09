# Estado do projeto

- **Fase atual:** Construção
- **Última skill executada:** /implementar 1 em 2026-11-09
- **Versão em produção:** nenhuma
- **Milestone atual:** MVP (demonstração até 2026-12-06)
- **Incidentes abertos:** nenhum

## Pendências
- Incluir o check "Título no padrão Conventional Commits" como obrigatório no ruleset da `main`.
- Fornecer o logo da B2BSAFE em SVG (o cabeçalho e o rodapé usam o nome em texto até lá).
- Baixar os SVGs oficiais de LinkedIn, Instagram, Facebook e WhatsApp nos kits de marca (exigem aceitar os termos) para trocar os desenhos provisórios em `resources/views/components/icone-marca.blade.php` (revisão do PR #35, D-001, #36).
- Rodar `gh auth refresh -s project` para eu criar o GitHub Project (quadro Backlog → Concluído) e adicionar as 32 issues.
- Repositório público temporariamente (decisão do responsável): ruleset da `main`, secret scanning, push protection e revisor em `producao` ativos. Ao voltar a privado, esses recursos param no plano Free.
- Confirmar a versão do MariaDB da Hostinger (local usa 11.8.9).
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
1. Merge do PR de ajustes da revisão do layout.
2. `/implementar 2` — Home institucional (seções que as âncoras do menu já apontam).

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
