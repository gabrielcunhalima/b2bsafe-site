# ADR-007 — Nomes do código em português

- **Data:** 2026-11-06 · **Status:** aceito

## Contexto
O padrão da família de skills é código em inglês. O responsável escolheu tudo em português.

## Decisão
Tabelas, colunas, models, variáveis, métodos, enums e rotas em português, em `snake_case` ou `camelCase` sem acento (ex.: `leads.primeiro_contato_em`, `StatusLead::EmContato`, `RegistrarLead`).

As tabelas técnicas e as convenções do framework mantêm os nomes padrão (`jobs`, `sessions`, `created_at` etc.). O model de usuário se chama `Usuario` e usa `$table = 'usuarios'`.

Commits seguem Conventional Commits com o tipo em inglês e a descrição em português.

## Consequências
- Leitura natural para o domínio de negócio.
- Mistura inevitável com a API do Laravel em inglês (`hasMany`, `created_at`).
- É preciso configurar a pluralização onde o Laravel erra, além de ajustar a autenticação e o Filament para o model `Usuario`.
