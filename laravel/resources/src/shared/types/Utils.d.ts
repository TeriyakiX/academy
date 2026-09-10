/*
 | Общие типы. Файл без импортов и экспортов — значит, всё,
 | что здесь объявлено, доступно во всём проекте без импорта.
 */

/** Готовый адрес страницы, например «/shop.html?brand=carimali». */
type TUrl = string;

/** Человекочитаемая цена: «74 900 ₽». */
type TPrice = string;

/** Ключевой брейкпоинт: с него начинается «телефонная» вёрстка. */
type TViewport = 'mobile' | 'tablet' | 'desktop';

/** Формы русского слова для склонения: [1, 2–4, 5+]. */
type TPluralForms = [string, string, string];

interface IBreakpoints {
    isMobile: boolean;
    isTablet: boolean;
    isDesktop: boolean;
    width: number;
}

/** Ссылка в меню, подвале или хлебных крошках. */
interface ILink {
    title: string;
    href: TUrl;
}
