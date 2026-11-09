{{-- Política de Privacidade do site (US-004, RF-003). A versão vem da configuração e é a registrada no aceite (RN-011). --}}
@php
    $secoes = [
        'quem-somos' => '1. Quem somos',
        'dados' => '2. Dados que coletamos',
        'finalidades' => '3. Para que usamos',
        'bases-legais' => '4. Bases legais',
        'compartilhamento' => '5. Com quem compartilhamos',
        'transferencia' => '6. Transferência internacional',
        'retencao' => '7. Por quanto tempo guardamos',
        'cookies' => '8. Cookies e Google Analytics',
        'direitos' => '9. Seus direitos',
        'seguranca' => '10. Segurança',
        'alteracoes' => '11. Alterações desta política',
    ];
    $email = config('b2bsafe.email_contato');
    $encarregado = config('b2bsafe.email_encarregado');
@endphp

<x-pagina-legal titulo="Política de Privacidade"
    descricao="Como a B2BSAFE trata os dados pessoais de quem usa este site: formulário, assistente virtual, WhatsApp, cookies e Google Analytics."
    :versao="config('b2bsafe.versoes.politica_privacidade')" :atualizada-em="config('b2bsafe.documentos.privacidade_atualizada_em')" :secoes="$secoes">

    <p>
        Esta política explica como tratamos os dados pessoais de quem visita este site, preenche o formulário de contato,
        conversa com o assistente virtual ou nos chama pelo WhatsApp, conforme a Lei Geral de Proteção de Dados
        (LGPD, Lei 13.709/2018).
    </p>

    <x-pagina-legal.secao id="quem-somos" numero="1" titulo="Quem somos">
        <p>
            Este site é da B2BSAFE, escritório parceiro e distribuidor do C6 Bank. As empresas responsáveis (controladoras) pelos dados tratados aqui são:
        </p>
        <ul>
            @foreach (config('b2bsafe.empresas') as $empresa)
                <li><strong>{{ $empresa['nome'] }}</strong>, CNPJ {{ $empresa['cnpj'] }}, {{ $empresa['endereco'] }}, {{ $empresa['cidade'] }}.</li>
            @endforeach
        </ul>
        <p>
            Contato geral: <a href="mailto:{{ $email }}">{{ $email }}</a>.
            Encarregado de Proteção de Dados (DPO): <a href="mailto:{{ $encarregado }}">{{ $encarregado }}</a>.
        </p>
        <p>As informações deste site não são canais oficiais do C6 Bank. Para assuntos da sua conta, fale direto com o C6.</p>
    </x-pagina-legal.secao>

    <x-pagina-legal.secao id="dados" numero="2" titulo="Dados que coletamos">
        <h3>Formulário de contato</h3>
        <p>Nome, WhatsApp, e-mail, serviço de interesse e, se você quiser, uma mensagem. Também registramos a data, a hora e a versão desta política que você aceitou.</p>
        <h3>Assistente virtual</h3>
        <p>
            As mensagens que você escreve no chat e, se você informar, seu nome, WhatsApp ou e-mail. Antes de gravar e de processar,
            mascaramos números que pareçam CPF, CNPJ, cartão ou senha. Não peça nem envie esses dados no chat.
        </p>
        <h3>Origem da visita</h3>
        <p>
            De onde você chegou ao site: o link de campanha (parâmetros UTM e identificadores de anúncios do Google e da Meta), o site anterior e a página de entrada.
            Esse dado só é gravado se você enviar o formulário, conversar com o assistente ou clicar no WhatsApp.
        </p>
        <h3>Cliques no WhatsApp</h3>
        <p>Quando você clica para falar no WhatsApp, contamos o clique com a página, o serviço e a origem da visita, sem identificar você.</p>
        <h3>Dados técnicos</h3>
        <p>Endereço IP e registros de acesso, usados para segurança e para limitar envios abusivos do formulário.</p>
    </x-pagina-legal.secao>

    <x-pagina-legal.secao id="finalidades" numero="3" titulo="Para que usamos">
        <ul>
            <li>Responder ao seu contato e apresentar os produtos do C6 Empresas que você pediu.</li>
            <li>Tirar dúvidas pelo assistente virtual e encaminhar você a um atendente quando necessário.</li>
            <li>Saber quais canais e campanhas trazem contatos, para melhorar nossa comunicação.</li>
            <li>Medir o uso do site com o Google Analytics, só com o seu consentimento.</li>
            <li>Proteger o site contra fraudes, robôs e abusos, e cumprir obrigações legais.</li>
        </ul>
    </x-pagina-legal.secao>

    <x-pagina-legal.secao id="bases-legais" numero="4" titulo="Bases legais">
        <ul>
            <li><strong>Consentimento:</strong> ao aceitar esta política no formulário ou no chat, e ao aceitar os cookies estatísticos.</li>
            <li><strong>Procedimentos preliminares a um contrato:</strong> para responder ao seu pedido de informações sobre um produto.</li>
            <li><strong>Legítimo interesse:</strong> segurança do site, prevenção de abusos e estatísticas de origem sem identificar você.</li>
            <li><strong>Cumprimento de obrigação legal:</strong> quando uma lei ou autoridade exigir.</li>
        </ul>
    </x-pagina-legal.secao>

    <x-pagina-legal.secao id="compartilhamento" numero="5" titulo="Com quem compartilhamos">
        <p>Não vendemos dados pessoais. Compartilhamos só o necessário com:</p>
        <ul>
            <li><strong>C6 Bank:</strong> quando você decide contratar um produto, para a proposta e a análise.</li>
            <li><strong>Mistral AI</strong> (França): processa as mensagens do assistente virtual para gerar as respostas.</li>
            <li><strong>Google</strong> (Estados Unidos): Google Analytics, só com o seu consentimento, e o serviço de e-mail que avisa a equipe sobre novos contatos.</li>
            <li><strong>Hostinger:</strong> hospedagem do site e do banco de dados.</li>
            <li><strong>Autoridades:</strong> quando houver obrigação legal ou ordem judicial.</li>
        </ul>
    </x-pagina-legal.secao>

    <x-pagina-legal.secao id="transferencia" numero="6" titulo="Transferência internacional">
        <p>
            A Mistral AI processa dados na União Europeia, que tem nível de proteção reconhecido, e o Google pode processar dados nos Estados Unidos.
            Nesses casos, usamos provedores com cláusulas contratuais e medidas de segurança compatíveis com a LGPD.
        </p>
    </x-pagina-legal.secao>

    <x-pagina-legal.secao id="retencao" numero="7" titulo="Por quanto tempo guardamos">
        <ul>
            <li>Contatos, conversas e cliques: até <strong>24 meses</strong> depois da última interação. Depois disso, os dados que identificam você são apagados ou anonimizados e ficam só números agregados.</li>
            <li>Registro do seu aceite desta política e da sua escolha de cookies: pelo tempo necessário para comprovar o consentimento.</li>
            <li>Sua escolha de cookies vale por 12 meses, e a origem da visita (com consentimento) por 90 dias no seu navegador.</li>
        </ul>
    </x-pagina-legal.secao>

    <x-pagina-legal.secao id="cookies" numero="8" titulo="Cookies e Google Analytics">
        <h3>Necessários (sempre ativos)</h3>
        <p>Mantêm a sessão, protegem os formulários contra fraudes e guardam a sua escolha de cookies.</p>
        <h3>Estatísticos (só com o seu consentimento)</h3>
        <p>
            Cookies do Google Analytics 4 (<code>_ga</code> e <code>_ga_*</code>), para medir visitas e conversões, e o cookie de origem da visita (90 dias).
            Usamos o modo de consentimento do Google: sem o seu aceite, nenhum cookie do Google Analytics é gravado.
        </p>
        <p>
            Você pode mudar a sua escolha a qualquer momento em
            <button type="button" x-data @click="$dispatch('abrir-preferencias-cookies')" class="rounded font-semibold text-preto underline">Preferências de cookies</button>,
            também no rodapé do site.
        </p>
    </x-pagina-legal.secao>

    <x-pagina-legal.secao id="direitos" numero="9" titulo="Seus direitos">
        <p>Pela LGPD, você pode pedir a qualquer momento:</p>
        <ul>
            <li>confirmação de que tratamos seus dados e acesso a eles;</li>
            <li>correção de dados incompletos, inexatos ou desatualizados;</li>
            <li>anonimização, bloqueio ou eliminação de dados desnecessários ou tratados em desacordo com a lei;</li>
            <li>eliminação dos dados tratados com o seu consentimento e revogação do consentimento;</li>
            <li>informação sobre com quem compartilhamos seus dados;</li>
            <li>portabilidade, quando aplicável.</li>
        </ul>
        <p>
            Para exercer seus direitos, escreva para o encarregado: <a href="mailto:{{ $encarregado }}">{{ $encarregado }}</a>.
            Respondemos em até 15 dias. Você também pode reclamar à Autoridade Nacional de Proteção de Dados (ANPD).
        </p>
    </x-pagina-legal.secao>

    <x-pagina-legal.secao id="seguranca" numero="10" titulo="Segurança">
        <p>
            Usamos conexão criptografada (HTTPS), controle de acesso por perfil na área restrita, registro das ações da equipe,
            cópias de segurança e limites contra envios abusivos. Nenhum sistema é totalmente invulnerável; em caso de incidente relevante,
            comunicaremos os titulares e a ANPD conforme a lei.
        </p>
    </x-pagina-legal.secao>

    <x-pagina-legal.secao id="alteracoes" numero="11" titulo="Alterações desta política">
        <p>
            Podemos atualizar esta política. A versão e a data da última atualização ficam no topo da página, e o seu aceite fica registrado com a versão vigente.
            Quando a política de cookies mudar, o banner de cookies aparece de novo para você escolher.
        </p>
    </x-pagina-legal.secao>
</x-pagina-legal>
