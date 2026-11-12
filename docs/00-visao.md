# 00 — Visão

## Problema

A B2BSAFE Floripa (B2BSAFE FLORIPA LTDA, CNPJ 58.358.780/0001-26) é escritório parceiro C6 Empresas. O site atual (b2bsafe.com.br, feito no Wix) apresenta os serviços, mas:

- não registra os contatos recebidos: os interessados caem direto no WhatsApp ou no e-mail, sem histórico nem acompanhamento;
- tem links quebrados (botões da Maquininha levam a uma página 404, links de WhatsApp malformados, menu com âncoras que só voltam para a home);
- mistura informações antigas (redes sociais "Connect Partners") e textos legais com numeração errada;
- depende da plataforma Wix, sem controle do código e dos dados.

Hoje o atendimento comercial acontece pelo WhatsApp (11) 98420-5023 / (11) 92460-0991 e pelo e-mail contato@b2bsafe.com.br, sem registro centralizado dos leads.

## Objetivos

1. Substituir o site Wix por um site institucional novo, com redesenho visual, rápido e acessível, mantendo o conteúdo e a identidade da B2BSAFE e as referências ao C6 Empresas.
2. Captar leads por formulário (e WhatsApp), gravando cada contato no banco de dados e notificando a equipe por e-mail.
3. Oferecer uma área restrita que faça o proprietário enxergar e gerir o comercial: dashboard com indicadores, funil de leads em kanban, ficha completa de cada lead e exportação.
4. Corrigir todos os problemas conhecidos do site atual (ver `conteudo/www.b2bsafe.com.br.md`, seção "Observações para o novo site").
5. Atender a LGPD: consentimento no formulário e no chat, política de privacidade do site, retenção limitada dos leads.
6. Diferencial inovador: assistente virtual (chatbot com IA) que atende o visitante desde o primeiro acesso: tira dúvidas sobre os produtos, capta o lead na conversa e encaminha para um atendente no WhatsApp quando necessário. Construído do zero em n8n com IA Mistral e RAG (Qdrant), reaproveitando as lições do chatbot anterior do responsável (Portal do Fornecedor FAPEU).
7. Dar ao proprietário controle total da origem dos leads, para validar qual estratégia (canal, campanha, serviço) é mais assertiva: Google Analytics 4 com consentimento, mais a atribuição de origem gravada em cada lead (UTM, gclid/fbclid, referrer, página de entrada) e um painel de origem na área restrita.

## Indicadores de sucesso

| Indicador | Meta |
| --- | --- |
| Leads registrados no banco | 100% dos envios do formulário (nenhum perdido, mesmo se o e-mail falhar) |
| Links quebrados | 0 (verificação automática) |
| Desempenho (Lighthouse mobile) | ≥ 90 em Performance, Acessibilidade, Boas práticas e SEO |
| Tempo até o primeiro contato com o lead | mensurável pelo painel (data de entrada × data de mudança de status) |
| Leads captados pelo chatbot | registrados no mesmo painel, com a conversa vinculada |
| Disponibilidade do chat | quando o n8n estiver fora do ar, o widget avisa e oferece WhatsApp/formulário (nenhum erro exposto) |
| Origem do lead | 100% dos leads com canal de origem registrado (ou "direto/desconhecido") |
| Consentimento de cookies | GA4 só coleta depois do aceite (verificável no navegador) |
| Prazo | site de demonstração no ar em até 1 mês (até 2026-12-06) |

## Escopo

- Páginas públicas: Home (apresentação, serviços, sobre, parcerias/trabalhe conosco, fale conosco, credenciamento, canais oficiais C6), Maquininha (C6 Pay), Política de Privacidade do site (`/privacidade`) e Política/Termos do B2BSafe Connect (`/policy`, mantida por exigência da Meta).
- Formulário de lead com gravação em banco e e-mail de notificação.
- Botões de WhatsApp: (11) 98420-5023 geral; (11) 92460-0991 na Maquininha.
- Banner de cookies (aceitar, recusar e escolher por categoria; link "Preferências de cookies" no rodapé), integrado ao Google Consent Mode v2.
- Google Analytics 4, carregado só depois do consentimento.
- Atribuição de origem: UTM, gclid, fbclid, referrer e página de entrada guardados com o lead (formulário, chatbot e clique no WhatsApp).
- Área restrita com login (admin e atendentes):
  - **Dashboard:** leads do dia, semana e mês; taxa de conversão; tempo médio até o primeiro contato; leads por serviço e por canal de captação (formulário, chatbot, WhatsApp).
  - **Origem e estratégia:** leads e conversões por origem e campanha (banco do site), mais as métricas do GA4 (visitas, canais, campanhas, páginas) lidas pela API de dados do Google, com cache.
  - **Funil em kanban:** Novo → Em contato → Proposta → Convertido / Perdido (com motivo da perda).
  - **Ficha do lead:** dados, origem, histórico de status, anotações da equipe, conversa do chatbot e botão "Chamar no WhatsApp" com mensagem pronta.
  - Filtros e exportação CSV; gestão de usuários (só o admin).
  - **Resumo semanal por e-mail** para o proprietário (números da semana) e **insights do chatbot** (perguntas mais frequentes e perguntas sem resposta, para melhorar a base RAG).
- Assistente virtual (chatbot): widget próprio no site; o Laravel faz de proxy para o webhook do n8n (IA Mistral) e grava leads e conversas; o n8n só devolve a resposta em JSON (texto, dados de lead detectados, pedido de transbordo). Responde dúvidas com RAG: base de documentos (conteúdo do site, FAQ escrito para o projeto e materiais do C6/B2BSAFE) vetorizada no Qdrant com embeddings da Mistral; a busca e a geração ficam no n8n. Os workflows do n8n (atendimento e ingestão da base) são entregas do projeto, versionados no repositório sem credenciais. capta lead na conversa, guarda o histórico vinculado ao lead e encaminha ao WhatsApp. Aviso de IA e consentimento no início da conversa (transferência internacional: Mistral, França).
- Exclusão/anonimização automática de leads e conversas após 24 meses.

## Fora de escopo (MVP)

- Edição de conteúdo pelo painel (textos e serviços ficam no código).
- Blog/notícias.
- Área do cliente, integração com CRM ou com sistemas do C6.
- Envio de mensagens pelo WhatsApp Business API.
- Distribuição automática de leads entre atendentes e alerta de lead parado (candidato à v1.1).
- Integração com Google Ads / Meta Ads para custo e ROI por campanha.
- Hospedagem de produção do n8n e do Qdrant (na demonstração rodam localmente em Docker; a definir antes da produção).
- Migração do domínio definitivo (feita depois da demonstração).

## Partes interessadas

| Papel | Quem |
| --- | --- |
| Cliente / patrocinador | B2BSAFE Floripa (São José/SC) |
| Desenvolvedor, homologador e aprovador de deploy | Gabriel (responsável pelo projeto) |
| Usuários do painel | Admin e atendentes da B2BSAFE |
| Usuários finais do site | Empresários e PJs interessados nos produtos C6 Empresas |

## Fase de demonstração

Antes do domínio definitivo, o site roda em `b2bsafe.gabrielcunhalima.dev` (subdomínio do domínio do responsável, na mesma conta Hostinger), e as notificações de lead vão para o Gmail pessoal do responsável, sem usar nada do site atual. O n8n e o Qdrant rodam em Docker no computador do responsável (mesmo `docker compose` do ambiente local), e o n8n é exposto por Cloudflare Tunnel: o chat só funciona com essa máquina ligada. Depois da aprovação, o domínio definitivo (informado como "b2b.com.br", a confirmar) e o e-mail contato@b2bsafe.com.br substituem esses valores por configuração.

## Histórico de alterações

| Data | ID | Mudança | Origem |
| --- | --- | --- | --- |
| 2026-11-06 | — | Criação do documento | /iniciar-projeto |
| 2026-11-06 | — | Inclusão do assistente virtual (n8n + Mistral) | Pedido do responsável |
| 2026-11-06 | — | Chatbot construído do zero (n8n + Mistral + RAG Qdrant, em Docker, com Cloudflare Tunnel) | Pedido do responsável |
| 2026-11-06 | — | Banner de cookies, GA4, atribuição de origem, dashboard, kanban, ficha do lead, resumo semanal e insights do bot | Pedido do responsável |
