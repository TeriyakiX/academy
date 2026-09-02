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

    // Раскрытие идёт через inline max-height — этого требует вёрстка сайта,
    // одного класса .active недостаточно.
    const close = (item) => {
        const body = item.querySelector('.faq__accordion-body');
        const icon = item.querySelector('.faq__accordion-icon svg');
        if (body) {
            body.classList.remove('active');
            body.style.maxHeight = '0';
        }
        if (icon) icon.style.transform = 'rotate(0deg)';
    };

    items.forEach((item) => {
        const head = item.querySelector('.faq__accordion-top');
        const body = item.querySelector('.faq__accordion-body');
        if (!head || !body) return;

        head.addEventListener('click', () => {
            const isOpen = body.classList.contains('active');
            items.forEach(close);

            if (!isOpen) {
                body.classList.add('active');

                body.style.maxHeight = body.scrollHeight + 'px';

                const icon = item.querySelector('.faq__accordion-icon svg');
                if (icon) icon.style.transform = 'rotate(-46deg)';
            }
        });
    });
}

/** Фильтр месяцев в блоке «Расписание мероприятий». */
function initEvents() {
    const buttons = document.querySelectorAll('.events__filters-button');
    const panels = document.querySelectorAll('.events__content');
    if (!buttons.length || !panels.length) return;

    const activate = (index) => {
        buttons.forEach((b) => b.classList.remove('events__filters-button-active'));
        panels.forEach((p) => p.classList.remove('active'));
        buttons[index]?.classList.add('events__filters-button-active');
        panels[index]?.classList.add('active');
    };

    buttons.forEach((btn, i) => btn.addEventListener('click', () => activate(i)));
    activate(0);
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
initEvents();
initHeroSliders();
initModals();
initForms();
