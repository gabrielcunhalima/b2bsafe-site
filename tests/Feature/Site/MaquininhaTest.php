<?php

// US-003 (#3): página Maquininha C6 Pay (RF-002, RN-021, wireframe T-02).

it('abre a página com título, descrição e o layout do site', function () {
    $this->get(route('maquininha'))
        ->assertOk()
        ->assertSee('<title>Maquininha C6 Pay | B2BSAFE</title>', escape: false)
        ->assertSee('C6 Pay:')
        ->assertSee('A B2BSAFE é escritório parceiro e distribuidor do C6 Bank.');
});

it('mostra a tabela de taxas da configuração, com a data de referência e o aviso do C6 (RF-002)', function () {
    config(['b2bsafe.maquininha.taxas' => [['modalidade' => 'Débito', 'taxa' => '0,99%', 'recebimento' => '1 dia útil']]]);

    $this->get(route('maquininha'))
        ->assertSeeInOrder(['Modalidade', 'Débito', '0,99%', '1 dia útil'])
        ->assertSee('sujeitos a análise do C6 Bank')
        ->assertSee('consultado em 07/11/2026');
});

it('usa o WhatsApp da maquininha em todas as chamadas do conteúdo e no botão flutuante (RN-021)', function () {
    $pagina = $this->get(route('maquininha'))->getContent();
    // O rodapé mantém o WhatsApp geral da empresa; o conteúdo e o botão flutuante usam o da maquininha
    $html = substr($pagina, strpos($pagina, '<main'), strpos($pagina, '<footer') - strpos($pagina, '<main'))
        .substr($pagina, strpos($pagina, 'data-whatsapp="flutuante"') - 300);

    preg_match_all('/href="https:\/\/wa\.me\/(\d+)\?/', $html, $numeros);

    expect(array_unique($numeros[1]))->toBe(['5511924600991']);
});

it('leva "Quero minha C6 Pay" ao WhatsApp e "Abrir conta grátis" ao formulário, nunca a uma página inexistente (RF-002)', function () {
    $this->get(route('maquininha'))
        ->assertSee('Quero minha C6 Pay')
        ->assertSee('href="#pedir" data-servico="conta_corrente"', escape: false)
        ->assertSee('id="pedir"', escape: false)
        ->assertDontSee('política-de-privacidade-list');
});

it('traz o formulário com o serviço Maquininha já escolhido', function () {
    $this->get(route('maquininha'))
        ->assertSee('<option value="maquininha" selected>', escape: false);
});

it('marca o item Maquininha do menu como página atual e leva os outros itens às seções da Home', function () {
    $this->get(route('maquininha'))
        ->assertSee('href="'.route('maquininha').'" aria-current="page"', escape: false)
        ->assertSee('href="'.route('inicio').'#servicos"', escape: false);
});
