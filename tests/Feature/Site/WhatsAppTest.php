<?php

use App\Support\WhatsApp;

it('usa o número geral com a mensagem padrão (RN-021)', function () {
    expect(WhatsApp::link())
        ->toBe('https://wa.me/5511984205023?text='.rawurlencode('Olá! Vim pelo site da B2BSAFE.'));
});

it('cita o serviço na mensagem e usa o número geral (RN-021)', function () {
    expect(WhatsApp::linkDoServico('credito'))
        ->toStartWith('https://wa.me/5511984205023?text=')
        ->toContain(rawurlencode('Olá! Vim pelo site e quero saber sobre Crédito.'));
});

it('usa o número da maquininha para a C6 Pay (RN-021)', function () {
    expect(WhatsApp::linkDoServico('maquininha'))
        ->toStartWith('https://wa.me/5511924600991?text=')
        ->toContain(rawurlencode('Olá! Vim pelo site e quero saber sobre a maquininha C6 Pay.'));
});

it('lê os números da configuração', function () {
    config(['b2bsafe.whatsapp.geral' => '5548999990000']);

    expect(WhatsApp::link())->toStartWith('https://wa.me/5548999990000?text=');
});
