// Formulário de lead (RF-006, wireframe T-03): validação no navegador, envio sem recarregar
// e estados de erro, envio, falha e sucesso. O servidor valida de novo (RN-001, RN-002).

const DDDS = [
    11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 24, 27, 28, 31, 32, 33, 34, 35, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48, 49,
    51, 53, 54, 55, 61, 62, 63, 64, 65, 66, 67, 68, 69, 71, 73, 74, 75, 77, 79, 81, 82, 83, 84, 85, 86, 87, 88, 89, 91, 92,
    93, 94, 95, 96, 97, 98, 99,
];

// Mesma regra do App\Support\Telefone::normalizar (RN-002)
export function telefoneValido(valor) {
    let digitos = valor.replace(/\D/g, '');
    if (digitos.startsWith('55') && (digitos.length === 12 || digitos.length === 13)) digitos = digitos.slice(2);
    if (![10, 11].includes(digitos.length) || !DDDS.includes(Number(digitos.slice(0, 2)))) return false;
    const local = digitos.slice(2);
    if (local.length === 9) return local[0] === '9';
    return !['0', '1'].includes(local[0]);
}

const ORDEM = ['nome', 'whatsapp', 'email', 'servico', 'aceite'];

export default (opcoes = {}) => ({
    servico: opcoes.servico ?? '',
    erros: {},
    tocado: {},
    // Os erros só aparecem depois do primeiro clique em "Enviar"; antes disso, nada é acusado
    tentouEnviar: false,
    enviando: false,
    falha: null,
    sucesso: null,

    get listaErros() {
        return ORDEM.filter((campo) => this.erros[campo]).map((campo) => ({ campo, mensagem: this.erros[campo] }));
    },

    selecionarServico(servico) {
        this.servico = servico;
    },

    mascararTelefone(campo) {
        const d = campo.value.replace(/\D/g, '').slice(0, 11);
        if (d.length <= 2) campo.value = d ? `(${d}` : '';
        else if (d.length <= 6) campo.value = `(${d.slice(0, 2)}) ${d.slice(2)}`;
        else if (d.length <= 10) campo.value = `(${d.slice(0, 2)}) ${d.slice(2, 6)}-${d.slice(6)}`;
        else campo.value = `(${d.slice(0, 2)}) ${d.slice(2, 7)}-${d.slice(7)}`;
    },

    mensagemDe(campo) {
        if (campo.type === 'checkbox') return campo.checked ? null : campo.dataset.erro;
        const valor = campo.value.trim();
        if (campo.required && valor === '') return campo.dataset.erro;
        if (campo.name === 'whatsapp' && !telefoneValido(valor)) return campo.dataset.erro;
        if (campo.name === 'nome' && valor.length < 2) return campo.dataset.erro;
        if (campo.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor)) return campo.dataset.erro;
        return null;
    },

    validarCampo(campo) {
        if (!ORDEM.includes(campo.name)) return;
        this.tocado[campo.name] = true;
        this.erros[campo.name] = this.mensagemDe(campo);
    },

    // Depois de uma tentativa de envio, ao sair do campo só acrescenta o erro: tirar a mensagem nesse
    // momento mexe no layout e faz o clique seguinte (ex.: na caixa de aceite) cair fora do alvo.
    avisarSeInvalido(campo) {
        if (!this.tentouEnviar) return;
        const mensagem = this.mensagemDe(campo);
        if (mensagem) this.validarCampo(campo);
    },

    // Enquanto digita, o erro some assim que o valor fica válido
    limparSeValido(campo) {
        if (this.erros[campo.name] && !this.mensagemDe(campo)) this.erros[campo.name] = null;
    },

    focarCampo(nome) {
        document.getElementById(`lead-${nome}`)?.focus();
    },

    async enviar() {
        const formulario = this.$refs.formulario;
        this.falha = null;
        this.tentouEnviar = true;

        ORDEM.forEach((nome) => this.validarCampo(formulario.elements[nome]));
        if (this.listaErros.length) {
            this.$nextTick(() => this.$refs.resumo.focus());
            return;
        }

        this.enviando = true;
        try {
            const resposta = await fetch(formulario.action, {
                method: 'POST',
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: new FormData(formulario),
            });
            const dados = await resposta.json().catch(() => ({}));

            if (resposta.status === 422) {
                this.erros = Object.fromEntries(Object.entries(dados.errors ?? {}).map(([campo, msgs]) => [campo, msgs[0]]));
                this.$nextTick(() => this.$refs.resumo.focus());
            } else if (resposta.ok) {
                this.sucesso = dados;
                window.dispatchEvent(new CustomEvent('b2b:lead-enviado', { detail: { canal: 'formulario', servico: dados.servico } }));
                this.$nextTick(() => {
                    window.lucideAtualizar?.();
                    this.$el.querySelector('[role="status"]')?.focus();
                });
            } else {
                this.falha = dados.message ?? 'Não conseguimos enviar agora. Tente de novo em alguns minutos ou fale com a gente pelo WhatsApp.';
            }
        } catch {
            this.falha = 'Não conseguimos enviar agora. Verifique sua conexão e tente de novo, ou fale com a gente pelo WhatsApp.';
        } finally {
            this.enviando = false;
        }
    },
});
