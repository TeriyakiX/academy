import useModalStore from '@/shared/store/useModalStore';
import { qs, qsa } from '@/shared/utils/dom';

/*
 | Связка конструктора курсов с формой заявки.
 |
 | Кнопка «Оставить заявку» в конструкторе сообщала о выборе событием,
 | но слушать его было некому: подобранный курс никуда не уходил.
 | Теперь состав попадает в скрытое поле формы — сервер это поле
 | уже принимает — и открывается обычная модалка заявки.
 */

const EVENT = 'constructor:submit';
const TARGET = 'consultation';

/** Кладёт значение в скрытое поле, создавая его при необходимости. */
function setHidden(form: HTMLFormElement, name: string, value: string): void {
    let field = qs<HTMLInputElement>(`input[name="${name}"]`, form);

    if (!field) {
        field = document.createElement('input');
        field.type = 'hidden';
        field.name = name;
        form.appendChild(field);
    }

    field.value = value;
}

/** «Латте-арт (6 900 ₽) + Домашний бариста (4 500 ₽) — итого 10 260 ₽, скидка 10%». */
function describe(selection: ICourseSelection): string {
    const list = selection.courses.map((course) => course.title).join(' + ');
    const money = new Intl.NumberFormat('ru-RU').format(selection.final);

    return selection.discount
        ? `${list} — итого ${money} ₽ со скидкой ${selection.discount}%`
        : `${list} — итого ${money} ₽`;
}

export function useConstructorBridge(): void {
    window.addEventListener(EVENT, (e) => {
        const selection = (e as CustomEvent<ICourseSelection>).detail;
        if (!selection?.courses?.length) return;

        qsa<HTMLFormElement>('form[action="/lead"]').forEach((form) => {
            setHidden(form, 'courses', describe(selection));
            setHidden(form, 'source', 'Конструктор курсов');
        });

        useModalStore().open(TARGET);
    });
}
