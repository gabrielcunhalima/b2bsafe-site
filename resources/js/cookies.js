// Banner e preferências de cookies (RF-009, wireframe T-06). A escolha fica no servidor (registro em
// "consentimentos" e cookie de 12 meses); aqui só a interface e o aviso ao GA4 (evento "b2b:cookies").
export default (opcoes = {}) => ({
    escolha: opcoes.escolha ?? null,
    estatisticos: opcoes.escolha?.estatisticos ?? false,
    dialogoAberto: false,
    aviso: '',

    get faixaAberta() {
        return this.escolha === null && !this.dialogoAberto;
    },

    init() {
        // Os botões flutuantes sobem enquanto a faixa está aberta
        this.$watch('faixaAberta', () => this.$nextTick(() => this.ajustarFlutuantes()));
        this.$nextTick(() => this.ajustarFlutuantes());

        if (this.escolha) window.dispatchEvent(new CustomEvent('b2b:cookies', { detail: this.escolha }));
    },

    ajustarFlutuantes() {
        const altura = this.faixaAberta ? this.$refs.faixa.offsetHeight : 0;
        document.documentElement.style.setProperty('--altura-faixa-cookies', `${altura}px`);
    },

    abrirDialogo() {
        this.estatisticos = this.escolha?.estatisticos ?? false;
        this.dialogoAberto = true;
    },

    fecharDialogo() {
        this.dialogoAberto = false;
    },

    async salvar(estatisticos) {
        const token = document.querySelector('meta[name="csrf-token"]')?.content;
        const corpo = new FormData();
        corpo.append('_token', token ?? '');
        corpo.append('estatisticos', estatisticos ? '1' : '0');

        try {
            const resposta = await fetch(opcoes.url, { method: 'POST', headers: { Accept: 'application/json' }, body: corpo });
            if (!resposta.ok) throw new Error(String(resposta.status));
            this.escolha = await resposta.json();
        } catch {
            // Sem conexão: vale para esta visita, e o banner volta na próxima
            this.escolha = { estatisticos };
        }

        this.dialogoAberto = false;
        window.dispatchEvent(new CustomEvent('b2b:cookies', { detail: this.escolha }));
        this.aviso = 'Preferências salvas. Você pode mudar quando quiser em "Preferências de cookies", no rodapé.';
        setTimeout(() => (this.aviso = ''), 4000);
    },
});
