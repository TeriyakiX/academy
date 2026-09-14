import { claim, qs, qsa } from '@/shared/utils/dom';

/*
 | Переключатель панелей: ряд кнопок и панели под ними.
 |
 | Blade отдаёт все панели сразу, лишние помечены hidden. Скрипт только
 | переставляет этот признак, поэтому без него на странице видна первая
 | панель, а не пустое место.
 */

const PICKER = '[data-picker]';

function wire(picker: HTMLElement): void {
    if (!claim(picker, 'pickerReady')) return;

    const tabs = qsa<HTMLButtonElement>('[data-picker-tab]', picker);
    const panels = qsa('[data-picker-panel]', picker);

    const show = (key: string): void => {
        tabs.forEach((tab) => {
            const active = tab.dataset.pickerTab === key;

            tab.classList.toggle('is-active', active);
            tab.setAttribute('aria-selected', String(active));
        });

        panels.forEach((panel) => {
            panel.hidden = panel.dataset.pickerPanel !== key;
        });
    };

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            const key = tab.dataset.pickerTab;
            if (key) show(key);
        });
    });

    /* Стрелками ходить по ряду привычнее, чем табом через все кнопки. */
    picker.addEventListener('keydown', (e) => {
        if (e.key !== 'ArrowLeft' && e.key !== 'ArrowRight') return;

        const current = tabs.indexOf(qs<HTMLButtonElement>('[data-picker-tab].is-active', picker)!);
        if (current < 0) return;

        const shift = e.key === 'ArrowRight' ? 1 : -1;
        const target = tabs[(current + shift + tabs.length) % tabs.length];

        target.click();
        target.focus();
    });
}

export function usePicker(): void {
    qsa(PICKER).forEach(wire);
}
