import { MEDIA_MOBILE } from '@/shared/constants/breakpoints';
import { claim, qsa } from '@/shared/utils/dom';
import { onNextFrame } from '@/shared/utils';

/*
 | Точки-индикаторы для лент, которые на телефоне листаются вбок.
 |
 | Без них непонятно, что карточки можно листать: видна одна карточка
 | и никакого намёка на остальные. Логика общая для всех блоков —
 | добавлять разметку в каждый шаблон не нужно.
 */

const TRACKS = [
    '.ab-tabs__grid',
    '.ab-rv__list',
    '.ab-schedule__list',
    '.ab-dirs__cols',
    '.ab-ev__list',
    '.ab-steps__list',
    '.ab-reasons__list',
    '.ab-bus__grid',        // услуги для бизнеса
    '.ab-cprog__grid',      // программа курса
    '.ctor__list',          // конструктор курсов
    '.ab-rv__swipe',        // отзывы
    '.ab-teachers__swipe',  // преподаватели
];

/*
 | Ряды-переключатели — не карусель с карточками, а полоса кнопок.
 | Точки им не нужны, нужен понятный признак, что полосу можно тянуть:
 | тень у того края, за которым ещё есть содержимое.
 */
const ROWS = ['.ab-teachers__thumbs'];

/** Индекс карточки, которая сейчас в центре экрана. */
function activeIndex(track: HTMLElement): number {
    const middle = track.scrollLeft + track.clientWidth / 2;

    let best = 0;
    let bestDistance = Infinity;

    Array.from(track.children).forEach((card, i) => {
        const element = card as HTMLElement;
        const distance = Math.abs(element.offsetLeft + element.offsetWidth / 2 - middle);

        if (distance < bestDistance) {
            bestDistance = distance;
            best = i;
        }
    });

    return best;
}

function buildDots(track: HTMLElement): void {
    // скрытые списки не размечаем: у блока может быть и лента для телефона,
    // и обычный список для широкого экрана
    if (track.offsetParent === null) return;
    if (track.children.length < 2) return;
    if (!claim(track, 'swipeReady')) return;

    const dots = document.createElement('div');
    dots.className = 'ab-swipe-dots';
    dots.setAttribute('aria-hidden', 'true');

    Array.from(track.children).forEach((_, i) => {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'ab-swipe-dots__dot';
        dot.addEventListener('click', () => {
            const card = track.children[i] as HTMLElement;
            track.scrollTo({ left: card.offsetLeft, behavior: 'smooth' });
        });

        dots.appendChild(dot);
    });

    track.after(dots);

    const sync = () => {
        const active = activeIndex(track);
        Array.from(dots.children).forEach((dot, i) => dot.classList.toggle('is-active', i === active));
    };

    track.addEventListener('scroll', onNextFrame(sync), { passive: true });
    sync();
}

function markRow(row: HTMLElement): void {
    const update = () => {
        const max = row.scrollWidth - row.clientWidth;
        row.classList.toggle('has-left', row.scrollLeft > 4);
        row.classList.toggle('has-right', row.scrollLeft < max - 4);
    };

    if (claim(row, 'rowReady')) {
        row.classList.add('ab-swipe-row');
        row.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update);
    }

    update();
}

function scan(): void {
    if (!window.matchMedia(MEDIA_MOBILE).matches) return;

    qsa(TRACKS.join(',')).forEach(buildDots);
    qsa(ROWS.join(',')).forEach(markRow);
}

export function useSwipeDots(): void {
    scan();

    /*
     | Часть лент рисует Vue уже после загрузки скрипта (курсы, отзывы,
     | мероприятия), а вкладки курсов перерисовывают содержимое при
     | переключении. Поэтому следим за разметкой и достраиваем точки
     | по мере появления.
     */
    let pending: ReturnType<typeof setTimeout>;

    new MutationObserver(() => {
        clearTimeout(pending);
        pending = setTimeout(scan, 80);
    }).observe(document.body, { childList: true, subtree: true });

    window.matchMedia(MEDIA_MOBILE).addEventListener('change', scan);
}
