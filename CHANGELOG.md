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
- Qualidade: Pint, Larastan (nível 6), Pest 5 com testes no navegador, Lefthook (formatação e Conventional Commits) e hook de formatação do Claude Code.
