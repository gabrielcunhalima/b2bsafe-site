import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

// A fonte Urbanist vem do pacote @fontsource-variable/urbanist (importada no CSS),
// servida pelo próprio site, sem Google Fonts nem Bunny Fonts.
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/painel/theme.css'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        // IPv4 explícito: com o padrão (localhost → [::1]) a recarga automática pode não chegar ao navegador no Windows
        host: '127.0.0.1',
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
