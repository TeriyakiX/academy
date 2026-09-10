import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'node:path';

/*
 | Сборка фронтенда.
 |
 | Точек входа несколько: общий скрипт с глобальными стилями подключает
 | layout, остальные стили — постранично. Так страница договора не тянет
 | стили каталога, а каталог — стили конструктора.
 */

const styles = (...names: string[]) => names.map((name) => `resources/src/app/assets/styles/${name}.css`);

export default defineConfig({
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/src'),
        },
    },
    plugins: [
        laravel({
            input: [
                ...styles(
                    'app',
                    'ui',
                    'site-layout',
                    'home-blocks',
                    'course',
                    'constructor',
                    'reviews',
                    'shop',
                    'legal',
                    'mobile',
                ),
                'resources/src/app/main.ts',
            ],
            refresh: true,
        }),
        vue(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
