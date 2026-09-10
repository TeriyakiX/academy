/*
 | Курсы и конструктор.
 |
 | Данные приходят из config/courses.php через data-props, поэтому
 | имена полей повторяют конфиг один в один.
 */

type TCourseId = string;

/** Направление обучения: «Курсы бариста», «Мастер-классы», «Барное дело». */
type TSchool = string;

interface ICourse {
    id: TCourseId;
    title: string;
    desc: string;
    price: number;
    /** Цена до скидки — показывается зачёркнутой. */
    old?: number;
    duration?: string;
    format?: string;
    /** Когда идут занятия: «по выходным», «будни, вечер». */
    schedule?: string;
    url?: TUrl;
}

/** Курсы, разложенные по направлениям. */
type TSchools = Record<TSchool, ICourse[]>;

/** Пороги скидки: сколько курсов выбрано → сколько процентов. */
type TDiscountTiers = Record<string, number>;

/** Итог подбора: что выбрано и во сколько это обходится. */
interface ICourseSelection {
    courses: ICourse[];
    /** Направлений задействовано. */
    schools: number;
    total: number;
    discount: number;
    final: number;
}

/** Подсказка «добавьте ещё N — скидка вырастет до P%». */
interface INextDiscount {
    need: number;
    percent: number;
}

/** Блок программы курса: тема занятия и её содержание. */
interface IProgramBlock {
    title: string;
    topics: string[];
    duration?: string;
}
