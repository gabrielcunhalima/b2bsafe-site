import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import { createIcons, ArrowRight, ChevronRight, ExternalLink, Lock, Mail, MapPin, Menu, MessageCircle, X } from 'lucide';

// Ícones Lucide: só os importados entram no bundle. Uso no Blade: <i data-lucide="menu"></i>
// (regra do design system: nada de emojis; logos de marcas ficam em <x-icone-marca>).
createIcons({ icons: { ArrowRight, ChevronRight, ExternalLink, Lock, Mail, MapPin, Menu, MessageCircle, X } });

// Cabeçalho do site (T-10): menu móvel em tela cheia e item do menu da seção visível.
Alpine.data('menuSite', () => ({
    aberto: false,
    ativa: null,

    init() {
        // Todas as seções, com ou sem id: numa seção sem id (ex.: o topo da Home) nenhum item fica marcado.
        const secoes = document.querySelectorAll('main section');

        if (secoes.length && 'IntersectionObserver' in window) {
            // A seção que cruza o meio da tela é a "visível".
            const observador = new IntersectionObserver(
                (entradas) => entradas.forEach((entrada) => {
                    if (entrada.isIntersecting) this.ativa = entrada.target.id || null;
                }),
                { rootMargin: '-45% 0px -50% 0px' },
            );
            secoes.forEach((secao) => observador.observe(secao));
        }

        // Ao alargar a janela até o menu de desktop, o painel móvel some: fecha para liberar a rolagem.
        window.matchMedia('(min-width: 1024px)').addEventListener('change', (consulta) => {
            if (consulta.matches) this.fechar();
        });
    },

    abrir() {
        this.aberto = true;
    },

    // O x-trap devolve o foco ao botão "Menu" ao fechar.
    fechar() {
        this.aberto = false;
    },
}));

Alpine.plugin(focus);
window.Alpine = Alpine;
Alpine.start();
