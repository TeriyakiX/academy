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

/**
 * Модальное окно заявки.
 * Кнопки с data-modal-path открывают блок с соответствующим data-modal-target.
 * Раньше это делал бандл страницы; после перехода на единый шаблон
 * логика живёт здесь и работает на всех страницах.
 */
(() => {
    const modals = document.querySelectorAll('[data-modal-target]');
    if (!modals.length) return;

    const open = (modal) => {
        modal.hidden = false;
        document.body.classList.add('site-no-scroll');
        modal.querySelector('input:not([type=hidden])')?.focus();
    };

    const closeAll = () => {
        modals.forEach((m) => (m.hidden = true));
        document.body.classList.remove('site-no-scroll');
    };

    document.querySelectorAll('[data-modal-path]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(`[data-modal-target="${btn.dataset.modalPath}"]`);
            // если конкретной модалки нет — открываем общую форму заявки
            open(target || document.querySelector('[data-modal-target="consultation"]'));
        });
    });

    modals.forEach((modal) => {
        modal.querySelectorAll('[data-modal-close]').forEach((el) =>
            el.addEventListener('click', closeAll)
        );
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeAll();
    });
})();

/**
 * Ленивые карты.
 * Iframe хранит адрес в data-src и подгружается, когда блок подъезжает к экрану.
 * Раньше это работало только на главной (логика жила в homeInit.js), из-за чего
 * на странице контактов карта оставалась пустой. Теперь — на всех страницах.
 */
(() => {
    const maps = document.querySelectorAll('.lazy-map[data-src]');
    if (!maps.length) return;

    const load = (el) => {
        if (el.dataset.src && el.src !== el.dataset.src) el.src = el.dataset.src;
    };

    if (!('IntersectionObserver' in window)) {
        maps.forEach(load);
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                load(entry.target);
                observer.unobserve(entry.target);
            });
        },
        { rootMargin: '0px 0px 300px 0px' }
    );

    maps.forEach((el) => observer.observe(el));
})();
