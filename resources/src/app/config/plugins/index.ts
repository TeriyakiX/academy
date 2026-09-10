import { createPinia, setActivePinia } from 'pinia';
import type { App } from 'vue';

/*
 | Общие настройки для всех Vue-островов.
 |
 | Pinia создаётся один раз на страницу и раздаётся каждому острову —
 | иначе у них были бы разные хранилища и общее состояние (ширина
 | экрана, модалка заявки) не работало бы. Тот же экземпляр делаем
 | активным вручную: часть кода живёт вне компонентов.
 */

const pinia = createPinia();

setActivePinia(pinia);

export function setupPlugins(app: App): void {
    app.use(pinia);
}
