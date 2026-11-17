{{--
    Política de Privacidade (Termo de LGPD) e Termos de Uso (RF-003, RF-004): texto idêntico ao de
    https://www.b2bsafe.com.br/policy, a pedido do responsável, sem alterações de redação nem de numeração.
    Única diferença técnica: o link "/policy." aponta para /policy (o ponto final quebrava o link no site antigo).
--}}
@php
    $secoes = [
        'termo-de-lgpd' => 'Termo de LGPD',
        'termos-de-uso' => 'Termos de Uso',
    ];
    $politica = 'https://www.b2bsafe.com.br/policy';
@endphp

<x-pagina-legal titulo="Política de Privacidade"
    descricao="Termo de LGPD e Termos de Uso da B2BSafe Consulting Partners LTDA."
    :secoes="$secoes">

    <section id="termo-de-lgpd" aria-labelledby="termo-de-lgpd-titulo" class="scroll-mt-24 space-y-5">
        <h2 id="termo-de-lgpd-titulo">Termo de LGPD</h2>

        <p>A B2BSafe Consulting Partners LTDA, nome fantasia B2BSafe Consulting Partners, inscrita no CNPJ 41.708.313/0001-86, com sede em Rua Peruíbe (Condomínio Estância Marambaia), 397, Marambaia, Vinhedo/SP, CEP 13287-140, Brasil, é a controladora dos dados pessoais tratados no âmbito do B2BSafe Connect, plataforma SaaS de atendimento omnichannel. Esta Política de Privacidade descreve como coletamos, usamos, armazenamos, compartilhamos e protegemos informações, em conformidade com a Lei Geral de Proteção de Dados (Lei nº 13.709/2018 — LGPD) e demais normas aplicáveis, incluindo exigências de plataformas integradas (Meta / WhatsApp Business Platform).</p>

        <h3>SEÇÃO 1 - Controlador, operador e contatos</h3>
        <p>Controladora: B2BSafe Consulting Partners LTDA (CNPJ 41.708.313/0001-86).</p>
        <p>Endereço: Rua Peruíbe (Condomínio Estância Marambaia), 397, Marambaia, Vinhedo/SP, CEP 13287-140, Brasil.</p>
        <p>Canal geral de privacidade: <a href="mailto:contato@b2bsafe.com.br">contato@b2bsafe.com.br</a></p>
        <p>Encarregado de Proteção de Dados (DPO): <a href="mailto:ti@b2bsafe.com.br">ti@b2bsafe.com.br</a></p>
        <p>Empresas clientes que utilizam o B2BSafe Connect para atender seus próprios contatos finais (consumidores, leads, parceiros) atuam, em regra, como controladoras dos dados desses titulares. A B2BSafe Consulting Partners LTDA atua como operadora ao processar tais dados exclusivamente conforme instruções contratuais do cliente e para prestação do serviço contratado.</p>

        <h3>SEÇÃO 2 - Dados que coletamos</h3>
        <p>Cadastro da empresa e usuários: razão social, CNPJ, nome, e-mail, senha (armazenada de forma criptografada), cargo, foto de perfil e preferências de conta.</p>
        <p>Dados operacionais de atendimento: conversas, mensagens, anexos, histórico de atendimento, etiquetas, filas, distribuição de leads, campanhas, chatbots e métricas de uso.</p>
        <p>Dados de contatos finais: nome, telefone, identificadores de WhatsApp, e-mail e demais informações enviadas pelos clientes da sua empresa durante conversas ou importações.</p>
        <p>Dados de plataformas Meta / WhatsApp: identificadores de conta comercial (WABA), números de telefone, templates, status de entrega, webhooks e metadados exigidos pela WhatsApp Business Platform, conforme autorizado pelo cliente durante a conexão (Embedded Signup ou credenciais).</p>
        <p>Integrações opcionais: tokens e credenciais de APIs (Gupshup, Zernio, Evolution e similares), somente quando habilitadas pelo cliente.</p>
        <p>Dados técnicos: endereço IP, logs de acesso, dispositivo, navegador, cookies essenciais e registros de auditoria para segurança e prevenção a fraudes.</p>

        <h3>SEÇÃO 3 - Finalidades do tratamento</h3>
        <p>Criar, autenticar e administrar contas de empresas e usuários;</p>
        <p>Operar o serviço de atendimento, campanhas, chatbots, distribuição e relatórios contratados;</p>
        <p>Integrar canais de comunicação autorizados pelo cliente, incluindo WhatsApp Business Platform;</p>
        <p>Cumprir políticas e requisitos técnicos de parceiros de mensageria (Meta, BSPs e conectores);</p>
        <p>Garantir segurança, autenticação, prevenção a abusos, suporte técnico e melhoria do produto;</p>
        <p>Cumprir obrigações legais, regulatórias e responder a solicitações de autoridades competentes.</p>

        <h3>SEÇÃO 4 - Bases legais (LGPD)</h3>
        <p>O tratamento ocorre com fundamento, conforme o caso, em:</p>
        <p>Execução de contrato e procedimentos preliminares (cadastro, onboarding e prestação do serviço);</p>
        <p>Legítimo interesse (segurança, melhoria do produto, prevenção a fraudes e continuidade operacional);</p>
        <p>Cumprimento de obrigação legal ou regulatória;</p>
        <p>Consentimento, quando exigido (ex.: aceite desta política e dos termos no cadastro).</p>

        <h3>SEÇÃO 5 - Compartilhamento de dados</h3>
        <p>Não vendemos dados pessoais. Podemos compartilhar informações estritamente necessárias com:</p>
        <p>Meta Platforms / WhatsApp Business Platform — para envio, recebimento e gestão de mensagens, templates e contas comerciais, conforme políticas da Meta e autorização do cliente.</p>
        <p>Provedores de infraestrutura — hospedagem, banco de dados, e-mail transacional (ex.: Brevo), monitoramento e backup, sob contratos e medidas de segurança.</p>
        <p>Parceiros de integração — somente quando o cliente habilita a integração (Gupshup, Zernio, Evolution etc.).</p>
        <p>Autoridades — quando houver obrigação legal, ordem judicial ou requisição válida.</p>
        <p>O compartilhamento respeita contratos, medidas de segurança e instruções do cliente titular dos dados operacionais de atendimento.</p>

        <h3>SEÇÃO 6 - Transferência internacional</h3>
        <p>Alguns provedores utilizados, em especial a Meta Platforms, Inc. (WhatsApp Business Platform), podem processar dados em servidores localizados fora do Brasil, inclusive nos Estados Unidos. Quando aplicável, adotamos salvaguardas contratuais e técnicas compatíveis com a LGPD para proteger os dados transferidos, limitando o uso ao necessário para a prestação do serviço autorizado pelo cliente.</p>

        <h3>SEÇÃO 7 - Retenção e exclusão</h3>
        <p>Mantemos os dados enquanto a conta estiver ativa e pelo tempo necessário para cumprir obrigações legais, resolver disputas, backups e continuidade operacional. O cliente ou titular pode solicitar exclusão conforme instruções em <a href="{{ $politica }}">https://www.b2bsafe.com.br/policy</a> ou por e-mail para contato@b2bsafe.com.br (assunto: "Exclusão de dados"). Prazo de resposta: até 30 dias úteis, salvo exigências legais em contrário ou necessidade de retenção mínima exigida por lei.</p>
        <p>Dados originados de integrações Meta/WhatsApp também podem estar sujeitos às políticas e fluxos de exclusão da Meta. Quando aplicável, orientaremos o cliente sobre os procedimentos complementares.</p>

        <h3>SEÇÃO 8 - Segurança</h3>
        <p>Adotamos medidas técnicas e organizacionais como criptografia de credenciais sensíveis, controle de acesso por perfil, autenticação, logs de auditoria, segregação de ambientes e backups. Nenhum sistema é 100% invulnerável; em caso de incidente relevante, comunicaremos conforme exigido pela legislação aplicável.</p>

        <h3>SEÇÃO 6 - Direitos do titular</h3>
        <p>Conforme a LGPD, você pode solicitar:</p>
        <p>Confirmação de tratamento e acesso aos dados;</p>
        <p>Correção de dados incompletos, inexatos ou desatualizados;</p>
        <p>Anonimização, bloqueio ou eliminação de dados desnecessários ou excessivos;</p>
        <p>Portabilidade, quando aplicável;</p>
        <p>Informações sobre compartilhamento e revogação de consentimento, quando cabível.</p>
        <p>Solicitações de usuários cadastrados na plataforma: contato@b2bsafe.com.br ou <a href="mailto:ti@b2bsafe.com.br">ti@b2bsafe.com.br</a>. Consumidores finais atendidos por empresas clientes devem, preferencialmente, contatar diretamente a empresa que realiza o atendimento (controladora dos dados de contato).</p>
        <p>Você também pode apresentar reclamação à Autoridade Nacional de Proteção de Dados (ANPD) caso entenda que o tratamento viola a LGPD, após tentativa de resolução conosco.</p>

        <h3 id="cookies" class="scroll-mt-24">SEÇÃO 10 - Cookies e tecnologias similares</h3>
        <p>Utilizamos cookies e armazenamento local essenciais para autenticação, preferências de sessão e segurança. Não utilizamos cookies de publicidade comportamental de terceiros na aplicação principal.</p>

        <h3>SEÇÃO 11 - Alterações desta política</h3>
        <p>Podemos atualizar este documento periodicamente. Alterações relevantes serão comunicadas por e-mail ou aviso na plataforma. A versão vigente estará sempre disponível em <a href="{{ $politica }}">https://www.b2bsafe.com.br/policy.</a> O uso continuado após a publicação implica ciência da versão vigente.</p>
    </section>

    <section id="termos-de-uso" aria-labelledby="termos-de-uso-titulo" class="scroll-mt-24 space-y-5">
        <h2 id="termos-de-uso-titulo">Termos de Uso</h2>

        <p>Estes Termos de Uso regulam o acesso e a utilização do B2BSafe Connect, plataforma SaaS de atendimento omnichannel operada pela B2BSafe Consulting Partners LTDA (CNPJ 41.708.313/0001-86), com sede em Rua Peruíbe (Condomínio Estância Marambaia), 397, Marambaia, Vinhedo/SP, CEP 13287-140, Brasil. Ao criar uma conta ou utilizar o serviço, você declara ter lido, compreendido e aceito integralmente estes termos e a Política de Privacidade.</p>

        <h3>SEÇÃO 1 - Objeto do serviço</h3>
        <p>O B2BSafe Connect oferece ferramentas de atendimento multicanal, gestão de conversas, campanhas, chatbots, distribuição de leads, relatórios e integrações com provedores de mensageria, incluindo WhatsApp Business Platform via Meta Cloud API e parceiros autorizados.</p>

        <h3>SEÇÃO 2 - Cadastro e elegibilidade</h3>
        <p>O cadastro é destinado a pessoas jurídicas (CNPJ) e seus representantes legalmente autorizados.</p>
        <p>Você deve fornecer informações verdadeiras, completas e atualizadas.</p>
        <p>É proibido compartilhar credenciais de acesso; cada usuário deve possuir login individual.</p>
        <p>O titular da conta (Administrador) responde pelos usuários vinculados à empresa.</p>

        <h3>SEÇÃO 3 - Uso aceitável</h3>
        <p>É vedado utilizar a plataforma para:</p>
        <p>Envio de spam, phishing, conteúdo ilegal, discriminatório ou que viole direitos de terceiros;</p>
        <p>Disparos em massa não autorizados ou em desacordo com políticas da Meta/WhatsApp;</p>
        <p>Coleta ou tratamento de dados pessoais sem base legal ou consentimento adequado;</p>
        <p>Engenharia reversa, tentativa de acesso não autorizado ou sobrecarga intencional dos sistemas;</p>
        <p>Revenda não autorizada do serviço ou uso fora do escopo contratado.</p>

        <h3>SEÇÃO 4 -Integrações, Meta e WhatsApp</h3>
        <p>O cliente é integralmente responsável pelo número WhatsApp conectado, pelos templates aprovados, pelo opt-in dos destinatários, pelo conteúdo das mensagens e pela conformidade com as políticas da Meta Platforms, incluindo WhatsApp Business Messaging Policy, Commerce Policy e termos aplicáveis ao Tech Provider / Solution Partner, quando aplicável. A B2BSafe Consulting Partners LTDA atua como facilitadora tecnológica e não se responsabiliza por bloqueios, limitações ou sanções impostas pela Meta por uso inadequado.</p>

        <h3>SEÇÃO 5 - Propriedade intelectual</h3>
        <p>A plataforma, código, marca, layout e documentação pertencem à B2BSafe Consulting Partners LTDA ou a seus licenciadores. O cliente mantém titularidade sobre seus dados, conteúdos de atendimento e materiais enviados por meio do serviço, concedendo licença limitada para processamento necessário à operação.</p>

        <h3>SEÇÃO 6 - Planos, cobrança e disponibilidade</h3>
        <p>Funcionalidades, limites e valores podem variar conforme plano contratado. Esforços razoáveis serão empregados para manter disponibilidade, mas não garantimos operação ininterrupta. Manutenções programadas ou emergenciais podem ocorrer, preferencialmente com aviso prévio quando possível.</p>

        <h3>SEÇÃO 7 - Privacidade e LGPD</h3>
        <p>O tratamento de dados pessoais rege-se pela Política de Privacidade. Empresas clientes que tratam dados de seus contatos finais atuam, em regra, como controladoras perante a LGPD, devendo informar titulares, garantir bases legais adequadas e cumprir solicitações de titulares no âmbito de sua relação com consumidores.</p>

        <h3>SEÇÃO 8 - Suspensão e encerramento</h3>
        <p>Podemos suspender ou encerrar contas em caso de violação destes termos, inadimplência, risco à segurança ou exigência legal. O cliente pode solicitar encerramento a qualquer momento por <a href="mailto:contato@b2bsafe.com.br">contato@b2bsafe.com.br</a>, observados prazos de retenção legal e backup.</p>

        <h3>SEÇÃO 9 - Limitação de responsabilidade</h3>
        <p>Na extensão permitida pela lei, a B2BSafe Consulting Partners LTDA não responde por lucros cessantes, danos indiretos ou perdas decorrentes de indisponibilidade de terceiros (Meta, operadoras, internet). A responsabilidade total, quando aplicável, limita-se ao valor pago pelo cliente nos 12 meses anteriores ao evento, salvo dolo ou culpa grave.</p>

        <h3>SEÇÃO 10 - Suspensão e encerramento</h3>
        <p>Estes termos podem ser atualizados. A versão vigente estará sempre disponível em <a href="{{ $politica }}">https://www.b2bsafe.com.br/policy.</a> Aplica-se a legislação brasileira. Foro: Comarca de Vinhedo/SP, salvo disposição legal em contrário para relações de consumo.</p>

        <p>Dúvidas: <a href="mailto:contato@b2bsafe.com.br">contato@b2bsafe.com.br</a></p>
    </section>
</x-pagina-legal>
