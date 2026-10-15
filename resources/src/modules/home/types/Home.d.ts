/*
 | Блоки главной страницы.
 |
 | Данные приходят из config/home.php через data-props, поэтому имена
 | полей повторяют конфиг. Часть блоков помечена demo: там показаны
 | образцы, пока школа не прислала свои материалы.
 */

/** Направление обучения в первом экране. */
interface IDirection {
    title: string;
    /** Короткая подпись для переключателя. */
    short: string;
    text: string;
    photo: string;
    href: TUrl;
    /** Подпись ссылки: «Смотреть курсы». */
    link: string;
}

/** Цифра в блоке достижений. */
interface IStat {
    value: number;
    /** Приписка после числа: « лет», «+». */
    suffix?: string;
    label: string;
    note?: string;
    /** Готовая разметка значка. */
    icon?: string;
}

interface ITeacher {
    name: string;
    role: string;
    /** Стаж — школа пока прислала не для всех. */
    experience?: string;
    photo: string;
    skills: string[];
    demo?: boolean;
}

/** Услуга для бизнеса. */

interface IFaqItem {
    q: string;
    a: string;
}

interface IReview {
    name: string;
    date: string;
    rating: number;
    text: string;
    /** Ссылка на отзыв в Яндекс Картах. */
    href?: TUrl;
}

/** Занятие в расписании. */
interface IEvent {
    day: string;
    month: string;
    weekday: string;
    time: string;
    title: string;
    /** Адрес страницы встречи: /events/{slug}.html. */
    slug?: string;
    /** Дата по ISO: «2026-10-18». По ней считаем прошедшие и «через N дней». */
    date?: string;
    /** «до 10 человек» — старый формат, пока встречи ведём в файле. */
    seats?: string;
    /** Снимок на карточке. */
    photo?: string;
    /** Всего мест и сколько осталось: «6 из 8». */
    seats_total?: number;
    seats_left?: number;
    price: number;
    text: string;
    /** Раздел встречи: «Каппинг», «Мастер-класс». */
    section?: string;
}

/** Расписание по месяцам: «Май» → занятия. */
type TEventMonths = Record<string, IEvent[]>;
