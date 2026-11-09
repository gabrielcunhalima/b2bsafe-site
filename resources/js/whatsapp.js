// Registro do clique no WhatsApp (RF-005, RN-010): sendBeacon não atrasa a abertura do WhatsApp.
// Todo link com data-whatsapp é contado; data-servico identifica o serviço (RN-021).
export function registrarCliquesWhatsapp() {
    const token = document.querySelector('meta[name="csrf-token"]')?.content;

    document.addEventListener('click', (evento) => {
        const link = evento.target.closest('a[data-whatsapp]');
        if (!link || !token) return;

        const numero = new URL(link.href).pathname.replace(/\D/g, '');
        const dados = new FormData();
        dados.append('_token', token);
        dados.append('numero', numero);
        dados.append('pagina', `${location.pathname}#${link.dataset.whatsapp}`);
        if (link.dataset.servico) dados.append('servico', link.dataset.servico);

        navigator.sendBeacon?.('/whatsapp/clique', dados);
        window.dispatchEvent(new CustomEvent('b2b:whatsapp-clique', { detail: { servico: link.dataset.servico ?? null, local: link.dataset.whatsapp } }));
    });
}

// Links internos com data-servico (para o Fale conosco ou o "Peça sua C6 Pay") já escolhem o serviço no formulário
export function preSelecionarServico() {
    document.addEventListener('click', (evento) => {
        const link = evento.target.closest('a[data-servico]:not([data-whatsapp])');
        if (link) window.dispatchEvent(new CustomEvent('selecionar-servico', { detail: link.dataset.servico }));
    });
}
