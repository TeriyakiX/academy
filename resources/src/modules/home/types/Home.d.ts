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
interface IBusinessService {
    title: string;
    text: string;
    points: string[];
    price: number;
    duration: string;
    image?: string;
}

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
    /** «до 10 человек». */
    seats: string;
    price: number;
    text: string;
}

/** Расписание по месяцам: «Май» → занятия. */
type TEventMonths = Record<string, IEvent[]>;
