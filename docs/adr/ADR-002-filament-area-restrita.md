# ADR-002 — Filament 5 na área restrita

- **Data:** 2026-11-06 · **Status:** aceito

## Contexto
A área restrita precisa de dashboard com gráficos, listas com filtros e exportação, ficha do lead, kanban, gestão de usuários e auditoria (RF-018 a RF-030), em pouco tempo.

## Decisão
Usar Filament 5 (Livewire 4) em `/painel`, com relaticle/flowforge 4 para o kanban e os widgets nativos (Chart.js) no dashboard. Filament em português do Brasil.

## Consequências
- Grande ganho de velocidade; visual consistente e responsivo.
- A acessibilidade e o tema precisam ser conferidos e ajustados para WCAG 2.2 AA e para a identidade da B2BSAFE.
- Dependência de um ecossistema de terceiros: atualizações maiores do Filament exigem migração.
- Os assets do Filament são publicados no build (a hospedagem não roda Node).
