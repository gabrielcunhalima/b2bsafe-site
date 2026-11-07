# Design system — B2BSAFE

Proposta para o site novo, com o logo atual da B2BSAFE. Visual **corporativo e sóbrio**: muito espaço em branco, tipografia forte e poucas fotos, reforçando o mote "Be Safe". As cores seguem o logo da B2BSAFE: branco e cinza gelo, preto e amarelo.

O painel (`/painel`) usa o tema **padrão do Filament 5**, trocando só a cor primária, o logo e a fonte. O modo escuro do Filament fica disponível.

Alvo de acessibilidade: **WCAG 2.2 AA** (RNF de acessibilidade em [04-requisitos-nao-funcionais.md](../04-requisitos-nao-funcionais.md)).

## Regras fundamentais

Valem para o site e o painel, em toda tela, componente e e-mail. Violação é motivo de reprovação no `/revisar`.

1. **Sem emojis.** Nenhum emoji em textos, botões, mensagens do chat ou e-mails. Onde caberia um emoji, use um ícone da biblioteca [Lucide](https://lucide.dev).
2. **Sem eyebrows.** Nada de rótulo pequeno (geralmente em caixa alta) acima de títulos ("SERVIÇOS", "MAQUININHA C6 PAY"). O título diz sozinho o que é a seção.
3. **Sem bordas de um lado só.** Nada de faixa de destaque à esquerda ou no topo de cartões, alertas, citações, abas ou linhas do tempo (`border-l-4`, `border-t-2`, sublinhado de aba). Destaque se faz com borda completa, fundo, peso tipográfico ou ícone. Divisórias neutras de 1 px entre linhas de tabela e lista são permitidas.

## Cores (tokens)

Os tokens ficam em `resources/css/app.css` (`@theme` do Tailwind 4). Contrastes medidos com a fórmula da WCAG.

Paleta tirada do logo da B2BSAFE: **branco e cinza gelo no fundo, preto como segunda cor e o amarelo do logo como terceira**. Valores do amarelo (`#FFCC29`) e do preto (`#060606`) extraídos do arquivo do logo.

| Token | Valor | Uso | Contraste |
| --- | --- | --- | --- |
| `--color-fundo` | `#FFFFFF` | Fundo principal | — |
| `--color-gelo` | `#F4F5F7` | Fundo de seções alternadas, cartões sobre branco, fundo do painel | — |
| `--color-preto` | `#060606` | **Segunda cor:** botão principal, títulos, cabeçalho e rodapé escuros, seção Maquininha | 20,3:1 com branco · 18,6:1 com gelo |
| `--color-preto-hover` | `#262626` | Hover/ativo do botão preto | 15,1:1 com branco |
| `--color-amarelo` | `#FFCC29` | **Terceira cor (destaque):** botão de destaque com texto preto, ícones e títulos sobre fundo preto, marcadores, item ativo, foco sobre fundo escuro | 13,4:1 com preto |
| `--color-amarelo-hover` | `#F2B705` | Hover do botão amarelo | 11,2:1 com preto |
| `--color-texto` | `#1A1A1A` | Texto corrido | 17,4:1 · 16,0:1 no gelo |
| `--color-texto-suave` | `#4B5563` | Texto secundário, legendas | 7,6:1 · 6,9:1 no gelo |
| `--color-texto-terciario` | `#5F6673` | Dicas de campo, metadados; também a borda de campos de formulário | 5,8:1 · 5,3:1 no gelo |
| `--color-borda` | `#E2E4E8` | Divisórias e contorno de cartões (decorativo; nunca a única pista de nada) | — |
| `--color-sucesso` | `#15803D` | Confirmações | 5,0:1 · 4,6:1 no gelo |
| `--color-erro` | `#B91C1C` | Erros de validação | 6,5:1 · 5,9:1 no gelo |
| `--color-aviso` | `#A16207` | Alertas (não confundir com o amarelo da marca) | 4,9:1 · 4,5:1 no gelo |
| `--color-whatsapp` | `#075E54` | Botões de WhatsApp (texto branco) | 7,7:1 |

### Como usar o amarelo

- **Nunca amarelo como texto ou ícone sobre branco ou gelo:** o contraste é 1,5:1, ilegível. Sobre fundo claro, o amarelo aparece só como **fundo** (com texto preto) ou em elementos decorativos grandes.
- **Sobre preto, o amarelo brilha:** títulos de destaque, ícones, o botão principal das seções escuras (amarelo com texto preto).
- **Pouco amarelo:** um ponto de destaque por tela (a ação mais importante ou um marcador). Se tudo é amarelo, nada se destaca.
- **Hierarquia de botões:** fundo claro → primário **preto** com texto branco, secundário com contorno preto. Fundo preto → primário **amarelo** com texto preto, secundário com contorno branco.
- **Foco:** contorno preto sobre fundo claro e amarelo sobre fundo escuro.

### Observações

- **Não usar** o verde-padrão do WhatsApp (`#25D366`) com texto branco: o contraste é 1,98:1. Ele pode aparecer só no ícone, sobre fundo escuro.
- **Semelhança com o C6:** a paleta preto + amarelo vem do logo da própria B2BSAFE e se aproxima da identidade do C6. O aviso de parceiro (RN-015) em todas as páginas e o logo da B2BSAFE em destaque evitam que o site pareça canal oficial.
- **Modo escuro do site:** fora do MVP. O painel herda o modo escuro do Filament.
- **Filament:** cor primária amarela (`->colors(['primary' => Color::hex('#FFCC29')])`), fundo gelo e logo da B2BSAFE. **Verificar na `/scaffold`** se os botões primários saem com texto escuro; se saírem com texto branco (1,5:1), ajustar no tema do painel para texto preto.

## Tipografia

- **Fonte única: [Urbanist](https://fonts.google.com/specimen/Urbanist)**, para títulos e texto, no site, no painel e nos e-mails. Geométrica, limpa e moderna. Licença OFL, variável (pesos 100 a 900). Escolhida pelo responsável entre 42 opções comparadas em [tipografia.html](tipografia.html).
- **Hospedagem:** no próprio site, com `@fontsource-variable/urbanist`, só o subconjunto `latin` e `latin-ext` (acentos do português), com `font-display: swap`. Sem Google Fonts nem Bunny Fonts, para não enviar dados a terceiros antes do consentimento.
- **Fallback:** `'Urbanist Variable', system-ui, -apple-system, 'Segoe UI', sans-serif`.
- **Filament:** a fonte padrão do painel é carregada da Bunny Fonts, um serviço externo. Usar `->font('Urbanist Variable', provider: LocalFontProvider::class)` com o mesmo arquivo do site.
- **E-mails:** clientes de e-mail não carregam fontes web de forma confiável. Declarar `Urbanist` primeiro e cair para `Arial, sans-serif`.
- **Escala** (mobile → desktop):

| Uso | Classe Tailwind | Peso |
| --- | --- | --- |
| H1 (hero) | `text-4xl md:text-5xl`, `leading-tight` | 800 |
| H2 (seção) | `text-3xl` | 700 |
| H3 (card) | `text-lg` | 700 |
| Corpo | `text-base` (16 px), `leading-relaxed` | 400 |
| Botões e rótulos | `text-base` / `text-sm` | 600 |
| Pequeno | `text-sm` (14 px) | 500 |
| Mínimo | `text-xs` (12 px), só para metadados | 500 |

- A Urbanist tem traço fino nos pesos baixos. Abaixo de 16 px, usar no mínimo o peso 500, e nunca usar pesos abaixo de 400.
- **Números:** a Urbanist **não tem algarismos tabulares** (o "1" ocupa menos da metade da largura do "0"; verificado em 2026-11-07). Por isso:
  - em tabelas, valores em R$, porcentagens e contagens ficam **alinhados à direita**, sempre no mesmo formato (`R$ 1.250.000,00`);
  - números que mudam ao vivo (contadores do dashboard) têm largura mínima fixa, para não "pular";
  - se a desigualdade incomodar nas colunas de valores do painel, a alternativa é usar só nelas uma fonte com algarismos tabulares. Isso fica para decidir com o responsável, porque mexe na fonte única.
- Linhas de texto corrido com no máximo ~70 caracteres (`max-w-prose`).
- O texto aumenta até 200% sem quebrar o layout (WCAG 1.4.4).

## Espaçamento e grade

- Base de 4 px (escala do Tailwind). Seções com `py-16` (64 px); cartões com `p-4` a `p-6`.
- Contêiner `max-w-6xl` (1152 px) com `px-4`. Grade de 1 → 2 → 3/4 colunas (`sm`, `md`, `lg`).
- Pontos de quebra do Tailwind: `sm` 640, `md` 768, `lg` 1024, `xl` 1280. O layout funciona de 320 px a 1920 px, sem rolagem horizontal.
- Bordas arredondadas: `rounded` (4 px) em botões e campos; `rounded-xl` na janela do chat; `rounded-full` nos botões flutuantes.

## Componentes base

### Botões

| Variante | Aparência | Uso |
| --- | --- | --- |
| Primário | Fundo `preto`, texto branco, `font-semibold`, `px-6 py-3` | Uma ação principal por bloco, em fundo claro |
| Destaque | Fundo `amarelo`, texto `preto` | Ação principal em fundo preto, ou a única chamada mais importante da página |
| Secundário | Borda de 2 px `preto` (branca em fundo escuro), fundo transparente | Ação alternativa |
| WhatsApp | Fundo `whatsapp`, texto branco, ícone do WhatsApp à esquerda | Todo link `wa.me` |
| Texto | Sublinhado | Ações terciárias ("Ver como tabela") |

- Altura mínima de 44 px e alvo de toque de 24 px ou mais (WCAG 2.5.8).
- Foco visível: `outline` de 3 px `preto` (em fundo escuro, `amarelo`), com 2 px de afastamento. Nunca remover o outline.
- Desabilitado: opacidade de 60%, `cursor-not-allowed` e `aria-disabled`. Durante o envio, o texto muda ("Enviando…").

### Formulários

- Rótulo sempre visível acima do campo (nunca só o placeholder). Obrigatório marcado com `*` e a legenda "* Campos obrigatórios".
- Campo: borda de 1 px `texto-terciario` (3:1), `rounded`, `px-3 py-2`. Foco: borda e outline `preto`.
- **Erro:** borda de 2 px `erro`, ícone `triangle-alert` e mensagem abaixo do campo (`aria-describedby`, `aria-invalid="true"`). No envio, um resumo de erros no topo com links para os campos, e o foco vai para o resumo.
- Mensagens de erro dizem o que fazer: "Informe um celular com DDD, por exemplo (48) 99999-1234".
- Use `autocomplete` (`name`, `tel`, `email`) e `inputmode="tel"` no WhatsApp, com máscara que não atrapalha colar.
- Caixa de aceite sempre desmarcada (RN-011).

### Cartões

- Fundo branco, borda `borda`, `rounded`. Cartão clicável: o cartão inteiro é o link, com o nome acessível descrevendo a ação ("Crédito: fale com um atendente no WhatsApp").
- Cards de serviço: a faixa "Fale com um atendente" aparece no hover e no foco; abaixo de `md`, fica sempre visível.

### Tabelas

- `<caption>` (pode ser `sr-only`), `<th scope>`, números alinhados à direita.
- No celular: rolagem horizontal dentro de um contêiner `relative overflow-x-auto` (tabelas de relatório) ou empilhamento em cartões (listas do Filament).

### Modais e diálogos

- `role="dialog"` com `aria-modal` e título ligado por `aria-labelledby`. Ações destrutivas usam `role="alertdialog"`.
- O foco fica preso dentro do diálogo; Esc fecha; ao fechar, o foco volta ao elemento que abriu.
- Ação destrutiva irreversível (anonimizar): exige digitar a palavra de confirmação.

### Alertas e feedback

| Situação | Componente | Comportamento |
| --- | --- | --- |
| Sucesso de ação | Toast (Filament) ou região `role="status"` | Some em 4 a 5 s; pode oferecer "Desfazer" |
| Erro que exige ação | Alerta em linha com `role="alert"` | Fica até ser resolvido |
| Carregando | Esqueleto (`animate-pulse`) ou texto no botão | Com `aria-busy` |
| Vazio | Texto que explica e sugere o próximo passo | "Ainda não há leads neste período…" |
| Sem permissão | Página 403 do Filament | "Você não tem permissão para acessar esta página." |

- Nunca comunicar estado só pela cor: sempre há texto ou ícone junto (WCAG 1.4.1).
- Mensagens técnicas nunca aparecem ao visitante (ex.: fallback do chat).

### Etiquetas de status do lead

| Status | Estilo |
| --- | --- |
| Novo | Fundo `amarelo`, texto `preto` (destaca o que ainda não foi tratado) |
| Em contato | Fundo cinza claro |
| Proposta | Contorno `preto`, texto `preto` |
| Convertido | Fundo `sucesso` a 15%, texto `sucesso`, ícone `check` |
| Perdido | Fundo cinza, texto `texto-suave` |

### Botões flutuantes e chat

- Canto inferior direito, empilhados: WhatsApp em cima (56 px, círculo) e "Assistente" com o ícone `message-circle` embaixo (no celular, só o ícone, com `aria-label`), com 12 px de espaço entre eles.
- Sobem acima da faixa de cookies enquanto ela está aberta; somem com o chat aberto em tela cheia (abaixo de 640 px).
- Janela do chat: 384 × 544 px no desktop; mensagens numa região `role="log"` com `aria-live="polite"`.

## Imagens e ícones

- **Ícones: Lucide**, em todo o projeto. No site, `lucide` (npm), importando só os ícones usados. No painel, `mallardduck/blade-lucide-icons` registrado no Filament no lugar dos Heroicons padrão. Tamanho de 16 a 20 px no texto, traço de 2 px, `aria-hidden="true"` quando decorativo; ícone sozinho em botão exige `aria-label`.
- **Marcas** (WhatsApp, Instagram, LinkedIn, Facebook): o Lucide não tem logos de marcas. Usar o SVG oficial de cada marca, seguindo o guia de uso dela.
- Fotos: WebP/AVIF com `width`/`height`, `loading="lazy"` abaixo da dobra e `alt` descritivo. Licença verificada antes de usar (pendência no [ESTADO](../ESTADO.md)).
- Imagem da C6 Pay e logos de adquirentes: só com permissão de uso do C6.

## Movimento

- Transições de 150 a 200 ms. Rolagem suave nas âncoras.
- Respeitar `prefers-reduced-motion`: sem rolagem suave nem animações.

## Acessibilidade (checklist para a implementação)

- [ ] Contraste AA: texto 4,5:1, texto grande e componentes 3:1 (tokens acima).
- [ ] Tudo operável por teclado, na ordem visual; "Pular para o conteúdo" como primeiro foco.
- [ ] Foco sempre visível e nunca escondido por elementos fixos (WCAG 2.4.11): cabeçalho fixo com `scroll-padding-top`.
- [ ] Rótulos em todos os campos; erros descritos em texto e ligados ao campo.
- [ ] Kanban com alternativa ao arrastar (menu "Mover para…") (WCAG 2.5.7).
- [ ] Gráficos com tabela alternativa.
- [ ] `lang="pt-BR"`; títulos de página únicos; hierarquia de headings sem saltos.
- [ ] Testes automáticos com axe no CI e revisão manual com leitor de tela (NVDA) nos fluxos principais.

## Histórico de alterações

| Data | ID | Mudança | Origem |
| --- | --- | --- | --- |
| 2026-11-07 | — | Criação do documento | /desenhar-telas |
| 2026-11-07 | — | Tipografia: Urbanist em todo o site e painel (títulos e texto) | Escolha do responsável |
| 2026-11-07 | — | Paleta trocada para a do logo: branco e gelo, preto e amarelo `#FFCC29` | Pedido do responsável |
| 2026-11-07 | — | Regras fundamentais: sem emojis (Lucide), sem eyebrows, sem bordas de um lado só | Pedido do responsável |
