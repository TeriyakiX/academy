import ShopService from '@/modules/shop/services/ShopService';
import { qs, qsa } from '@/shared/utils/dom';

/*
 | Кнопка «Показать ещё» в каталоге.
 |
 | Раньше она была обычной ссылкой: страница перезагружалась и человек
 | оказывался в начале списка — чтобы дойти до новых позиций, приходилось
 | заново пролистывать те двадцать четыре, что он уже посмотрел.
 |
 | Теперь следующая порция подставляется в конец списка, а страница
 | остаётся на месте. Ссылка при этом настоящая: без скрипта она
 | по-прежнему работает и ведёт на первую из добавленных позиций.
 */

const GRID = '.ab-shop__grid';
const WRAP = '[data-shop-more]';

/** Добавляет карточки из загруженного документа в конец списка. */
function append(next: Document): number {
    const grid = qs(GRID);
    const freshGrid = qs(GRID, next);

    if (!grid || !freshGrid) return 0;

    const have = grid.children.length;
    const cards = Array.from(freshGrid.children).slice(have);

    cards.forEach((card) => grid.appendChild(card.cloneNode(true)));

    return cards.length;
}

/** Обновляет счётчик и кнопку — или убирает их, когда показаны все позиции. */
function refresh(next: Document): void {
    const wrap = qs(WRAP);
    const freshWrap = qs(WRAP, next);

    if (!wrap) return;

    // в новом документе блока нет — значит, дошли до конца каталога
    if (!freshWrap) {
        wrap.remove();
        return;
    }

    wrap.replaceWith(freshWrap.cloneNode(true));
}

export function useShowMore(): void {
    document.addEventListener('click', async (e) => {
        const target = e.target as HTMLElement | null;
        const link = target?.closest<HTMLAnchorElement>(`${WRAP} a`);

        if (!link) return;
        // системные жесты «открыть в новой вкладке» не перехватываем
        if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;

        const url = link.getAttribute('href');
        if (!url) return;

        e.preventDefault();
        link.classList.add('is-loading');

        try {
            const next = await ShopService.fetchPage(url);

            const added = append(next);
            if (!added) throw new Error('новых позиций в ответе нет');

            refresh(next);

            /* Адрес обновляем без якоря: страница никуда не прыгала,
               и при перезагрузке человек увидит тот же набор позиций. */
            history.replaceState(null, '', url.split('#')[0]);

            // первую из добавленных карточек подсвечиваем для глаза
            const grid = qs(GRID);
            const first = grid ? (qsa(':scope > li', grid)[grid.children.length - added] ?? null) : null;
            first?.classList.add('is-new');
        } catch {
            window.location.href = url; // не вышло — обычный переход
        } finally {
            link.classList.remove('is-loading');
        }
    });
}
