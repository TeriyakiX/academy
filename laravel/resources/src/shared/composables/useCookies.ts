import { claim, qs } from '@/shared/utils/dom';

/*
 | Уведомление об использовании cookie.
 |
 | Показываем один раз: нажал «Принимаю» — запомнили и больше не лезем.
 | Запоминаем в двух местах, потому что localStorage в приватном режиме
 | может быть недоступен, а cookie переживает очистку хранилища сайта
 | в части браузеров.
 */

const BANNER = '[data-cookies]';
const KEY = 'ab-cookies-accepted';

function accepted(): boolean {
    try {
        if (localStorage.getItem(KEY)) return true;
    } catch { /* приватный режим */ }

    return document.cookie.includes(`${KEY}=1`);
}

function remember(years: number): void {
    try {
        localStorage.setItem(KEY, String(Date.now()));
    } catch { /* приватный режим - останется только cookie */ }

    const until = new Date();
    until.setFullYear(until.getFullYear() + years);

    document.cookie = `${KEY}=1; expires=${until.toUTCString()}; path=/; SameSite=Lax`;
}

export function useCookies(): void {
    const banner = qs(BANNER);

    if (!banner || !claim(banner, 'cookiesReady') || accepted()) return;

    const years = Number(banner.dataset.cookiesYears ?? 1);

    banner.hidden = false;

    /* Класс ставим следующим кадром, иначе появление не проигрывается. */
    requestAnimationFrame(() => banner.classList.add('is-open'));

    qs('[data-cookies-accept]', banner)?.addEventListener('click', () => {
        remember(years);
        banner.classList.remove('is-open');

        setTimeout(() => { banner.hidden = true; }, 250);
    });
}
