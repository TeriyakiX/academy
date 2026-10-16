import { qsa } from '@/shared/utils/dom';

/*
 | Свой выпадающий список вместо системного.
 |
 | Системный `<select>` на телефоне открывается диалогом операционной
 | системы: чужие шрифты, чужие цвета, на части прошивок — огромный
 | список во весь экран. Здесь родной select остаётся в разметке
 | (и работает без скрипта), а поверх него рисуется своя кнопка
 | со списком в оформлении сайта.
 */

/** Закрываем все открытые списки, кроме указанного. */
function closeOthers(except?: HTMLElement): void {
    qsa<HTMLElement>('.ab-dd.is-open').forEach((dd) => {
        if (dd !== except) {
            dd.classList.remove('is-open');
            dd.querySelector('.ab-dd__btn')?.setAttribute('aria-expanded', 'false');
        }
    });
}

function build(select: HTMLSelectElement): void {
    if (select.dataset.dd === 'on') {
        return;
    }

    select.dataset.dd = 'on';

    const box = document.createElement('div');
    box.className = 'ab-dd';

    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'ab-dd__btn';
    button.setAttribute('aria-haspopup', 'listbox');
    button.setAttribute('aria-expanded', 'false');

    const label = document.createElement('span');
    label.className = 'ab-dd__value';
    label.textContent = select.selectedOptions[0]?.textContent?.trim() ?? '';
    button.append(label);

    const list = document.createElement('ul');
    list.className = 'ab-dd__list';
    list.setAttribute('role', 'listbox');

    Array.from(select.options).forEach((option, i) => {
        const item = document.createElement('li');
        const choice = document.createElement('button');

        choice.type = 'button';
        choice.className = 'ab-dd__option';
        choice.textContent = option.textContent?.trim() ?? '';
        choice.setAttribute('role', 'option');
        choice.setAttribute('aria-selected', String(option.selected));

        if (option.selected) {
            choice.classList.add('is-active');
        }

        choice.addEventListener('click', () => {
            select.selectedIndex = i;
            label.textContent = choice.textContent;
            box.classList.remove('is-open');
            button.setAttribute('aria-expanded', 'false');

            /* Отдаём событие родному select: переход по адресу
               остаётся на том же обработчике, что и без скрипта. */
            select.dispatchEvent(new Event('change', { bubbles: true }));
        });

        item.append(choice);
        list.append(item);
    });

    button.addEventListener('click', () => {
        const open = !box.classList.contains('is-open');

        closeOthers(box);
        box.classList.toggle('is-open', open);
        button.setAttribute('aria-expanded', String(open));
    });

    select.after(box);
    box.append(button, list);
    select.classList.add('ab-dd__native');
}

export function useSelect(): void {
    const selects = qsa<HTMLSelectElement>('select[data-filter-go]');

    if (!selects.length) {
        return;
    }

    selects.forEach(build);

    document.addEventListener('click', (event) => {
        if (!(event.target as HTMLElement)?.closest('.ab-dd')) {
            closeOthers();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeOthers();
        }
    });
}
