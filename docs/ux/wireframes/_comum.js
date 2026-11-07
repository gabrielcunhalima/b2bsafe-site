// Partes repetidas dos wireframes. Cada página marca onde entram com data-incluir="...".
// Só para o protótipo: no Laravel isso vira layouts Blade e o painel do Filament.

const partes = {
  'cabecalho-site': () => `
    <a href="#conteudo" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-white px-3 py-2 border">Pular para o conteúdo</a>
    <header class="sticky top-0 z-30 bg-white/95 border-b border-gray-200">
      <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between gap-4">
        <a href="t01-home.html" class="flex items-center gap-2">
          <span class="inline-flex items-center justify-center w-28 h-9 border-2 border-gray-800 font-black tracking-widest text-sm">B2BSAFE</span>
          <span class="hidden sm:inline text-xs text-gray-500 leading-tight">Escritório parceiro<br>C6 Empresas</span>
        </a>
        <nav aria-label="Principal" class="hidden lg:flex items-center gap-6 text-sm text-gray-700">
          <a href="t01-home.html#servicos" class="hover:underline">Serviços</a>
          <a href="t01-home.html#maquininha" class="hover:underline">Maquininha</a>
          <a href="t01-home.html#sobre" class="hover:underline">Sobre</a>
          <a href="t01-home.html#parcerias" class="hover:underline">Parcerias</a>
          <a href="t01-home.html#credenciamento" class="hover:underline">Credenciamento</a>
          <a href="t01-home.html#contato" class="px-4 py-2 bg-gray-800 text-white rounded">Fale conosco</a>
        </nav>
        <button class="lg:hidden px-3 py-2 border border-gray-400 rounded text-sm" aria-expanded="false" aria-controls="menu-movel"><i data-lucide="menu" class="inline-block w-4 h-4 align-[-3px]" aria-hidden="true"></i> Menu</button>
      </div>
    </header>`,

  'rodape-site': () => `
    <footer class="bg-gray-800 text-gray-200 text-sm mt-16">
      <div class="max-w-6xl mx-auto px-4 py-10 grid gap-8 md:grid-cols-4">
        <div>
          <span class="inline-flex items-center justify-center w-28 h-9 border-2 border-gray-200 font-black tracking-widest text-sm">B2BSAFE</span>
          <p class="mt-3 text-gray-400">B2BSAFE, Be Safe!</p>
        </div>
        <div>
          <p class="font-semibold text-white">B2BSAFE Floripa Ltda</p>
          <p class="text-gray-400">CNPJ 58.358.780/0001-26<br>Av. Marechal Castelo Branco, 65<br>São José (SC) · 88101-020</p>
        </div>
        <div>
          <p class="font-semibold text-white">B2BSafe Consulting Partners Ltda</p>
          <p class="text-gray-400">CNPJ 41.708.313/0001-86<br>Rua Peruíbe, 397<br>Vinhedo (SP) · 13287-140</p>
        </div>
        <div class="space-y-1">
          <p class="font-semibold text-white">Contato</p>
          <p class="text-gray-400">WhatsApp (11) 98420-5023</p>
          <p class="text-gray-400">contato@b2bsafe.com.br</p>
          <p class="text-gray-400">LinkedIn · Instagram · Facebook</p>
        </div>
      </div>
      <div class="border-t border-gray-700">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-wrap gap-x-6 gap-y-2 text-gray-400">
          <a href="t04-privacidade.html" class="underline">Política de Privacidade</a>
          <a href="t05-policy.html" class="underline">Termos do B2BSafe Connect</a>
          <a href="t06-cookies.html" class="underline">Preferências de cookies</a>
        </div>
        <p class="max-w-6xl mx-auto px-4 pb-6 text-xs text-gray-400">
          A B2BSAFE é escritório parceiro e distribuidor do C6 Bank. As informações deste site não são canais oficiais do C6.
          Canais oficiais do C6 Bank: SAC 24h 0800 660 0060 · Central 3003 6116 · Ouvidoria 0800 660 6060 · faleconosco@c6bank.com.br. (RN-015)
        </p>
      </div>
    </footer>`,

  'botoes-flutuantes': () => `
    <div class="fixed right-4 bottom-4 z-40 flex flex-col items-end gap-3">
      <a href="#" class="w-14 h-14 rounded-full bg-gray-600 text-white flex items-center justify-center shadow-lg text-xs font-bold" aria-label="Falar no WhatsApp">WA</a>
      <a href="t07-chat.html" class="h-14 pl-4 pr-5 rounded-full bg-gray-800 text-white flex items-center gap-2 shadow-lg text-sm" aria-label="Abrir assistente virtual"><i data-lucide="message-circle" class="inline-block w-4 h-4 align-[-3px]" aria-hidden="true"></i> <span class="hidden sm:inline">Assistente</span></a>
    </div>`,

  'painel': (ativo, perfil) => {
    const itens = [
      ['t12-dashboard.html', 'Dashboard', 'Leads'],
      ['t13-origem.html', 'Origem e estratégia', 'Leads'],
      ['t14-leads.html', 'Leads', 'Leads'],
      ['t15-kanban.html', 'Funil', 'Leads'],
      ['t17-usuarios.html', 'Usuários', 'Administração', true],
      ['t18-auditoria.html', 'Log de auditoria', 'Administração', true],
    ];
    let grupo = '';
    const menu = itens.filter(i => !i[3] || perfil !== 'atendente').map(([href, rotulo, g]) => {
      const titulo = g !== grupo ? `<p class="px-3 pt-4 pb-1 text-xs font-semibold text-gray-400">${(grupo = g)}</p>` : '';
      const classe = rotulo === ativo ? 'bg-gray-200 font-semibold text-gray-900' : 'text-gray-600 hover:bg-gray-100';
      return `${titulo}<a href="${href}" class="block px-3 py-2 rounded ${classe}" ${rotulo === ativo ? 'aria-current="page"' : ''}>${rotulo}</a>`;
    }).join('');
    return `
      <aside class="hidden lg:block fixed inset-y-0 left-0 w-60 bg-white border-r border-gray-200 p-3 text-sm">
        <div class="h-12 flex items-center px-3 font-black tracking-widest">B2BSAFE</div>
        <nav aria-label="Painel">${menu}</nav>
      </aside>
      <header class="lg:ml-60 h-14 bg-white border-b border-gray-200 flex items-center justify-between px-4 text-sm">
        <button class="lg:hidden px-2 py-1 border rounded" aria-label="Abrir menu"><i data-lucide="menu" class="inline-block w-4 h-4 align-[-3px]" aria-hidden="true"></i></button>
        <input class="hidden md:block w-72 px-3 py-1.5 border border-gray-300 rounded" placeholder="Buscar lead (nome, e-mail, telefone)" aria-label="Busca global">
        <div class="flex items-center gap-4">
          <a href="t12-dashboard.html#notificacoes" class="relative" aria-label="Notificações: 3 não lidas"><i data-lucide="bell" class="inline-block w-4 h-4 align-[-3px]" aria-hidden="true"></i><span class="absolute -top-2 -right-3 px-1.5 rounded-full bg-gray-800 text-white text-[10px]">3</span></a>
          <a href="t19-perfil.html" class="flex items-center gap-2"><span class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-xs">${perfil === 'atendente' ? 'MS' : 'GL'}</span><span class="hidden sm:inline">${perfil === 'atendente' ? 'Mariana (Atendente)' : 'Gabriel (Admin)'}</span></a>
        </div>
      </header>`;
  },
};

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-incluir]').forEach(el => {
    const [nome, ...args] = el.dataset.incluir.split(':');
    el.outerHTML = partes[nome](...args);
  });
});
