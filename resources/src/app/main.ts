import { createApp } from 'vue';
import { islands } from '@/app/config/islands';
import { setupPlugins } from '@/app/config/plugins';

import { setupLayout } from '@/modules/layout';
import { setupLead } from '@/modules/lead';
import { setupShop } from '@/modules/shop';
import { useReveal } from '@/shared/composables/useReveal';
import { useSwipeDots } from '@/shared/composables/useSwipeDots';
import { qsa } from '@/shared/utils/dom';

/*
 | Точка входа.
 |
 | Порядок важен: сначала поведение уже отрисованной страницы,
 | потом острова. Разметка от Blade полностью работоспособна и
 | без этого файла — скрипт только добавляет удобство.
 */

function mountIslands(): void {
    qsa('[data-island]').forEach((el) => {
        const name = el.dataset.island;
        const load = name ? islands[name] : undefined;

        if (!load) {
            console.warn(`Остров «${name}» не найден`);
            return;
        }

        load().then(({ default: component }) => {
            const props = el.dataset.props ? JSON.parse(el.dataset.props) : {};

            const app = createApp(component, props);
            setupPlugins(app);
            app.mount(el);
        });
    });
}

function bootstrap(): void {
    setupLayout();
    setupLead();
    setupShop();

    useReveal();
    useSwipeDots();

    mountIslands();
}

bootstrap();
