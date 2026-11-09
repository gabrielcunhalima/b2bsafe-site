// Google Analytics 4 com Consent Mode v2 no modo básico (RF-010): padrão negado e o script do Google
// só carrega depois do consentimento estatístico. Sem aceite, nada vai ao Google e não há cookie _ga.
export function iniciarAnalytics() {
    const id = document.querySelector('meta[name="ga4-id"]')?.content;
    if (!id) return;

    window.dataLayer = window.dataLayer || [];
    window.gtag = function gtag() {
        window.dataLayer.push(arguments);
    };
    window.gtag('consent', 'default', {
        ad_storage: 'denied',
        ad_user_data: 'denied',
        ad_personalization: 'denied',
        analytics_storage: 'denied',
    });

    let ativo = false;
    let carregado = false;

    const ativar = () => {
        ativo = true;
        window.gtag('consent', 'update', { analytics_storage: 'granted' });
        if (carregado) return;
        carregado = true;
        window.gtag('js', new Date());
        window.gtag('config', id);
        const script = document.createElement('script');
        script.async = true;
        script.src = `https://www.googletagmanager.com/gtag/js?id=${encodeURIComponent(id)}`;
        document.head.appendChild(script);
    };

    const desativar = () => {
        ativo = false;
        window.gtag('consent', 'update', { analytics_storage: 'denied' });
        // Apaga os cookies do GA4 gravados antes da recusa
        const dominio = location.hostname.replace(/^www\./, '');
        document.cookie.split(';').map((c) => c.split('=')[0].trim()).filter((nome) => nome.startsWith('_ga')).forEach((nome) => {
            document.cookie = `${nome}=; Max-Age=0; path=/`;
            document.cookie = `${nome}=; Max-Age=0; path=/; domain=.${dominio}`;
        });
    };

    const evento = (nome, parametros) => {
        if (ativo) window.gtag('event', nome, parametros);
    };

    window.addEventListener('b2b:cookies', (e) => (e.detail?.estatisticos ? ativar() : desativar()));
    window.addEventListener('b2b:lead-enviado', (e) => evento('generate_lead', { canal: e.detail.canal, servico: e.detail.servico }));
    window.addEventListener('b2b:whatsapp-clique', (e) => evento('click_whatsapp', { servico: e.detail.servico ?? 'geral', local: e.detail.local }));
}
