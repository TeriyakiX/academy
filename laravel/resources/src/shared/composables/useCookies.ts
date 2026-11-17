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

/** Событие о принятом согласии. */
export const COOKIES_DONE = 'ab:cookies-accepted';

/** Согласие уже дано: промо-плашка ждёт этого, чтобы не лезть поверх. */
export function cookiesAccepted(): boolean {
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

    if (!banner || !claim(banner, 'cookiesReady') || cookiesAccepted()) return;

    const years = Number(banner.dataset.cookiesYears ?? 1);

    banner.hidden = false;

    /*
     | Плашка закреплена внизу экрана и накрывает собой низ страницы.
     | В подвале там как раз юридические ссылки - они переставали
     | нажиматься, потому что курсор попадал в плашку. Пока плашка
     | висит, отодвигаем низ страницы на её высоту.
     */
    const otstup = (): void => {
        document.documentElement.style.setProperty(
            '--ab-cookies-h', `${Math.ceil(banner.getBoundingClientRect().height)}px`,
        );
    };

    /* Класс ставим следующим кадром, иначе появление не проигрывается. */
    requestAnimationFrame(() => {
        banner.classList.add('is-open');
        otstup();
    });

    /* Текст переносится по-разному - на узком экране плашка выше. */
    window.addEventListener('resize', otstup, { passive: true });

    qs('[data-cookies-accept]', banner)?.addEventListener('click', () => {
        remember(years);
        banner.classList.remove('is-open');

        /* Сообщаем остальным: теперь показывать своё окно можно. */
        document.dispatchEvent(new CustomEvent(COOKIES_DONE));

        window.removeEventListener('resize', otstup);
        document.documentElement.style.removeProperty('--ab-cookies-h');

        setTimeout(() => { banner.hidden = true; }, 250);
    });
}
