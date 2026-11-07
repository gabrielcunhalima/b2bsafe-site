# ADR-001 — Monólito Laravel 13 em hospedagem compartilhada

- **Data:** 2026-11-06 · **Status:** aceito

## Contexto
Site institucional com pouco acesso simultâneo, orçamento baixo, uma pessoa desenvolvendo (que domina PHP/Laravel) e prazo de 1 mês. Hospedagem escolhida: compartilhada da Hostinger (PHP + MariaDB, cron, SSH, sem Docker nem processos persistentes).

## Decisão
Um único projeto Laravel 13 (PHP 8.5) com o site público e a área restrita, publicado na hospedagem compartilhada. Tudo que precisaria de processo contínuo vira tarefa agendada por cron.

## Consequências
- Custo baixo e operação simples; um repositório e um deploy.
- Sem WebSocket, Redis ou workers: notificações por e-mail e atualização das telas por polling, se for preciso.
- Para escalar ou rodar o n8n junto, seria preciso migrar para VPS; o código continua o mesmo.
- Plano Hostinger Business já contratado, com PHP 8.5 disponível (conferido em 2026-11-06). No PHP web, `exec`, `proc_open` e `symlink` estão desativados: o link simbólico do deploy é criado pelo SSH, e o PHP de linha de comando do cron precisa ser conferido.
