// Carrossel de serviços da Home (nova hero). Passa sozinho a cada 7 s até a pessoa interagir;
// depois de qualquer interação (setas, bolinhas, arrasto, nomes dos serviços) fica travado e só muda com ela.
// Com "reduzir movimento" no aparelho, já começa travado.

const INTERVALO = 7000;

export default (total) => ({
    atual: 0,
    total,
    travado: false,
    pausado: false,
    inicioArrasto: null,
    timer: null,

    init() {
        const reduzido = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        this.travado = reduzido;
        if (!reduzido) this.agendar();

        // Abre direto no serviço do endereço (ex.: /#servico-cambio)
        const alvo = this.indiceDoHash(window.location.hash);
        if (alvo !== null) this.escolher(alvo, false);
        window.addEventListener('hashchange', () => {
            const indice = this.indiceDoHash(window.location.hash);
            if (indice !== null) this.escolher(indice, false);
        });
    },

    indiceDoHash(hash) {
        if (!hash.startsWith('#servico-')) return null;
        const slide = this.$el.querySelector(`[data-slide="${hash.slice(9)}"]`);
        return slide ? Number(slide.dataset.indice) : null;
    },

    agendar() {
        clearInterval(this.timer);
        this.timer = setInterval(() => {
            if (!this.travado && !this.pausado && !document.hidden) this.ir(this.atual + 1);
        }, INTERVALO);
    },

    ir(indice) {
        this.atual = (indice + this.total) % this.total;
        // No celular a barra de nomes rola na horizontal: centraliza o nome do slide atual
        this.$nextTick(() => {
            const lista = this.$refs.nomes;
            const ativo = lista?.querySelector('[aria-current="true"]');
            if (ativo) lista.scrollTo({ left: ativo.offsetLeft - lista.clientWidth / 2 + ativo.clientWidth / 2, behavior: 'smooth' });
        });
    },

    // Interação da pessoa: muda o slide e trava o carrossel
    escolher(indice, rolar = true) {
        this.travado = true;
        clearInterval(this.timer);
        this.ir(indice);
        if (rolar) this.$refs.palco?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    },

    anterior() {
        this.escolher(this.atual - 1, false);
    },

    proximo() {
        this.escolher(this.atual + 1, false);
    },

    comecarArrasto(evento) {
        this.inicioArrasto = evento.clientX;
    },

    terminarArrasto(evento) {
        if (this.inicioArrasto === null) return;
        const distancia = evento.clientX - this.inicioArrasto;
        this.inicioArrasto = null;
        if (Math.abs(distancia) > 50) distancia < 0 ? this.proximo() : this.anterior();
    },
});
