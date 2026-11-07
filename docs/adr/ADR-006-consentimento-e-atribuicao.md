# ADR-006 — Consentimento de cookies e atribuição de origem própria

- **Data:** 2026-11-06 · **Status:** aceito

## Contexto
O proprietário quer saber de onde vêm os leads. O GA4 só pode coletar com consentimento (LGPD) e não liga as visitas a leads individuais.

## Decisão
- Banner de cookies próprio (Alpine), integrado ao **Google Consent Mode v2**, com padrão negado.
- **Atribuição própria:** um middleware guarda o primeiro toque (UTM, gclid, fbclid, referrer, página de entrada) na sessão, ou num cookie de 90 dias com consentimento estatístico, e o grava no lead, na conversa ou no clique (RN-008, RN-009).
- O painel cruza a atribuição própria (leads e conversões) com as métricas do GA4 (visitas).

## Consequências
- Os relatórios de leads por origem funcionam mesmo para quem recusa cookies (dentro da sessão).
- Os números do GA4 e os do painel não batem 1:1, e o painel avisa isso.
- Não depende de uma ferramenta paga de gestão de consentimento.
