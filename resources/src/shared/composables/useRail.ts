import { claim, qs, qsa, toggleDisclosure } from '@/shared/utils/dom';

/*
 | Горизонтальная лента со стрелками.
 |
 | Разметка приходит из Blade и работает сама по себе: лента прокручивается
 | пальцем и колесом. Скрипт добавляет две вещи — стрелки для мыши и
 | сворачивание по кнопке. Поэтому лента в HTML открыта: если скрипт не
 | загрузился, человек всё равно видит содержимое, а не мёртвую кнопку.
 */

const RAIL = '[data-rail]';
const STEP = 0.85; // доля видимой ширины за одно нажатие

function wire(rail: HTMLElement): void {
    if (!claim(rail, 'railReady')) return;

    const track = qs('[data-rail-track]', rail);
    if (!track) return;

    const prev = qs<HTMLButtonElement>('[data-rail-prev]', rail);
    const next = qs<HTMLButtonElement>('[data-rail-next]', rail);

    const sync = (): void => {
        const max = track.scrollWidth - track.clientWidth;

        if (prev) prev.disabled = track.scrollLeft <= 4;
        if (next) next.disabled = track.scrollLeft >= max - 4;

        /* Нечего листать — стрелки только мешают. */
        rail.classList.toggle('has-nav', max > 8);
    };

    const slide = (direction: 1 | -1): void => {
        track.scrollBy({ left: direction * track.clientWidth * STEP, behavior: 'smooth' });
    };

    prev?.addEventListener('click', () => slide(-1));
    next?.addEventListener('click', () => slide(1));

    track.addEventListener('scroll', sync, { passive: true });
    window.addEventListener('resize', sync);

    sync();

    /* Кнопка-переключатель может лежать где угодно на странице —
       связь задаётся через aria-controls. */
    const toggle = qs(`[data-rail-toggle][aria-controls="${rail.id}"]`);
    if (!toggle || !rail.id) return;

    toggleDisclosure(toggle, rail, false);

    toggle.addEventListener('click', () => {
        const open = toggle.getAttribute('aria-expanded') !== 'true';

        toggleDisclosure(toggle, rail, open);

        if (open) {
            sync();
            rail.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    });
}

export function useRail(): void {
    qsa(RAIL).forEach(wire);
}
