/**
 * Инициализация главной страницы.
 *
 * Раньше это делал сборочный бандл /assets/main.js. После замены шапки,
 * подвала и части секций он падал на отсутствующих элементах (старый бургер,
 * слайдеры программ/команды/партнёров) и из-за ошибки не доходил до FAQ и карты.
 * Здесь инициализируется только то, что реально осталось на странице.
 */

/** Аккордеон «Часто задаваемые вопросы». */
function initFaq() {
    const items = document.querySelectorAll('.faq__accordion-item');
    if (!items.length) return;

    const close = (item) => {
        item.querySelector('.faq__accordion-body')?.classList.remove('active');
        item.querySelector('.faq__accordion-icon svg')?.classList.remove('active');
        item.querySelector('.faq__accordion-top')?.classList.remove('active');
    };

    items.forEach((item) => {
        const head = item.querySelector('.faq__accordion-top');
        const body = item.querySelector('.faq__accordion-body');
        if (!head || !body) return;

        head.addEventListener('click', () => {
            const isOpen = body.classList.contains('active');
            items.forEach((other) => other !== item && close(other));

            body.classList.toggle('active', !isOpen);
            item.querySelector('.faq__accordion-icon svg')?.classList.toggle('active', !isOpen);
            head.classList.toggle('active', !isOpen);
        });
    });
}

/** Аккордеон колонок подвала на мобильных (старая разметка на внутренних страницах). */
function initFooterAccordion() {
    document.querySelectorAll('.footer__col-head').forEach((head) => {
        head.addEventListener('click', function () {
            this.classList.toggle('active');
            this.nextElementSibling?.classList.toggle('active');
        });
    });
}

/** Слайдеры первого экрана. */
async function initHeroSliders() {
    const main = document.querySelector('.hero-courses-slider');
    const marquee = document.querySelector('.hero-courses-slider-auto-scroll');
    if (!main && !marquee) return;

    const { S: Splide } = await import('/assets/splide.min.js');

    if (main) {
        new Splide(main, {
            perPage: 1, perMove: 1, gap: '15px',
            autoplay: true, interval: 2500, type: 'loop',
            pagination: false, arrows: false,
            breakpoints: { 600: { pagination: true } },
        }).mount();
    }

    if (marquee) {
        new Splide(marquee, {
            type: 'loop', drag: 'free', focus: 'center',
            perPage: 5, gap: '20px', arrows: false, pagination: false,
            breakpoints: { 1400: { perPage: 4 }, 1100: { perPage: 3 }, 768: { perPage: 2 }, 600: { perPage: 1 } },
        }).mount();
    }
}

/**
 * Карты в блоке контактов — ленивые iframe: настоящий src подставляется,
 * когда блок подъезжает к экрану.
 */
function initLazyMaps() {
    const maps = document.querySelectorAll('.lazy-map');
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
}

/** Модальные окна: кнопки [data-modal-path] открывают [data-modal-target]. */
function initModals() {
    const triggers = document.querySelectorAll('[data-modal-path]');
    const modals = document.querySelectorAll('.modal');
    if (!triggers.length || !modals.length) return;

    const closeAll = () => {
        document.querySelectorAll('.modal.is-open').forEach((m) => m.classList.remove('is-open'));
        document.body.classList.remove('body-no-scroll');
    };

    const open = (modal) => {
        closeAll();
        modal.classList.add('is-open');
        document.body.classList.add('body-no-scroll');
    };

    triggers.forEach((trigger) => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(`[data-modal-target="${trigger.dataset.modalPath}"]`);
            if (target) open(target);
        });
    });

    modals.forEach((modal) => {
        modal.querySelector('.modal__overlay')?.addEventListener('click', closeAll);
        modal.querySelectorAll('[data-modal-close], .modal__close').forEach((btn) =>
            btn.addEventListener('click', closeAll)
        );
    });

    document.addEventListener('keydown', (e) => e.key === 'Escape' && closeAll());
}

/** Формы обратной связи (старая разметка модалок и форм). */
async function initForms() {
    try {
        const mod = await import('/assets/send-form-telegram.js');
        Object.values(mod).forEach((fn) => typeof fn === 'function' && fn());
    } catch (e) {
        console.warn('Формы не инициализированы:', e);
    }
}

initFaq();
initFooterAccordion();
initHeroSliders();
initLazyMaps();
initModals();
initForms();
