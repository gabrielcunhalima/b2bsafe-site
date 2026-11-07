# Infraestrutura

Hospedagem, ambientes, backup e observabilidade são detalhados na `/configurar-infra`. Esta página começa pelo CI.

## CI

Workflows em `.github/workflows/`. Todos rodam com permissões mínimas (`contents: read`) e cancelam execuções antigas do mesmo PR.

| Workflow | Quando roda | Job (nome do check) | O que faz | Rodar localmente |
| --- | --- | --- | --- | --- |
| `ci.yml` | Todo PR e push na `main` | Formatação (Pint) | Confere a formatação do PHP | `composer lint` |
| | | Análise estática (Larastan) | Larastan nível 6 em `app`, `config`, `database`, `routes` | `composer analyse` |
| | | Testes (Pest + MariaDB) | Testes Unit e Feature no MariaDB 11.8.9 (mesmo banco da produção), com **cobertura mínima de 70%** (PCOV); o percentual aparece no resumo da execução | `composer test` (cobertura: `composer test:cobertura`, exige PCOV ou Xdebug) |
| | | Build do frontend (Vite) | `npm ci` + `npm run build` | `npm run build` |
| | | Auditoria de dependências | `composer audit` e `npm audit --audit-level=high` | os mesmos comandos |
| | | Varredura de segredos (Gitleaks) | Procura chaves e senhas em todo o histórico | — |
| `e2e.yml` | PRs para a `main` | E2E (navegador) | Build dos assets, Chromium do Playwright e `composer test:e2e`; capturas de tela das falhas ficam como artefato por 7 dias | `npx playwright install chromium && composer test:e2e` |
| `codeql.yml` | PRs, push na `main` e toda segunda às 9h17 (UTC) | CodeQL (javascript-typescript / actions) | Análise de segurança do JavaScript e dos workflows. O CodeQL não suporta PHP; o PHP fica com Larastan, `composer audit` e a revisão | — |
| `pr-titulo.yml` | Abertura e edição de PRs | Título no padrão Conventional Commits | O título vira o commit do squash e alimenta o changelog | o Lefthook confere as mensagens de commit locais |

O `composer check` (lint + analyse + test) é o mesmo conjunto que o CI exige.

### Checks obrigatórios na `main`

O ruleset "Proteção da main" exige PR, histórico linear e merge por squash, e proíbe force push e exclusão. Os jobs acima entram como checks obrigatórios depois do primeiro run verde.

> O ruleset, o secret scanning e o push protection só funcionam enquanto o repositório for **público** (plano GitHub Free). Se ele voltar a ser privado, essas proteções deixam de valer; a varredura de segredos continua no job do Gitleaks.

### Dependências

O Dependabot (`.github/dependabot.yml`) abre PRs semanais (segunda, 7h) para composer, npm, Docker Compose e GitHub Actions, agrupando atualizações menores.
