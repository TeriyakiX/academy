/**
 * Точки-индикаторы для блоков, которые на телефоне листаются вбок.
 *
 * Без них непонятно, что карточки можно листать: видна одна карточка
 * и никакого намёка на остальные. Логика общая для всех блоков —
 * добавлять разметку в каждый шаблон не нужно.
 */

const SELECTORS = [
    '.ab-tabs__grid',
    '.ab-rv__list',
    '.ab-schedule__list',
    '.ab-dirs__cols',
    '.ab-ev__list',
    '.ab-steps__list',
    '.ab-reasons__list',
    '.ab-bus__grid',       // услуги для бизнеса
    '.ab-cprog__grid',     // программа курса
    '.ctor__list',         // конструктор курсов
];

const MOBILE = '(max-width: 760px)';

/** Индекс карточки, которая сейчас в центре экрана. */
function activeIndex(track) {
    const middle = track.scrollLeft + track.clientWidth / 2;
    let best = 0;
    let bestDist = Infinity;

    [...track.children].forEach((card, i) => {
        const center = card.offsetLeft + card.offsetWidth / 2;
        const dist = Math.abs(center - middle);
        if (dist < bestDist) {
            bestDist = dist;
            best = i;
        }
    });

    return best;
}

function build(track) {
    if (track.dataset.swipeReady) return;

    const count = track.children.length;
    if (count < 2) return;

    const dots = document.createElement('div');
    dots.className = 'ab-swipe-dots';
    dots.setAttribute('aria-hidden', 'true');

    for (let i = 0; i < count; i++) {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'ab-swipe-dots__dot';
        dot.addEventListener('click', () => {
            track.scrollTo({ left: track.children[i].offsetLeft, behavior: 'smooth' });
        });
        dots.appendChild(dot);
    }

    track.after(dots);
    track.dataset.swipeReady = '1';

    const sync = () => {
        const active = activeIndex(track);
        [...dots.children].forEach((d, i) => d.classList.toggle('is-active', i === active));
    };

    track.addEventListener('scroll', () => {
        cancelAnimationFrame(track._swipeRaf);
        track._swipeRaf = requestAnimationFrame(sync);
    }, { passive: true });

    sync();
}

function init() {
    if (!window.matchMedia(MOBILE).matches) return;
    document.querySelectorAll(SELECTORS.join(',')).forEach(build);
}

init();

/*
 | Часть списков рисует Vue уже после загрузки скрипта (курсы, отзывы,
 | мероприятия), а вкладки курсов перерисовывают содержимое при переключении.
 | Поэтому следим за изменениями разметки и достраиваем точки по мере появления.
 */
let pending;
const observer = new MutationObserver(() => {
    clearTimeout(pending);
    pending = setTimeout(() => { init(); initRows(); }, 80);
});
observer.observe(document.body, { childList: true, subtree: true });

window.matchMedia(MOBILE).addEventListener('change', init);

/*
 | Ряды-переключатели (вкладки курсов, категории каталога, лица тренеров)
 | не карусель с карточками, а полоса кнопок. Точки им не нужны, нужен
 | понятный признак, что полосу можно тянуть — тень у того края,
 | за которым ещё есть содержимое.
 */
/* Вкладки и категории на телефоне показываются сеткой — крутить нечего.
   Тень нужна только ленте с лицами тренеров. */
const ROWS = ['.ab-teachers__thumbs'];

function markRow(row) {
    const update = () => {
        const max = row.scrollWidth - row.clientWidth;
        row.classList.toggle('has-left', row.scrollLeft > 4);
        row.classList.toggle('has-right', row.scrollLeft < max - 4);
    };

    if (!row.dataset.rowReady) {
        row.dataset.rowReady = '1';
        row.classList.add('ab-swipe-row');
        row.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update);
    }

    update();
}

function initRows() {
    if (!window.matchMedia(MOBILE).matches) return;
    document.querySelectorAll(ROWS.join(',')).forEach(markRow);
}

initRows();
window.matchMedia(MOBILE).addEventListener('change', initRows);
document.addEventListener('DOMContentLoaded', initRows);
