# Como contribuir

## Fluxo (GitHub Flow)

1. Todo trabalho parte de uma **issue** com objetivo, critérios de aceite, RF/RN e telas (Definição de Pronto).
2. Crie a branch a partir da `main` atualizada:
   - `feat/<issue>-<slug>` (funcionalidade), `fix/<issue>-<slug>` (correção)
   - `chore/<slug>`, `docs/<slug>`, `hotfix/<slug>`
   - Exemplo: `feat/8-formulario-de-lead`
3. Abra um **PR para a `main`**, preenchendo o modelo e citando a issue (`Closes #8`).
4. O PR só entra com **CI verde** e revisão. O merge é sempre por **squash**.
5. A `main` está sempre pronta para deploy. Nada de commit direto nela.

## Commits

[Conventional Commits](https://www.conventionalcommits.org/pt-br/v1.0.0/), com o tipo em inglês e a descrição em português:

```
feat: adiciona formulário de lead
fix: corrige máscara do WhatsApp com DDD 11
docs: registra decisão sobre a fila
```

Tipos: `feat`, `fix`, `chore`, `docs`, `refactor`, `test`, `ci`, `perf`.

## Código

- Código, banco, rotas e mensagens em **português**, sem acentos nos nomes ([ADR-007](docs/adr/ADR-007-codigo-em-portugues.md)).
- Regras de negócio em Actions, Enums e classes de domínio, cobertas por testes que citam a RN.
- Interface conforme o [design system](docs/ux/design-system.md): sem emojis (ícones Lucide), sem eyebrows, sem bordas de um lado só, fonte Urbanist e WCAG 2.2 AA.
- Segredos nunca entram no repositório: só no `.env` ou nas credenciais do n8n. Os workflows do n8n são exportados sem credenciais.

## Definição de Concluído

- [ ] Código revisado e CI verde
- [ ] Testes cobrindo as regras de negócio afetadas
- [ ] Documentação e `CHANGELOG.md` (`[Unreleased]`) atualizados
- [ ] Validado em homologação

## Rastreabilidade

Issue cita os RF e RN que atende; PR cita a issue. Requisito ou regra nova vai para `docs/` com um novo ID e uma linha no histórico de alterações.
