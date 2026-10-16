import { qs } from '@/shared/utils/dom';

/*
 | Подписи в окне заявки под место, откуда его позвали.
 |
 | Окно одно на весь сайт, и подсказка «Какой курс интересует» висела
 | даже на карточке кофемашины и на странице встречи. Теперь кнопка
 | может сказать, о чём речь: через data-modal-kind (общий случай)
 | или точечно — data-modal-title / text / hint / source.
 */

type TPreset = {
    title: string;
    text: string;
    hint: string;
    source: string;
};

/** Наборы подписей по разделам. */
const PRESETS: Record<string, TPreset> = {
    course: {
        title: 'Записаться на обучение',
        text: 'Перезвоним в течение 15 минут в рабочее время, ответим на вопросы и запишем в группу.',
        hint: 'Какой курс интересует',
        source: 'Модальное окно: обучение',
    },
    business: {
        title: 'Обсудить проект',
        text: 'Перезвоним в рабочее время, уточним задачу и предложим порядок работы.',
        hint: 'Коротко о вашей задаче: открытие, меню, обучение команды',
        source: 'Модальное окно: для бизнеса',
    },
    equipment: {
        title: 'Заявка на оборудование',
        text: 'Перезвоним в рабочее время, уточним наличие, сроки и условия доставки.',
        hint: 'Что интересует: модель, количество, сроки',
        source: 'Модальное окно: оборудование',
    },
    service: {
        title: 'Вызвать мастера',
        text: 'Перезвоним в рабочее время, уточним технику и подберём время выезда.',
        hint: 'Что за оборудование и что с ним происходит',
        source: 'Модальное окно: сервис',
    },
    event: {
        title: 'Записаться на встречу',
        text: 'Перезвоним в рабочее время, подтвердим место и ответим на вопросы.',
        hint: 'На какую встречу и сколько вас будет',
        source: 'Модальное окно: встречи',
    },
    certificate: {
        title: 'Подарочный сертификат',
        text: 'Перезвоним в рабочее время, поможем выбрать программу и оформим сертификат.',
        hint: 'Кому дарите и на какую сумму',
        source: 'Модальное окно: сертификат',
    },
    default: {
        title: 'Оставить заявку',
        text: 'Перезвоним в течение 15 минут в рабочее время и ответим на вопросы.',
        hint: 'Чем можем помочь',
        source: 'Модальное окно',
    },
};

/** Раздел по адресу страницы — если кнопка ничего о себе не сказала. */
function byPath(path: string): string {
    if (path.startsWith('/shop')) return 'equipment';
    if (path.startsWith('/busines')) return 'business';
    if (path.startsWith('/events')) return 'event';
    if (path.startsWith('/courses') || path.startsWith('/master-class')) return 'course';
    if (path.startsWith('/service')) return 'service';
    if (path.startsWith('/sertifikat') || path.startsWith('/constructor')) return 'certificate';

    return 'default';
}

/** Готовит окно под кнопку, которая его открыла. */
export function applyModalContext(modal: HTMLElement, button?: HTMLElement): void {
    const kind = button?.dataset.modalKind ?? byPath(window.location.pathname);
    const preset = PRESETS[kind] ?? PRESETS.default;

    const title = button?.dataset.modalTitle ?? preset.title;
    const text = button?.dataset.modalText ?? preset.text;
    const hint = button?.dataset.modalHint
        ?? (button?.dataset.modalItem ? 'Вопрос или удобное время для звонка' : preset.hint);

    /* Источник заявки менеджеру: что именно смотрел человек. */
    const source = button?.dataset.modalSource ?? preset.source;

    /* Выбранная позиция: курс, услуга, встреча или товар. */
    const item = button?.dataset.modalItem;
    const itemLabel = button?.dataset.modalItemLabel ?? 'Заявка по';
    const itemBox = qs<HTMLElement>('.ab-modal__item', modal);

    if (itemBox) {
        itemBox.hidden = !item;

        if (item) {
            const labelEl = qs('.ab-modal__item-label', itemBox);
            const nameEl = qs('.ab-modal__item-name', itemBox);

            if (labelEl) labelEl.textContent = itemLabel;
            if (nameEl) nameEl.textContent = item;
        }
    }

    const titleEl = qs('.ab-modal__title', modal);
    const textEl = qs('.ab-modal__text', modal);
    const hintEl = qs<HTMLTextAreaElement>('textarea', modal);
    const sourceEl = qs<HTMLInputElement>('input[name="source"]', modal);
    const pageEl = qs<HTMLInputElement>('input[name="page"]', modal);

    if (titleEl) titleEl.textContent = title;
    if (textEl) textEl.textContent = text;
    if (hintEl) hintEl.placeholder = hint;
    if (sourceEl) sourceEl.value = source;
    if (pageEl) pageEl.value = window.location.pathname;
}
