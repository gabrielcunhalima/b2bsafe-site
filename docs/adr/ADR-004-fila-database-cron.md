# ADR-004 — Fila no banco e tarefas por cron

- **Data:** 2026-11-06 · **Status:** aceito

## Contexto
A hospedagem compartilhada não mantém processos persistentes. O e-mail não pode bloquear a gravação de leads (RNF-007), e há tarefas periódicas (RF-022, RF-027, RF-029, backup).

## Decisão
Fila com driver `database`. Um cron por minuto executa `php artisan schedule:run`, e o agendador inclui `queue:work --stop-when-empty --max-time=50` e as tarefas periódicas, com `withoutOverlapping()`.

## Consequências
- E-mails saem em até ~1 minuto depois do envio do lead.
- A fila precisa ser monitorada (`failed_jobs`, com alerta).
- Nada de filas em tempo real, o que é suficiente para o volume esperado.
