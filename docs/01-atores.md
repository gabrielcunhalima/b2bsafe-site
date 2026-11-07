# 01 — Atores

## Perfis humanos

| Ator | Quem é | Responsabilidades | Permissões de alto nível |
| --- | --- | --- | --- |
| **Visitante** | Empresário ou PJ que acessa o site, sem login | Conhecer os serviços, tirar dúvidas no chat, enviar contato | Ver páginas públicas; usar o chatbot; enviar formulário; escolher preferências de cookies |
| **Lead (titular dos dados)** | Visitante que deixou seus dados no formulário ou no chat | Ser contatado; exercer direitos da LGPD | Pedir acesso, correção ou exclusão dos próprios dados pelo e-mail do encarregado (DPO) |
| **Atendente** | Membro da equipe comercial da B2BSAFE | Tratar os leads: contatar, registrar anotações, mover no funil | Entrar na área restrita; ver dashboard, origem e insights; ver, filtrar e editar leads (status, anotações); exportar CSV |
| **Administrador** | Proprietário da B2BSAFE (e o responsável técnico na demonstração) | Acompanhar resultados e estratégia; gerir a equipe | Tudo do atendente, mais: gerir usuários (criar, desativar, trocar perfil); anonimizar ou excluir lead a pedido do titular; receber o resumo semanal por e-mail |

## Atores de sistema

| Ator | Papel |
| --- | --- |
| **Assistente virtual (n8n + Mistral)** | Recebe as mensagens do chat pelo proxy do Laravel, consulta a base RAG e devolve resposta, dados de lead detectados e pedido de transbordo. Não acessa o banco do site. |
| **Agendador (cron da Hostinger)** | Roda tarefas periódicas: resumo semanal, anonimização após 24 meses, atualização do cache do GA4, envio de e-mails da fila. |
| **Google Analytics 4** | Recebe eventos do navegador (só com consentimento) e fornece métricas ao painel pela API de dados. |
| **Serviço de e-mail (SMTP)** | Envia notificações de lead e o resumo semanal (Gmail na demonstração; contato@b2bsafe.com.br em produção). |

## Observações

- Os perfis da área restrita são só **Administrador** e **Atendente**. No MVP não há distribuição de leads: todo atendente vê todos os leads.
- Existe sempre pelo menos um administrador ativo: o sistema impede desativar ou rebaixar o último.

## Histórico de alterações

| Data | ID | Mudança | Origem |
| --- | --- | --- | --- |
| 2026-11-06 | — | Criação do documento | /iniciar-projeto |
