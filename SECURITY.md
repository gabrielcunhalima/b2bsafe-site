# Política de segurança

## Como relatar uma vulnerabilidade

Não abra issue pública. Use o recurso **"Report a vulnerability"** (aba Security deste repositório) ou fale diretamente com o responsável pelo projeto, @gabrielcunhalima.

Inclua: o que foi encontrado, como reproduzir, o impacto e, se possível, uma sugestão de correção. O retorno inicial acontece em até 5 dias úteis.

## Dados pessoais (LGPD)

Pedidos de titulares de dados (acesso, correção, exclusão) vão para o encarregado da B2BSAFE: **ti@b2bsafe.com.br**. Incidentes que envolvam dados pessoais seguem o processo de `/incidente` e são registrados em `docs/incidentes/`.

## Boas práticas do projeto

- Segredos só no `.env` do servidor, nos Secrets do GitHub ou nas credenciais do n8n, nunca no código.
- Dependências monitoradas pelo Dependabot.
- Ações sensíveis do painel registradas no log de auditoria (RF-030).
