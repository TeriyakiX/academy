import type { Component } from 'vue';

/*
 | Реестр Vue-островов.
 |
 | Blade отдаёт готовый HTML — это условие поисковой выдачи, — а Vue
 | подхватывает только те блоки, где нужен интерактив. Компонент
 | ищется по имени в data-island и грузится отдельным файлом, поэтому
 | страница без островов не тянет ни одного лишнего килобайта.
 |
 | Компоненты лежат в своих модулях, а не общей кучей: остров главной
 | и остров каталога — разные части сайта и правятся по-разному.
 */

type TIslandLoader = () => Promise<{ default: Component }>;

const modules = import.meta.glob<{ default: Component }>('@/modules/*/components/*.vue');

/** Имя острова — имя файла компонента: Reviews.vue → data-island="Reviews". */
export const islands: Record<string, TIslandLoader> = Object.fromEntries(
    Object.entries(modules).map(([path, loader]) => [
        path.split('/').pop()!.replace('.vue', ''),
        loader,
    ]),
);
