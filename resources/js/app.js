import Alpine from 'alpinejs';
import { createIcons, ArrowRight, Lock, Menu, MessageCircle, X } from 'lucide';

// Ícones Lucide: só os importados entram no bundle. Uso no Blade: <i data-lucide="menu"></i>
// (regra do design system: nada de emojis).
createIcons({ icons: { ArrowRight, Lock, Menu, MessageCircle, X } });

window.Alpine = Alpine;
Alpine.start();
