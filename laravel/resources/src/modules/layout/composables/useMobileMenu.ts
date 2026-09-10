import { isHidden, qs, qsa, toggleDisclosure } from '@/shared/utils/dom';

/**
 * Мобильное меню: бургер, затемнение, раскрывающиеся разделы.
 *
 * Разметку отдаёт Blade — здесь только поведение. Пока скрипт не
 * загрузился, меню просто скрыто, ссылки доступны из подвала.
 */
export function useMobileMenu(): void {
    const menu = qs('#site-mobile-menu');
    const burger = qs('.site-burger');

    if (!menu || !burger) return;

    const setOpen = (open: boolean) => {
        toggleDisclosure(burger, menu, open);
        document.body.classList.toggle('site-no-scroll', open);
    };

    const close = () => setOpen(false);

    burger.addEventListener('click', () => setOpen(isHidden(menu)));

    qs('.site-mobile__close', menu)?.addEventListener('click', close);

    // клик по затемнению — закрыть
    menu.addEventListener('click', (e) => {
        if (e.target === menu) close();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !isHidden(menu)) close();
    });

    // переход по ссылке закрывает меню
    qsa('a', menu).forEach((link) => link.addEventListener('click', close));

    // аккордеон разделов
    qsa('.site-mobile__toggle', menu).forEach((button) => {
        button.addEventListener('click', () => {
            const submenu = button.nextElementSibling as HTMLElement | null;
            const expanded = button.getAttribute('aria-expanded') === 'true';

            toggleDisclosure(button, submenu, !expanded);
        });
    });
}
