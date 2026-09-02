import { createApp } from 'vue';

/**
 * Vue-острова: компонент монтируется только если на странице есть
 * соответствующий контейнер. Так Blade отдаёт готовый HTML (SEO),
 * а Vue берёт на себя интерактив.
 */
const islands = import.meta.glob('./islands/*.vue');

document.querySelectorAll('[data-island]').forEach((el) => {
    const name = el.dataset.island;
    const loader = islands[`./islands/${name}.vue`];

    if (!loader) {
        console.warn(`Island "${name}" не найден`);
        return;
    }

    loader().then(({ default: component }) => {
        const props = el.dataset.props ? JSON.parse(el.dataset.props) : {};
        createApp(component, props).mount(el);
    });
});
