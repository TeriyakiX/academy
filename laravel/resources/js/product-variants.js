/**
 * Переключение цветового исполнения без перезагрузки страницы.
 *
 * Ссылки на другие цвета работают и без скрипта — это обычные ссылки
 * на страницы товаров. Скрипт лишь подменяет изменившиеся части и
 * правит адрес, чтобы переход выглядел мгновенным.
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

const cache = new Map();

async function load(url) {
    if (cache.has(url)) return cache.get(url);

    const html = await fetch(url, { headers: { 'X-Requested-With': 'fetch' } }).then((r) => r.text());
    const doc = new DOMParser().parseFromString(html, 'text/html');
    cache.set(url, doc);
    return doc;
}

function swap(doc) {
    PARTS.forEach((sel) => {
        const next = doc.querySelector(sel);
        const now = document.querySelector(sel);
        if (next && now) now.replaceWith(next.cloneNode(true));
    });

    // скрытые поля формы должны уйти с новым товаром
    doc.querySelectorAll('input[name="source"], input[name="page"]').forEach((input, i) => {
        const target = document.querySelectorAll('input[name="source"], input[name="page"]')[i];
        if (target) target.value = input.value;
    });

    document.title = doc.title;
}

function pick(el) {
    return el.closest('.ab-product__swatch');
}

document.addEventListener('click', async (e) => {
    const link = pick(e.target);
    if (!link || link.classList.contains('is-active')) return;
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;

    const url = link.getAttribute('href');
    if (!url) return;

    e.preventDefault();

    const body = document.querySelector('.ab-product__body');
    body?.classList.add('is-switching');

    try {
        const doc = await load(url);
        swap(doc);
        history.pushState({ variant: url }, '', url);
        window.scrollTo({ top: window.scrollY }); // остаёмся на месте
    } catch (err) {
        window.location.href = url; // не вышло — обычный переход
        return;
    } finally {
        document.querySelector('.ab-product__body')?.classList.remove('is-switching');
    }
});

// кнопка «назад» в браузере должна возвращать прошлый цвет
window.addEventListener('popstate', async (e) => {
    if (!e.state?.variant && !document.querySelector('.ab-product__colors')) return;
    try {
        swap(await load(location.pathname));
    } catch (err) {
        window.location.reload();
    }
});
