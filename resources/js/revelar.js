// Mostra os blocos com data-revelar quando entram na tela (efeito suave de subida).
// Sem IntersectionObserver, tudo aparece de uma vez.
export function revelarAoRolar() {
    const blocos = document.querySelectorAll('[data-revelar]');

    if (!('IntersectionObserver' in window)) {
        blocos.forEach((bloco) => bloco.classList.add('revelado'));
        return;
    }

    const observador = new IntersectionObserver(
        (entradas) => entradas.forEach((entrada) => {
            if (!entrada.isIntersecting) return;
            entrada.target.classList.add('revelado');
            observador.unobserve(entrada.target);
        }),
        { rootMargin: '0px 0px -8% 0px', threshold: 0.08 },
    );

    blocos.forEach((bloco) => observador.observe(bloco));
}
