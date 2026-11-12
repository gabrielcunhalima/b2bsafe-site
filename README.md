# B2BSAFE — site institucional, captação de leads e assistente virtual

[![CI](https://github.com/gabrielcunhalima/b2bsafe-site/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/gabrielcunhalima/b2bsafe-site/actions/workflows/ci.yml)
[![E2E](https://github.com/gabrielcunhalima/b2bsafe-site/actions/workflows/e2e.yml/badge.svg)](https://github.com/gabrielcunhalima/b2bsafe-site/actions/workflows/e2e.yml)
[![CodeQL](https://github.com/gabrielcunhalima/b2bsafe-site/actions/workflows/codeql.yml/badge.svg?branch=main)](https://github.com/gabrielcunhalima/b2bsafe-site/actions/workflows/codeql.yml)

Novo site da **B2BSAFE Floripa**, escritório parceiro C6 Empresas. Substitui o site atual em Wix e tem três partes:

- **Site público:** Home, Maquininha C6 Pay, políticas, formulário de lead, WhatsApp, banner de cookies e Google Analytics 4 com Consent Mode v2.
- **Assistente virtual:** chatbot com IA (n8n + Mistral + base de conhecimento no Qdrant), acessado por um proxy no Laravel.
- **Área restrita** (`/painel`): dashboard, origem dos leads, lista, funil em kanban, ficha do lead, usuários e LGPD.

> **Fase atual:** demonstração (MVP) até 06/12/2026, em `b2bsafe.gabrielcunhalima.dev`. Ver [docs/ESTADO.md](docs/ESTADO.md).

## Stack

PHP 8.5 · Laravel 13 · Filament 5 · Tailwind CSS 4 · Alpine.js · MariaDB · n8n · Qdrant · Mistral · hospedagem compartilhada Hostinger.

## Como rodar localmente

Pré-requisitos: PHP 8.5, Composer, Node 24 e Docker.

```bash
composer setup     # dependências, .env, Docker (MariaDB e Mailpit), banco com dados de exemplo, assets e hooks
composer dev       # servidor, Vite e fila
composer check     # formatação, análise estática e testes (o mesmo que o CI)
```

Detalhes dos comandos e do ambiente Docker no [CLAUDE.md](CLAUDE.md#comandos); CI em [docs/infra.md](docs/infra.md#ci).

## Documentação

| Assunto | Onde |
| --- | --- |
| Visão, atores e requisitos | [docs/00-visao.md](docs/00-visao.md) a [docs/04-requisitos-nao-funcionais.md](docs/04-requisitos-nao-funcionais.md) |
| Integrações, dados e arquitetura | [docs/05-integracoes-e-restricoes.md](docs/05-integracoes-e-restricoes.md), [docs/06-modelo-de-dados.md](docs/06-modelo-de-dados.md), [docs/07-stack-e-arquitetura.md](docs/07-stack-e-arquitetura.md), [docs/adr/](docs/adr/) |
| MVP e backlog | [docs/08-mvp.md](docs/08-mvp.md), [docs/backlog.md](docs/backlog.md) |
| Telas, wireframes e design system | [docs/10-ux.md](docs/10-ux.md), [docs/ux/](docs/ux/) |
| Como contribuir | [CONTRIBUTING.md](CONTRIBUTING.md) |

## Licença

Código proprietário da B2BSAFE. Todos os direitos reservados.
