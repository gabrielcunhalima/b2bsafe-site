# Checklist do ciclo de vida

Marque os itens à medida que as skills forem executadas. Cada skill da família atualiza este arquivo ao terminar.

## Descoberta — /iniciar-projeto
- [x] Visão, objetivos e escopo (`docs/00-visao.md`)
- [x] Atores e perfis (`docs/01-atores.md`)
- [x] Requisitos funcionais com critérios de aceite (`docs/02-requisitos-funcionais.md`)
- [x] Regras de negócio (`docs/03-regras-de-negocio.md`)
- [x] RNF com disponibilidade, janela de manutenção, RPO/RTO e retenção de logs (`docs/04-requisitos-nao-funcionais.md`)
- [x] Integrações, hospedagem, conta GitHub e pessoas-chave (`docs/05-integracoes-e-restricoes.md`)
- [x] Modelo de dados (`docs/06-modelo-de-dados.md`)
- [x] Stack, arquitetura e ADRs (`docs/07-stack-e-arquitetura.md`, `docs/adr/`)
- [x] MVP definido (`docs/08-mvp.md`) e lista de telas (`docs/09-plano-prototipo.md`)
- [x] Backlog do MVP (`docs/backlog.md`)
- [x] `CLAUDE.md` do projeto criado

## UX — /desenhar-telas
- [x] Mapa de navegação e inventário de telas (`docs/10-ux.md`)
- [ ] Wireframes validados (`docs/ux/wireframes/`) — prontos, aguardando aprovação do responsável
- [x] Design system (`docs/ux/design-system.md`)
- [x] Requisitos/regras descobertos no design registrados

## Repositório — /configurar-repositorio
- [ ] Arquivos base (.gitignore, README, CHANGELOG, CONTRIBUTING, SECURITY)
- [ ] Templates de issue e PR, CODEOWNERS, dependabot
- [ ] Repositório criado e primeiro push
- [ ] Labels e milestones
- [ ] GitHub Project
- [ ] Backlog convertido em issues
- [ ] Proteção da `main`, secret scanning, push protection
- [ ] Environments `homologacao` e `producao`

## Scaffold — /scaffold
- [ ] Projeto criado na stack definida
- [ ] Lint, formatação, análise estática e testes
- [ ] Ambiente local Docker com o mesmo banco de produção
- [ ] Comandos padronizados (setup, dev, lint, format, analyse, test, test:e2e, check)
- [ ] Health check, layout base, logs estruturados
- [ ] Modelos, migrations, factories e seeders
- [ ] `.claude/settings.json` do projeto
- [ ] PR do scaffold aberto

## CI — /configurar-ci
- [ ] `ci.yml` (lint, análise, testes, build, cobertura, auditoria de dependências)
- [ ] `e2e.yml`
- [ ] `codeql.yml`
- [ ] Validação do título do PR
- [ ] Checks obrigatórios na `main`
- [ ] Badge no README

## Construção — /implementar e /revisar
- [ ] Todas as issues do MVP implementadas
- [ ] Todos os PRs revisados e mesclados

## Testes — /testar
- [ ] Estratégia de testes (`docs/testes.md`)
- [ ] Matriz RF/RN → testes sem lacunas críticas
- [ ] E2E dos fluxos críticos
- [ ] Teste de carga (se houver RNF de desempenho)
- [ ] Roteiro de homologação da versão

## Documentação — /documentar
- [ ] README
- [ ] Arquitetura
- [ ] API
- [ ] Manual do usuário
- [ ] Runbook
- [ ] Divergências código × docs verificadas

## Infra — /configurar-infra
- [ ] `docs/infra.md` com diagrama e custos
- [ ] Empacotamento e configurações versionadas
- [ ] Script de provisionamento
- [ ] Segredos mapeados por ambiente
- [ ] Backup com restauração testada
- [ ] Observabilidade e alertas
- [ ] Segurança do servidor
- [ ] Passos manuais concluídos pelo usuário

## CD — /configurar-cd
- [ ] Deploy automático em homologação
- [ ] Deploy em produção por tag com aprovação
- [ ] Smoke test e rollback automático
- [ ] Workflow manual de rollback
- [ ] Primeiro deploy em homologação validado
- [ ] Rollback testado em homologação

## Release — /preparar-release
- [ ] Homologação aprovada
- [ ] CHANGELOG, notas técnicas e notas para usuários
- [ ] Tag e GitHub Release criadas
- [ ] Deploy em produção validado
- [ ] Milestone fechado

## Operação — /incidente
- [ ] Runbook conhecido pela equipe
- [ ] Incidentes com postmortem e ações registradas

## Evolução — /nova-demanda, /auditoria, /retrospectiva
- [ ] Demandas registradas antes de implementar
- [ ] Auditorias em dia (dependências e saúde mensal; segurança e LGPD trimestral)
- [ ] Retrospectiva de cada milestone fechado
