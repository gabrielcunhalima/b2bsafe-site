# ADR-003 — Site público em Blade, Tailwind e Alpine

- **Data:** 2026-11-06 · **Status:** aceito

## Contexto
O site é de conteúdo e precisa de Core Web Vitals bons, Lighthouse ≥ 90 e WCAG 2.2 AA (RNF-011, RNF-026). Redesenho novo.

## Decisão
Páginas Blade renderizadas no servidor, Tailwind CSS 4 e Alpine.js para interações pequenas (menu, banner de cookies, widget de chat), com build pelo Vite no CI. Imagens otimizadas (WebP/AVIF, `srcset`, carregamento sob demanda).

## Consequências
- Páginas leves e indexáveis, sem hidratação de SPA.
- O widget de chat é um componente Alpine carregado depois da página.
- O CI precisa de Node para gerar os assets; a hospedagem só recebe os arquivos prontos.
