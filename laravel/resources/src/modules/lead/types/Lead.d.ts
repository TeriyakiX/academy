/*
 | Заявка с сайта. Поля повторяют проверку в маршруте POST /lead.
 */

interface ILead {
    name: string;
    phone: string;
    comment?: string;
    /** Откуда пришла заявка: «Модальное окно», «Страница товара» и т.д. */
    source?: string;
    /** Адрес страницы, с которой отправили. */
    page?: string;
    /** Выбранные курсы — из конструктора. */
    courses?: string;
}

/** Результат проверки формы перед отправкой. */
interface ILeadValidation {
    valid: boolean;
    /** Поле → текст ошибки. */
    errors: Partial<Record<keyof ILead, string>>;
}
