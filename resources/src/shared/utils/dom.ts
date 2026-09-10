/*
 | Мелкие обёртки над DOM. Blade отдаёт готовую разметку, поэтому
 | фронтенд почти всегда начинает с поиска уже существующего узла —
 | и почти всегда узла может не быть: страниц много, блоки разные.
 */

/** Находит элемент или возвращает null — без падения на несуществующем блоке. */
export function qs<E extends Element = HTMLElement>(selector: string, root: ParentNode = document): E | null {
    return root.querySelector<E>(selector);
}

/** Находит все элементы обычным массивом, а не NodeList. */
export function qsa<E extends Element = HTMLElement>(selector: string, root: ParentNode = document): E[] {
    return Array.from(root.querySelectorAll<E>(selector));
}

/** Помечает узел обработанным. Возвращает false, если его уже трогали. */
export function claim(el: HTMLElement, flag: string): boolean {
    if (el.dataset[flag]) return false;

    el.dataset[flag] = '1';

    return true;
}

/** Показывает или прячет блок и синхронно правит aria-expanded у кнопки. */
export function toggleDisclosure(trigger: Element | null, panel: HTMLElement | null, open: boolean): void {
    if (panel) panel.hidden = !open;
    trigger?.setAttribute('aria-expanded', String(open));
}

/** Скрыт ли блок сейчас. Отдельно, потому что hidden умеет быть не только да/нет. */
export function isHidden(panel: HTMLElement | null): boolean {
    return Boolean(panel?.hidden);
}
