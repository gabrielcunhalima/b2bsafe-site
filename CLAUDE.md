# B2BSAFE — site institucional, captação de leads e assistente virtual

Novo site da **B2BSAFE Floripa** (escritório parceiro oficial do C6 Empresas), que substitui o site Wix atual (b2bsafe.com.br). Ele tem três partes:

- **Site público:** Home, Maquininha, políticas, formulário de lead, WhatsApp, banner de cookies e GA4 com Consent Mode v2.
- **Assistente virtual:** chatbot com IA (n8n + Mistral + RAG no Qdrant), acessado por um proxy no Laravel.
- **Área restrita** (`/painel`): dashboard, origem e estratégia, leads, kanban, ficha, usuários e LGPD.

**Fase:** demonstração (MVP) até 2026-12-06, em `b2bsafe.gabrielcunhalima.dev`. O domínio definitivo e o e-mail contato@b2bsafe.com.br entram depois, só por configuração.

## Stack

- PHP 8.5 · Laravel 13 · Filament 5 (Livewire 4) + relaticle/flowforge (kanban)
- Blade + Tailwind CSS 4 + Alpine.js (Vite; assets compilados no CI)
- MariaDB · fila `database` + cron (`schedule:run`), sem processos persistentes
- spatie/laravel-analytics (GA4 Data API), SMTP (Gmail na demonstração)
- Chatbot: n8n 2.x + Qdrant 1.20 + Mistral (chat e `mistral-embed`), em Docker local, exposto por Cloudflare Tunnel (trycloudflare)
- Testes: Pest 5 (incluindo browser) · Pint · Larastan
- Hospedagem: Hostinger, compartilhada, plano Business (conta `u828679584`)

## Convenções

- **Idioma:** tudo em português: código, tabelas, colunas, variáveis, métodos, enums, rotas, interface, documentação e commits. Nomes sem acento, `snake_case` no banco e `camelCase`/`PascalCase` no PHP (ex.: `leads.primeiro_contato_em`, `StatusLead::EmContato`, `RegistrarLead`). As tabelas técnicas e as convenções do Laravel mantêm o padrão (ver [ADR-007](docs/adr/ADR-007-codigo-em-portugues.md)).
- **Commits:** Conventional Commits, com o tipo em inglês e a descrição em português (`feat: adiciona formulário de lead`).
- **Regras de negócio** ficam em Actions, Enums e classes de domínio testáveis, não em controllers nem em componentes do Filament. Todo teste de regra cita a RN.
- **Segredos** só no `.env` (servidor ou local) ou nas credenciais do n8n. Os workflows do n8n são exportados para `chatbot/workflows/` **sem credenciais**.
- **Rastreabilidade:** issue cita RF e RN; PR cita a issue. IDs em `docs/`.
- **Interface:** seguir `docs/ux/design-system.md` (tokens, componentes, WCAG 2.2 AA) e os wireframes em `docs/ux/wireframes/`. Fonte única **Urbanist** (hospedada localmente); cores do logo: branco/gelo `#F4F5F7`, preto `#060606`, amarelo `#FFCC29`. Regras fundamentais, sem exceção:
  - **sem emojis**: ícones só do [Lucide](https://lucide.dev) (logos de marcas com o SVG oficial);
  - **sem eyebrows** (rótulo pequeno acima de títulos);
  - **sem bordas de um lado só** (`border-l-4`, `border-t-2`, sublinhado de aba etc.); divisórias neutras de 1 px entre linhas de tabela e lista são permitidas.
- **Python** neste computador: usar `py` (não `python3`).

## Documentação

- [Visão](docs/00-visao.md) · [Atores](docs/01-atores.md) · [Requisitos funcionais](docs/02-requisitos-funcionais.md) · [Regras de negócio](docs/03-regras-de-negocio.md) · [RNF](docs/04-requisitos-nao-funcionais.md)
- [Integrações e restrições](docs/05-integracoes-e-restricoes.md) (inclui o contrato do webhook do chatbot) · [Modelo de dados](docs/06-modelo-de-dados.md) · [Stack e arquitetura](docs/07-stack-e-arquitetura.md) · [ADRs](docs/adr/)
- [MVP](docs/08-mvp.md) · [Telas](docs/09-plano-prototipo.md) · [UX e wireframes](docs/10-ux.md) · [Design system](docs/ux/design-system.md) · [Backlog](docs/backlog.md)
- [Estado do projeto](docs/ESTADO.md) · [Checklist](docs/CHECKLIST.md)
- Conteúdo do site atual (referência, não publicar): [conteudo/www.b2bsafe.com.br.md](conteudo/www.b2bsafe.com.br.md)

## Comandos

Os mesmos comandos rodam localmente e no CI. Neste Windows, o Composer está em `C:\Users\Alejandro\AppData\Local\Programs\Composer`: no PowerShell, use `composer`; no Git Bash, use `php /c/Users/Alejandro/AppData/Local/Programs/Composer/composer.phar`.

| Comando | O que faz |
| --- | --- |
| `composer setup` | Prepara tudo do zero: dependências, `.env`, chave do n8n, Docker (MariaDB e Mailpit), migrations com seed, build dos assets e hooks do git |
| `composer dev` | Servidor em http://127.0.0.1:8000, Vite (recarrega o navegador a cada alteração) e fila; exige o Docker Desktop aberto |
| `composer lint` / `composer format` | Confere / aplica a formatação (Pint) |
| `composer analyse` | Análise estática (Larastan nível 6) |
| `composer test` | Testes unitários e de feature (Pest, MariaDB na base `b2bsafe_testes`) |
| `composer test:e2e` | Testes no navegador (Pest Browser + Playwright); exige `npm run build` e `npx playwright install chromium` |
| `composer check` | lint + analyse + test (o que o CI exige) |
| `docker compose up -d` | MariaDB (3314), Mailpit (8026), n8n (5679) e Qdrant (6335), só em 127.0.0.1 |
| `docker compose --profile app up -d` | Também a aplicação em container (http://localhost:8014), alternativa ao `composer dev` |
| `docker compose --profile tunel up -d` | Túnel trycloudflare do n8n para a demonstração |

Usuários locais do seed: `admin@b2bsafe.test` e `atendente@b2bsafe.test` (senha `senha-local-123`, só para desenvolvimento). Painel em `/painel`, health check em `/saude`.

## Estrutura

```
app/Enums            StatusLead, MotivoPerda, PerfilUsuario... (valores fixos com rótulo em português)
app/Models           Usuario (tabela usuarios, coluna senha), Lead, Origem, Conversa... (docs/06)
app/Actions          regras de negócio testáveis (criadas nas issues)
app/Filament         recursos e páginas do painel; provider em app/Providers/Filament
config/b2bsafe.php   serviços, números de WhatsApp, versões das políticas, chatbot, GA4
resources/views      components/layouts/site, paginas/, errors/
resources/css        app.css (tokens do design system) e filament/painel/theme.css
chatbot/             base de conhecimento (.md) e workflows do n8n exportados sem credenciais
docker/              Dockerfile da app, init do MariaDB, gerador da chave do n8n
tests/               Unit (puro), Feature (HTTP + banco), Browser (E2E)
```

## Convenções de código

- Regras de negócio em `app/Actions` (uma classe por caso de uso, ex.: `RegistrarLead`), nunca em controllers ou recursos do Filament. Cada RN tem teste que a cita (`it('... (RN-003)')`).
- Status, perfis e motivos são enums em `app/Enums`, gravados como texto e com rótulo via `getLabel()`.
- Models com atributos PHP (`#[Table]`, `#[Fillable]`), casts para os enums e `@property` quando o Larastan precisar do tipo.
- Datas em UTC no banco; o painel exibe em America/Sao_Paulo (`FilamentTimezone`).
- O hook do Claude Code (`.claude/settings.json`) formata com o Pint cada PHP editado; o Lefthook formata no commit e confere a mensagem (Conventional Commits).
- Assets do Filament (`public/js|css|fonts/filament`) são gerados no `composer install` e não vão para o git.
