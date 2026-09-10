/**
 * Возвращает форму русского слова по числу — без самого числа.
 *
 * @example pluralize(7, ['год', 'года', 'лет']) // 'лет'
 */
export function pluralize(count: number, forms: TPluralForms): string {
    const [one, few, many] = forms;
    const mod10 = count % 10;
    const mod100 = count % 100;

    if (mod100 >= 11 && mod100 <= 14) return many;
    if (mod10 === 1) return one;
    if (mod10 >= 2 && mod10 <= 4) return few;

    return many;
}

/** Разбивает число на разряды: 74900 → «74 900». */
export function formatNumber(value: number | string): string {
    return String(value).replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
}

/** Цена с рублём: 74900 → «74 900 ₽». */
export function formatPrice(value: number | string | null | undefined, fallback = 'по запросу'): string {
    if (value === null || value === undefined || value === '') return fallback;

    const number = typeof value === 'string' ? parseFloat(value) : value;
    if (Number.isNaN(number)) return fallback;

    return `${formatNumber(Math.round(number))} ₽`;
}

/** Телефон к виду +7 (925) 152-28-66. */
export function formatPhone(phone: string | number): string {
    const digits = String(phone).replace(/\D/g, '');
    const match = digits.replace(/^8/, '7').match(/^7(\d{3})(\d{3})(\d{2})(\d{2})$/);

    return match ? `+7 (${match[1]}) ${match[2]}-${match[3]}-${match[4]}` : String(phone);
}

/** Инициалы для аватарки: «Алексей Фёдоров» → «АФ». */
export function initials(name: string): string {
    return name
        .split(' ')
        .slice(0, 2)
        .map((word) => word[0] ?? '')
        .join('')
        .toUpperCase();
}

/** Обрезает текст по границе слова и добавляет многоточие. */
export function truncate(text: string, limit: number): string {
    if (text.length <= limit) return text;

    return `${text.slice(0, limit).trimEnd()}…`;
}

/** Откладывает вызов, пока события не прекратятся. */
export function debounce<A extends unknown[]>(fn: (...args: A) => void, ms = 120) {
    let timer: ReturnType<typeof setTimeout>;

    return (...args: A): void => {
        clearTimeout(timer);
        timer = setTimeout(() => fn(...args), ms);
    };
}

/** Пропускает вызовы чаще одного кадра — для обработчиков прокрутки. */
export function onNextFrame(fn: () => void) {
    let frame = 0;

    return (): void => {
        cancelAnimationFrame(frame);
        frame = requestAnimationFrame(fn);
    };
}
