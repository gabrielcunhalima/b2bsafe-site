<?php

// US-006 (#6): página 404 amigável com links úteis, no layout do site.

it('responde 404 com links para a Home, a Maquininha, o formulário e o WhatsApp', function () {
    $this->get('/pagina-que-nao-existe')
        ->assertNotFound()
        ->assertSee('Não encontramos esta página.')
        ->assertSee('href="'.route('inicio').'"', escape: false)
        ->assertSee('href="'.route('maquininha').'"', escape: false)
        ->assertSee('href="'.route('inicio').'#contato"', escape: false)
        ->assertSee('https://wa.me/5511984205023', escape: false)
        ->assertSee('A B2BSAFE é escritório parceiro e distribuidor do C6 Bank.');
});
