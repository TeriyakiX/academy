import { claim, qs } from '@/shared/utils/dom';

/*
 | Всплывающее предложение в углу экрана.
 |
 | Правила простые и жёсткие, потому что такое окно легко превращается
 | в раздражитель:
 |  - не показываем сразу: человек только пришёл и ещё ничего не увидел;
 |  - показываем либо после паузы, либо когда он долистал до середины —
 |    то есть заинтересовался;
 |  - закрыл — не возвращаемся неделю;
 |  - если он уже пишет в форме, не лезем.
 */

const PROMO = '[data-promo]';
const KEY = 'ab-promo-closed';
const WEEK = 7 * 24 * 60 * 60 * 1000;

function closedRecently(): boolean {
    try {
        const at = Number(localStorage.getItem(KEY));

        return Boolean(at) && Date.now() - at < WEEK;
    } catch {
        return false;
    }
}

function remember(): void {
    try {
        localStorage.setItem(KEY, String(Date.now()));
    } catch { /* приватный режим — просто не запомним */ }
}

export function usePromo(): void {
    const promo = qs(PROMO);
    if (!promo || !claim(promo, 'promoReady') || closedRecently()) return;

    const delay = Number(promo.dataset.promoDelay ?? 14) * 1000;
    const depth = Number(promo.dataset.promoScroll ?? 0.3);

    let shown = false;

    const show = (): void => {
        if (shown) return;

        /* Человек заполняет форму — не мешаем. */
        const active = document.activeElement;
        if (active instanceof HTMLInputElement || active instanceof HTMLTextAreaElement) return;

        shown = true;
        promo.hidden = false;

        /* Класс ставим следующим кадром, иначе переход не проигрывается. */
        requestAnimationFrame(() => promo.classList.add('is-open'));

        window.removeEventListener('scroll', onScroll);
        clearTimeout(timer);
    };

    const onScroll = (): void => {
        const max = document.documentElement.scrollHeight - window.innerHeight;
        if (max > 0 && window.scrollY / max >= depth) show();
    };

    const timer = setTimeout(show, delay);
    window.addEventListener('scroll', onScroll, { passive: true });

    qs('[data-promo-close]', promo)?.addEventListener('click', () => {
        promo.classList.remove('is-open');
        remember();

        /* Прячем после перехода, чтобы окно не исчезало рывком. */
        setTimeout(() => { promo.hidden = true; }, 250);
    });
}
