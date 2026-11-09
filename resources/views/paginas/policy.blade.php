{{--
    Política de Privacidade e Termos de Uso do B2BSafe Connect (US-005, RF-004): texto atual da B2BSAFE,
    com as numerações corrigidas (a segunda "Seção 6" virou 9; a Seção 10 dos Termos ganhou o título certo)
    e o link "/policy." trocado por "/policy".
--}}
@php
    $secoes = [
        'connect-privacidade' => 'Política de Privacidade do B2BSafe Connect',
        'connect-termos' => 'Termos de Uso do B2BSafe Connect',
    ];
    $contato = 'contato@b2bsafe.com.br';
    $endereco = 'Rua Peruíbe (Condomínio Estância Marambaia), 397, Marambaia, Vinhedo/SP, CEP 13287-140, Brasil';
@endphp

<x-pagina-legal titulo="B2BSafe Connect: Privacidade e Termos de Uso"
    descricao="Política de Privacidade e Termos de Uso do B2BSafe Connect, plataforma SaaS de atendimento omnichannel da B2BSafe Consulting Partners."
    :atualizada-em="config('b2bsafe.documentos.policy_atualizada_em')" :secoes="$secoes">

    <p>
        Esta página trata do <strong>B2BSafe Connect</strong>, a plataforma de atendimento omnichannel da B2BSafe Consulting Partners.
        Para o tratamento de dados deste site (formulário, assistente virtual e cookies), veja a
        <a href="{{ route('privacidade') }}">Política de Privacidade do site</a>.
    </p>

    <section id="connect-privacidade" aria-labelledby="connect-privacidade-titulo" class="scroll-mt-24 space-y-8">
        <h2 id="connect-privacidade-titulo" class="!text-3xl">Política de Privacidade do B2BSafe Connect</h2>
        <p>
            A B2BSafe Consulting Partners LTDA, nome fantasia B2BSafe Consulting Partners, inscrita no CNPJ 41.708.313/0001-86, com sede em {{ $endereco }},
            é a controladora dos dados pessoais tratados no âmbito do B2BSafe Connect, plataforma SaaS de atendimento omnichannel. Esta Política de Privacidade
            descreve como coletamos, usamos, armazenamos, compartilhamos e protegemos informações, em conformidade com a Lei Geral de Proteção de Dados
            (LGPD, Lei 13.709/2018) e demais normas aplicáveis, incluindo exigências de plataformas integradas (Meta / WhatsApp Business Platform).
        </p>

        <div>
            <h3 class="!mt-0 text-xl">Seção 1. Controlador, operador e contatos</h3>
            <ul>
                <li>Controladora: B2BSafe Consulting Partners LTDA (CNPJ 41.708.313/0001-86).</li>
                <li>Endereço: {{ $endereco }}.</li>
                <li>Canal geral de privacidade: <a href="mailto:{{ $contato }}">{{ $contato }}</a>.</li>
                <li>Encarregado de Proteção de Dados (DPO): <a href="mailto:ti@b2bsafe.com.br">ti@b2bsafe.com.br</a>.</li>
            </ul>
            <p>
                Empresas clientes que utilizam o B2BSafe Connect para atender seus próprios contatos finais (consumidores, leads, parceiros) atuam, em regra,
                como controladoras dos dados desses titulares. A B2BSafe Consulting Partners LTDA atua como operadora ao processar tais dados exclusivamente
                conforme instruções contratuais do cliente e para prestação do serviço contratado.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 2. Dados que coletamos</h3>
            <ul>
                <li><strong>Cadastro da empresa e usuários:</strong> razão social, CNPJ, nome, e-mail, senha (armazenada de forma criptografada), cargo, foto de perfil e preferências de conta.</li>
                <li><strong>Dados operacionais de atendimento:</strong> conversas, mensagens, anexos, histórico de atendimento, etiquetas, filas, distribuição de leads, campanhas, chatbots e métricas de uso.</li>
                <li><strong>Dados de contatos finais:</strong> nome, telefone, identificadores de WhatsApp, e-mail e demais informações enviadas pelos clientes da sua empresa durante conversas ou importações.</li>
                <li><strong>Dados de plataformas Meta / WhatsApp:</strong> identificadores de conta comercial (WABA), números de telefone, templates, status de entrega, webhooks e metadados exigidos pela WhatsApp Business Platform, conforme autorizado pelo cliente durante a conexão (Embedded Signup ou credenciais).</li>
                <li><strong>Integrações opcionais:</strong> tokens e credenciais de APIs (Gupshup, Zernio, Evolution e similares), somente quando habilitadas pelo cliente.</li>
                <li><strong>Dados técnicos:</strong> endereço IP, logs de acesso, dispositivo, navegador, cookies essenciais e registros de auditoria para segurança e prevenção a fraudes.</li>
            </ul>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 3. Finalidades do tratamento</h3>
            <ul>
                <li>Criar, autenticar e administrar contas de empresas e usuários;</li>
                <li>Operar o serviço de atendimento, campanhas, chatbots, distribuição e relatórios contratados;</li>
                <li>Integrar canais de comunicação autorizados pelo cliente, incluindo WhatsApp Business Platform;</li>
                <li>Cumprir políticas e requisitos técnicos de parceiros de mensageria (Meta, BSPs e conectores);</li>
                <li>Garantir segurança, autenticação, prevenção a abusos, suporte técnico e melhoria do produto;</li>
                <li>Cumprir obrigações legais, regulatórias e responder a solicitações de autoridades competentes.</li>
            </ul>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 4. Bases legais (LGPD)</h3>
            <p>O tratamento ocorre com fundamento, conforme o caso, em:</p>
            <ul>
                <li>Execução de contrato e procedimentos preliminares (cadastro, onboarding e prestação do serviço);</li>
                <li>Legítimo interesse (segurança, melhoria do produto, prevenção a fraudes e continuidade operacional);</li>
                <li>Cumprimento de obrigação legal ou regulatória;</li>
                <li>Consentimento, quando exigido (ex.: aceite desta política e dos termos no cadastro).</li>
            </ul>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 5. Compartilhamento de dados</h3>
            <p>Não vendemos dados pessoais. Podemos compartilhar informações estritamente necessárias com:</p>
            <ul>
                <li><strong>Meta Platforms / WhatsApp Business Platform:</strong> para envio, recebimento e gestão de mensagens, templates e contas comerciais, conforme políticas da Meta e autorização do cliente.</li>
                <li><strong>Provedores de infraestrutura:</strong> hospedagem, banco de dados, e-mail transacional (ex.: Brevo), monitoramento e backup, sob contratos e medidas de segurança.</li>
                <li><strong>Parceiros de integração:</strong> somente quando o cliente habilita a integração (Gupshup, Zernio, Evolution etc.).</li>
                <li><strong>Autoridades:</strong> quando houver obrigação legal, ordem judicial ou requisição válida.</li>
            </ul>
            <p>O compartilhamento respeita contratos, medidas de segurança e instruções do cliente titular dos dados operacionais de atendimento.</p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 6. Transferência internacional</h3>
            <p>
                Alguns provedores utilizados, em especial a Meta Platforms, Inc. (WhatsApp Business Platform), podem processar dados em servidores localizados fora do Brasil,
                inclusive nos Estados Unidos. Quando aplicável, adotamos salvaguardas contratuais e técnicas compatíveis com a LGPD para proteger os dados transferidos,
                limitando o uso ao necessário para a prestação do serviço autorizado pelo cliente.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 7. Retenção e exclusão</h3>
            <p>
                Mantemos os dados enquanto a conta estiver ativa e pelo tempo necessário para cumprir obrigações legais, resolver disputas, backups e continuidade operacional.
                O cliente ou titular pode solicitar exclusão conforme as instruções desta página ou por e-mail para <a href="mailto:{{ $contato }}">{{ $contato }}</a>
                (assunto: "Exclusão de dados"). Prazo de resposta: até 30 dias úteis, salvo exigências legais em contrário ou necessidade de retenção mínima exigida por lei.
            </p>
            <p>
                Dados originados de integrações Meta/WhatsApp também podem estar sujeitos às políticas e fluxos de exclusão da Meta. Quando aplicável, orientaremos o cliente
                sobre os procedimentos complementares.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 8. Segurança</h3>
            <p>
                Adotamos medidas técnicas e organizacionais como criptografia de credenciais sensíveis, controle de acesso por perfil, autenticação, logs de auditoria,
                segregação de ambientes e backups. Nenhum sistema é 100% invulnerável; em caso de incidente relevante, comunicaremos conforme exigido pela legislação aplicável.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 9. Direitos do titular</h3>
            <p>Conforme a LGPD, você pode solicitar:</p>
            <ul>
                <li>Confirmação de tratamento e acesso aos dados;</li>
                <li>Correção de dados incompletos, inexatos ou desatualizados;</li>
                <li>Anonimização, bloqueio ou eliminação de dados desnecessários ou excessivos;</li>
                <li>Portabilidade, quando aplicável;</li>
                <li>Informações sobre compartilhamento e revogação de consentimento, quando cabível.</li>
            </ul>
            <p>
                Solicitações de usuários cadastrados na plataforma: <a href="mailto:{{ $contato }}">{{ $contato }}</a> ou <a href="mailto:ti@b2bsafe.com.br">ti@b2bsafe.com.br</a>.
                Consumidores finais atendidos por empresas clientes devem, preferencialmente, contatar diretamente a empresa que realiza o atendimento (controladora dos dados de contato).
            </p>
            <p>Você também pode apresentar reclamação à Autoridade Nacional de Proteção de Dados (ANPD) caso entenda que o tratamento viola a LGPD, após tentativa de resolução conosco.</p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 10. Cookies e tecnologias similares</h3>
            <p>
                Utilizamos cookies e armazenamento local essenciais para autenticação, preferências de sessão e segurança. Não utilizamos cookies de publicidade
                comportamental de terceiros na aplicação principal.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 11. Alterações desta política</h3>
            <p>
                Podemos atualizar este documento periodicamente. Alterações relevantes serão comunicadas por e-mail ou aviso na plataforma. A versão vigente estará sempre
                disponível em <a href="{{ route('policy') }}">{{ route('policy') }}</a>. O uso continuado após a publicação implica ciência da versão vigente.
            </p>
        </div>
    </section>

    <section id="connect-termos" aria-labelledby="connect-termos-titulo" class="scroll-mt-24 space-y-8">
        <h2 id="connect-termos-titulo" class="!text-3xl">Termos de Uso do B2BSafe Connect</h2>
        <p>
            Estes Termos de Uso regulam o acesso e a utilização do B2BSafe Connect, plataforma SaaS de atendimento omnichannel operada pela B2BSafe Consulting Partners LTDA
            (CNPJ 41.708.313/0001-86), com sede em {{ $endereco }}. Ao criar uma conta ou utilizar o serviço, você declara ter lido, compreendido e aceito integralmente
            estes termos e a Política de Privacidade.
        </p>

        <div>
            <h3 class="!mt-0 text-xl">Seção 1. Objeto do serviço</h3>
            <p>
                O B2BSafe Connect oferece ferramentas de atendimento multicanal, gestão de conversas, campanhas, chatbots, distribuição de leads, relatórios e integrações
                com provedores de mensageria, incluindo WhatsApp Business Platform via Meta Cloud API e parceiros autorizados.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 2. Cadastro e elegibilidade</h3>
            <ul>
                <li>O cadastro é destinado a pessoas jurídicas (CNPJ) e seus representantes legalmente autorizados.</li>
                <li>Você deve fornecer informações verdadeiras, completas e atualizadas.</li>
                <li>É proibido compartilhar credenciais de acesso; cada usuário deve possuir login individual.</li>
                <li>O titular da conta (Administrador) responde pelos usuários vinculados à empresa.</li>
            </ul>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 3. Uso aceitável</h3>
            <p>É vedado utilizar a plataforma para:</p>
            <ul>
                <li>Envio de spam, phishing, conteúdo ilegal, discriminatório ou que viole direitos de terceiros;</li>
                <li>Disparos em massa não autorizados ou em desacordo com políticas da Meta/WhatsApp;</li>
                <li>Coleta ou tratamento de dados pessoais sem base legal ou consentimento adequado;</li>
                <li>Engenharia reversa, tentativa de acesso não autorizado ou sobrecarga intencional dos sistemas;</li>
                <li>Revenda não autorizada do serviço ou uso fora do escopo contratado.</li>
            </ul>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 4. Integrações, Meta e WhatsApp</h3>
            <p>
                O cliente é integralmente responsável pelo número WhatsApp conectado, pelos templates aprovados, pelo opt-in dos destinatários, pelo conteúdo das mensagens
                e pela conformidade com as políticas da Meta Platforms, incluindo WhatsApp Business Messaging Policy, Commerce Policy e termos aplicáveis ao Tech Provider /
                Solution Partner, quando aplicável. A B2BSafe Consulting Partners LTDA atua como facilitadora tecnológica e não se responsabiliza por bloqueios, limitações
                ou sanções impostas pela Meta por uso inadequado.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 5. Propriedade intelectual</h3>
            <p>
                A plataforma, código, marca, layout e documentação pertencem à B2BSafe Consulting Partners LTDA ou a seus licenciadores. O cliente mantém titularidade sobre
                seus dados, conteúdos de atendimento e materiais enviados por meio do serviço, concedendo licença limitada para processamento necessário à operação.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 6. Planos, cobrança e disponibilidade</h3>
            <p>
                Funcionalidades, limites e valores podem variar conforme plano contratado. Esforços razoáveis serão empregados para manter disponibilidade, mas não garantimos
                operação ininterrupta. Manutenções programadas ou emergenciais podem ocorrer, preferencialmente com aviso prévio quando possível.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 7. Privacidade e LGPD</h3>
            <p>
                O tratamento de dados pessoais rege-se pela Política de Privacidade. Empresas clientes que tratam dados de seus contatos finais atuam, em regra, como
                controladoras perante a LGPD, devendo informar titulares, garantir bases legais adequadas e cumprir solicitações de titulares no âmbito de sua relação com consumidores.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 8. Suspensão e encerramento</h3>
            <p>
                Podemos suspender ou encerrar contas em caso de violação destes termos, inadimplência, risco à segurança ou exigência legal. O cliente pode solicitar
                encerramento a qualquer momento por <a href="mailto:{{ $contato }}">{{ $contato }}</a>, observados prazos de retenção legal e backup.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 9. Limitação de responsabilidade</h3>
            <p>
                Na extensão permitida pela lei, a B2BSafe Consulting Partners LTDA não responde por lucros cessantes, danos indiretos ou perdas decorrentes de indisponibilidade
                de terceiros (Meta, operadoras, internet). A responsabilidade total, quando aplicável, limita-se ao valor pago pelo cliente nos 12 meses anteriores ao evento,
                salvo dolo ou culpa grave.
            </p>
        </div>

        <div>
            <h3 class="!mt-0 text-xl">Seção 10. Alterações e foro</h3>
            <p>
                Estes termos podem ser atualizados. A versão vigente estará sempre disponível em <a href="{{ route('policy') }}">{{ route('policy') }}</a>.
                Aplica-se a legislação brasileira. Foro: Comarca de Vinhedo/SP, salvo disposição legal em contrário para relações de consumo.
            </p>
            <p>Dúvidas: <a href="mailto:{{ $contato }}">{{ $contato }}</a>.</p>
        </div>
    </section>
</x-pagina-legal>
