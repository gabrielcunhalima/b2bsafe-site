# B2BSAFE — site institucional, captação de leads e assistente virtual

Novo site da **B2BSAFE Floripa**, escritório parceiro oficial do C6 Empresas. Substitui o site atual em Wix e tem três partes:

- **Site público:** Home, Maquininha C6 Pay, políticas, formulário de lead, WhatsApp, banner de cookies e Google Analytics 4 com Consent Mode v2.
- **Assistente virtual:** chatbot com IA (n8n + Mistral + base de conhecimento no Qdrant), acessado por um proxy no Laravel.
- **Área restrita** (`/painel`): dashboard, origem dos leads, lista, funil em kanban, ficha do lead, usuários e LGPD.

> **Fase atual:** demonstração (MVP) até 06/12/2026, em `b2bsafe.gabrielcunhalima.dev`. Ver [docs/ESTADO.md](docs/ESTADO.md).

## Stack

PHP 8.5 · Laravel 13 · Filament 5 · Tailwind CSS 4 · Alpine.js · MariaDB · n8n · Qdrant · Mistral · hospedagem compartilhada Hostinger.

## Como rodar localmente

Será definido na `/scaffold` (ambiente Docker com app, MariaDB, Mailpit, n8n, Qdrant e túnel).

## Documentação

| Assunto | Onde |
| --- | --- |
| Visão, atores e requisitos | [docs/00-visao.md](docs/00-visao.md) a [docs/04-requisitos-nao-funcionais.md](docs/04-requisitos-nao-funcionais.md) |
| Integrações, dados e arquitetura | [docs/05-integracoes-e-restricoes.md](docs/05-integracoes-e-restricoes.md), [docs/06-modelo-de-dados.md](docs/06-modelo-de-dados.md), [docs/07-stack-e-arquitetura.md](docs/07-stack-e-arquitetura.md), [docs/adr/](docs/adr/) |
| MVP e backlog | [docs/08-mvp.md](docs/08-mvp.md), [docs/backlog.md](docs/backlog.md) |
| Telas, wireframes e design system | [docs/10-ux.md](docs/10-ux.md), [docs/ux/](docs/ux/) |
| Como contribuir | [CONTRIBUTING.md](CONTRIBUTING.md) |

## Licença

Código privado. Todos os direitos reservados.
