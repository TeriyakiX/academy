/**
 * Поведение единой шапки: мобильное меню и раскрывающиеся разделы.
 * Подключается на всех страницах через app.js.
 */
const menu = document.getElementById('site-mobile-menu');
const burger = document.querySelector('.site-burger');

if (menu && burger) {
    const close = () => {
        menu.hidden = true;
        burger.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('site-no-scroll');
    };

    const open = () => {
        menu.hidden = false;
        burger.setAttribute('aria-expanded', 'true');
        document.body.classList.add('site-no-scroll');
    };

    burger.addEventListener('click', () => (menu.hidden ? open() : close()));

    menu.querySelector('.site-mobile__close')?.addEventListener('click', close);

    // клик по затемнению — закрыть
    menu.addEventListener('click', (e) => {
        if (e.target === menu) close();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !menu.hidden) close();
    });

    // переход по ссылке закрывает меню
    menu.querySelectorAll('a').forEach((a) => a.addEventListener('click', close));

    // аккордеон разделов
    menu.querySelectorAll('.site-mobile__toggle').forEach((btn) => {
        btn.addEventListener('click', () => {
            const sub = btn.nextElementSibling;
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', String(!expanded));
            if (sub) sub.hidden = expanded;
        });
    });
}
