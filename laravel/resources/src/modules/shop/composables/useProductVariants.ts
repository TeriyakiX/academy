import ShopService from '@/modules/shop/services/ShopService';
import { qs, qsa } from '@/shared/utils/dom';

/*
 | Переключение цветового исполнения без перезагрузки страницы.
 |
 | Кружки цветов — обычные ссылки на страницы товаров и работают
 | без скрипта. Здесь мы лишь подменяем изменившиеся части и правим
 | адрес, чтобы переход выглядел мгновенным. Любая осечка — уходим
 | на страницу обычным переходом.
 */

/** Что именно меняется при смене цвета. */
const PARTS = [
    '.ab-product__media',
    '.ab-product__title',
    '.ab-product__lead',
    '.ab-product__pricebox',
    '.ab-product__colors',
    '.ab-product__sku',
    '.ab-product__text',
    '.ab-product__specs',
];

/** Скрытые поля формы должны уйти вместе с новым товаром. */
const FORM_FIELDS = 'input[name="source"], input[name="page"]';

function swap(next: Document): void {
    PARTS.forEach((selector) => {
        const fresh = qs(selector, next);
        const current = qs(selector);

        if (fresh && current) current.replaceWith(fresh.cloneNode(true));
    });

    const fields = qsa<HTMLInputElement>(FORM_FIELDS);
    qsa<HTMLInputElement>(FORM_FIELDS, next).forEach((input, i) => {
        const target = fields[i];
        if (target) target.value = input.value;
    });

    document.title = next.title;
}

export function useProductVariants(): void {
    document.addEventListener('click', async (e) => {
        const target = e.target as HTMLElement | null;
        const swatch = target?.closest<HTMLAnchorElement>('.ab-product__swatch');

        if (!swatch || swatch.classList.contains('is-active')) return;
        // системные жесты «открыть в новой вкладке» не перехватываем
        if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;

        const url = swatch.getAttribute('href');
        if (!url) return;

        e.preventDefault();

        const body = qs('.ab-product__body');
        body?.classList.add('is-switching');

        try {
            swap(await ShopService.fetchProductPage(url));
            history.pushState({ variant: url }, '', url);
        } catch {
            window.location.href = url; // не вышло — обычный переход
            return;
        } finally {
            qs('.ab-product__body')?.classList.remove('is-switching');
        }
    });

    // кнопка «назад» в браузере должна возвращать прошлый цвет
    window.addEventListener('popstate', async (e) => {
        const state = e.state as { variant?: TUrl } | null;
        if (!state?.variant && !qs('.ab-product__colors')) return;

        try {
            swap(await ShopService.fetchProductPage(location.pathname));
        } catch {
            window.location.reload();
        }
    });
}
