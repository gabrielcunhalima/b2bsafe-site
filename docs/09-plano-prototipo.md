# 09 — Plano do protótipo (telas do MVP)

Só a lista das telas. Os wireframes e o design system estão em [10-ux.md](10-ux.md) e [ux/](ux/).

## Site público

| # | Tela | Objetivo | Perfis | RF |
| --- | --- | --- | --- | --- |
| T-01 | Home | Apresentar a B2BSAFE e os serviços e levar a contato: seções Apresentação, Serviços (cards → WhatsApp), Maquininha C6 Pay (seção própria), Sobre (selo Awards), Parcerias / Trabalhe conosco, Fale conosco, Credenciamento, Canais oficiais C6 | Visitante | RF-001, RF-005, RF-006 |
| T-02 | Maquininha (C6 Pay) | Vender a maquininha: vantagens, condições, adquirentes, chamada para pedir, WhatsApp específico | Visitante | RF-002, RF-005, RF-006 |
| T-03 | Formulário de lead (componente) | Captar o lead, com serviço pré-selecionado conforme a origem do clique; estados de erro e de sucesso (com a opção de seguir pelo WhatsApp) | Visitante | RF-006, RF-008 |
| T-04 | Política de Privacidade do site | Transparência LGPD do site, chat e cookies | Visitante | RF-003 |
| T-05 | Política e Termos do B2BSafe Connect | Manter o documento exigido pela Meta | Visitante | RF-004 |
| T-06 | Banner e preferências de cookies (componente) | Consentimento: aceitar, recusar, personalizar; reabrir pelo rodapé | Visitante | RF-009, RF-010 |
| T-07 | Widget do assistente virtual (componente) | Estados: fechado, aviso de IA e consentimento, conversa, digitando, captação de dados, transbordo para o WhatsApp, indisponível (fallback) | Visitante | RF-013 a RF-017 |
| T-08 | Botão flutuante de WhatsApp (componente) | Contato rápido, convivendo com o botão do chat | Visitante | RF-005 |
| T-09 | Página 404 | Recuperar o visitante perdido, com links úteis e WhatsApp | Visitante | RF-012 (página simples já no MVP) |
| T-10 | Cabeçalho e rodapé (layout) | Navegação por âncoras, CNPJs, endereços, redes sociais atualizadas, aviso de parceiro C6, links legais e "Preferências de cookies" | Visitante | RF-001, RF-009, RN-015 |

## Área restrita (`/painel`, Filament)

| # | Tela | Objetivo | Perfis | RF |
| --- | --- | --- | --- | --- |
| T-11 | Login, recuperar senha, definir senha (convite) | Acesso seguro | Atendente, Administrador | RF-018, RF-019 |
| T-12 | Dashboard | Visão do comercial: KPIs do período, leads por serviço e canal, cliques no WhatsApp, últimos leads; sino de notificações (todas as telas do painel) | Atendente, Administrador | RF-020, RF-031 |
| T-13 | Origem e estratégia | Comparar canais e campanhas: leads, conversões e taxa por origem, UTM e serviço; a área para o GA4 (RF-022) fica reservada | Atendente, Administrador | RF-021 |
| T-14 | Lista de leads | Buscar, filtrar, ordenar, exportar CSV | Atendente, Administrador | RF-023, RF-026 |
| T-15 | Funil (kanban) | Mover os leads entre etapas, com motivo de perda | Atendente, Administrador | RF-025 |
| T-16 | Ficha do lead | Dados, origem, consentimentos, linha do tempo (status, interações, anotações), conversa do chat, "Chamar no WhatsApp", ações LGPD (só admin) | Atendente, Administrador | RF-024, RF-030 |
| T-17 | Usuários (lista e formulário) | Criar, convidar, editar, desativar, mudar perfil | Administrador | RF-019 |
| T-18 | Log de auditoria | Consultar as ações sensíveis | Administrador | RF-030 |
| T-19 | Meu perfil | Nome, senha, preferência do resumo semanal | Atendente, Administrador | RF-018, RF-027 (preferência) |

## E-mails (modelos)

| # | Modelo | RF |
| --- | --- | --- |
| E-01 | Novo lead (e "voltou a entrar em contato") | RF-007, RN-003 |
| E-02 | Convite de usuário / redefinição de senha | RF-018, RF-019 |

## Fora do MVP (telas futuras)

- Insights do chatbot (RF-028), bloco do GA4 em Origem (RF-022) e o e-mail de resumo semanal (RF-027).

## Histórico de alterações

| Data | ID | Mudança | Origem |
| --- | --- | --- | --- |
| 2026-11-06 | — | Criação do documento | /iniciar-projeto |
| 2026-11-07 | T-01, T-12 | Seção Maquininha na Home; sino de notificações | /desenhar-telas |
