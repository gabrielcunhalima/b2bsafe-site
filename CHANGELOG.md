# Changelog

Todas as mudanças relevantes deste projeto são registradas aqui.

O formato segue o [Keep a Changelog](https://keepachangelog.com/pt-BR/1.1.0/) e o projeto usa [versionamento semântico](https://semver.org/lang/pt-BR/).

## [Unreleased]

### Adicionado

- Documentação da descoberta: visão, atores, 31 requisitos funcionais, 21 regras de negócio, 33 requisitos não funcionais, modelo de dados, stack, ADRs, MVP e backlog com 32 histórias.
- UX: mapa de navegação, wireframes de 19 telas e 2 e-mails, design system (cores do logo, fonte Urbanist, regras de interface).
- Estrutura do repositório: modelos de issue e PR, CODEOWNERS, Dependabot, guia de contribuição e política de segurança.
- Base técnica: Laravel 13, painel Filament 5 em `/painel` (login, redefinição de senha, notificações), Flowforge e ícones Lucide.
- Modelo de dados: migrations, models, enums, factories e seeders das 12 tabelas do domínio (docs/06-modelo-de-dados.md).
- Ambiente local em Docker: MariaDB 11.8, Mailpit, n8n, Qdrant e túnel cloudflared; aplicação opcional em container.
- Health check em `/saude` (aplicação, banco e fila), páginas de erro amigáveis, layout base com os tokens do design system e fonte Urbanist local, logs em JSON.
- Traduções do Laravel em português (pt_BR) e factories de todas as tabelas do domínio.
- Layout base do site (#1): cabeçalho fixo com menu por âncoras e item da seção visível marcado, menu móvel em tela cheia (Esc fecha e o foco volta ao botão), rodapé com as duas empresas, contato, redes sociais atuais, links legais, preferências de cookies e aviso de parceiro C6 (RN-015).
- Ajustes da revisão do layout: formatação de telefones testada, aviso de link em nova aba, área de toque mínima nos links legais e item ativo também no menu do celular.
- Home institucional (#2): apresentação, 7 cards de serviço que abrem o WhatsApp citando o serviço, seção própria da Maquininha C6 Pay com o WhatsApp da maquininha, Sobre com o selo Conexão Awards 2025, Parcerias, Fale conosco, Credenciamento e Canais oficiais C6. Links de WhatsApp montados por `App\Support\WhatsApp` (RN-021) e marcados para o registro de clique (#11).
- Logo da B2BSAFE no cabeçalho e no menu do celular, versão clara no rodapé, imagem do selo Conexão Awards 2025 na seção Sobre e imagem da C6 Pay na seção Maquininha (originais em `docs/marca/`).
- Captação de leads (#7, #8, #9, #10, #11):
  - origem do visitante pelo primeiro toque (UTM, gclid, fbclid, referrer), classificada pela RN-008 e guardada conforme o consentimento (RN-009);
  - formulário de lead no Fale conosco, com validação no navegador e no servidor, máscara de WhatsApp, estados de erro, envio, falha e sucesso, armadilha para robôs e limite de 5 envios por hora (RN-001, RN-002, RN-011, RN-016);
  - deduplicação de 30 dias pelo WhatsApp ou e-mail (RN-003);
  - e-mail de novo lead e de "voltou a entrar em contato" pela fila;
  - registro dos cliques no WhatsApp por sendBeacon e botão flutuante (RN-010).
- Página Maquininha C6 Pay (#3): vantagens, tabela de taxas em configuração com data de referência e aviso do C6, condições, bandeiras e o formulário com o serviço Maquininha; todo o conteúdo usa o WhatsApp da maquininha (RN-021).
- Página 404 amigável (#6) com links para a Home, a Maquininha, o formulário e o WhatsApp.
- Política de Privacidade do site em `/privacidade` (#4), com versão e data em configuração, e `/policy` do B2BSafe Connect (#5) com as numerações corrigidas e 301 de `/policy.`; layout comum das páginas legais com índice.
- Qualidade: Pint, Larastan (nível 6), Pest 5 com testes no navegador, Lefthook (formatação e Conventional Commits) e hook de formatação do Claude Code.
