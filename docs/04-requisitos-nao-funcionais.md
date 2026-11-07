# 04 — Requisitos não funcionais

Contexto: hospedagem compartilhada da Hostinger (PHP + MySQL, sem Docker e sem processos persistentes; tarefas por cron). Pouco acesso simultâneo. O chatbot depende de um n8n externo.

## Disponibilidade e continuidade

| ID | Requisito | Meta |
| --- | --- | --- |
| RNF-001 | Disponibilidade do site público e da área restrita | **99,5%** ao mês (até ~3,6 h fora do ar), medida por monitor externo de uptime |
| RNF-002 | Janela de manutenção | **Qualquer horário**: deploys devem ser atômicos (troca de link simbólico ou equivalente), sem indisponibilidade perceptível; migrations compatíveis com a versão anterior |
| RNF-003 | **RPO** (perda máxima de dados) | **24 horas**: backup diário do banco feito pelo próprio projeto, mais o backup da Hostinger |
| RNF-004 | **RTO** (tempo máximo para voltar) | **4 horas**: restaurar o código do GitHub e o último backup do banco, seguindo o runbook |
| RNF-005 | Backups | Dump diário do MySQL, compactado e guardado fora da hospedagem (ex.: Google Drive ou outro armazenamento), mantido por 30 dias; restauração testada antes do primeiro deploy em produção e a cada trimestre |
| RNF-006 | Degradação do chatbot | Com o n8n indisponível, o restante do site funciona normalmente e o chat mostra a alternativa (WhatsApp e formulário) em até **10 s** (tempo limite da chamada) |
| RNF-007 | Degradação de serviços externos | Falhas de SMTP, da API do GA4 ou do n8n nunca impedem gravar um lead nem carregar uma página |

## Logs e monitoramento

| ID | Requisito | Meta |
| --- | --- | --- |
| RNF-008 | Retenção de logs da aplicação | Logs diários com rotação, mantidos por **90 dias** no servidor. Sem dados pessoais em texto claro (telefone e e-mail mascarados) |
| RNF-009 | Log de auditoria (área restrita) | Mantido por **24 meses** (RN-012), no banco |
| RNF-010 | Monitoramento | Endpoint `/up` (health check) monitorado de 5 em 5 min por serviço gratuito de uptime, com alerta por e-mail; erros da aplicação notificados por e-mail ou num serviço de rastreio de erros com plano gratuito |

## Desempenho e capacidade

| ID | Requisito | Meta |
| --- | --- | --- |
| RNF-011 | Tempo de carregamento das páginas públicas | LCP < 2,5 s, INP < 200 ms e CLS < 0,1 em 4G (Core Web Vitals "bom"); Lighthouse mobile ≥ 90 |
| RNF-012 | Tempo de resposta do servidor | p95 < 500 ms nas páginas públicas e < 1 s na área restrita (sem contar o GA4) |
| RNF-013 | Resposta do chatbot | p95 < 8 s até a resposta aparecer, com indicador de "digitando" |
| RNF-014 | Capacidade | 50 visitantes simultâneos e 5 usuários simultâneos na área restrita sem degradação |
| RNF-015 | Peso das páginas | Home < 1,5 MB na primeira carga; imagens em WebP/AVIF responsivas com carregamento sob demanda; o widget de chat é carregado só depois da página ou ao clicar |

## Segurança

| ID | Requisito | Meta |
| --- | --- | --- |
| RNF-016 | HTTPS | Obrigatório em todos os ambientes, com HSTS em produção |
| RNF-017 | OWASP Top 10 | Proteção contra CSRF, XSS (escape e CSP), SQL injection (consultas parametrizadas), validação no servidor, cabeçalhos de segurança (CSP, X-Frame-Options, Referrer-Policy, Permissions-Policy) |
| RNF-018 | Segredos | SMTP, webhook do n8n, segredo compartilhado, credencial do GA4 e chave da aplicação só no `.env` do servidor ou fora da pasta pública; nunca no repositório |
| RNF-019 | Autenticação | Sessão com cookie `HttpOnly`, `Secure` e `SameSite=Lax`; expira depois de 2 h de inatividade; regenera o ID ao fazer login |
| RNF-020 | Comunicação com o n8n | Sempre por HTTPS (túnel na demonstração), com segredo compartilhado em cabeçalho; o Laravel valida o formato da resposta |
| RNF-021 | Dependências | Sem vulnerabilidades conhecidas altas ou críticas (`composer audit` e `npm audit` no CI) |

## LGPD

| ID | Requisito | Meta |
| --- | --- | --- |
| RNF-022 | Base legal e transparência | Consentimento para o formulário, o chat e os cookies estatísticos; política em `/privacidade` explicando finalidades, compartilhamentos (Hostinger, Google, Mistral, n8n, provedor de e-mail), transferência internacional e direitos |
| RNF-023 | Minimização | Coletar só os campos do RF-006; nenhum dado sensível; IP guardado só para anti-abuso, por até 30 dias |
| RNF-024 | Direitos do titular | Pedido atendido em até 15 dias pelo administrador (RF-030), pelo e-mail do encarregado ti@b2bsafe.com.br |
| RNF-025 | Registro de consentimentos | Evidência de cada consentimento (data, versão, canal) disponível para auditoria |

## Acessibilidade, compatibilidade e usabilidade

| ID | Requisito | Meta |
| --- | --- | --- |
| RNF-026 | Acessibilidade | **WCAG 2.2 nível AA** no site público, no widget de chat, no banner de cookies e na área restrita; Lighthouse Acessibilidade ≥ 90 e verificação com axe sem violações graves |
| RNF-027 | Navegadores | Duas últimas versões de Chrome, Edge, Firefox e Safari (desktop e iOS) e Chrome Android |
| RNF-028 | Dispositivos | Mobile-first; layout de 360 px a 1920 px sem rolagem horizontal; a área restrita e o kanban utilizáveis no celular |
| RNF-029 | Idioma | Interface em português do Brasil; datas `dd/mm/aaaa`, moeda R$, fuso America/Sao_Paulo |

## Manutenibilidade e operação

| ID | Requisito | Meta |
| --- | --- | --- |
| RNF-030 | Compatibilidade com hospedagem compartilhada | Nada de processos persistentes: filas e tarefas pelo cron da Hostinger (`schedule:run` a cada minuto); funcionar com a versão de PHP oferecida pela Hostinger |
| RNF-031 | Configuração por ambiente | Mudar da demonstração para produção (domínio, e-mail, SMTP, GA4, n8n) só por variáveis do `.env`, sem mudar código |
| RNF-032 | Testes | Cobertura ≥ 80% nas regras de negócio (RN); E2E dos fluxos críticos: formulário, chat com fallback, login, kanban |
| RNF-033 | Custo | Sem serviços pagos além da hospedagem compartilhada e do domínio; usar planos gratuitos (uptime, rastreio de erros, GA4) |

## Histórico de alterações

| Data | ID | Mudança | Origem |
| --- | --- | --- | --- |
| 2026-11-06 | RNF-001 a RNF-033 | Criação do documento | /iniciar-projeto |
