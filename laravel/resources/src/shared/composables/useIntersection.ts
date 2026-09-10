/**
 * Наблюдение за появлением элементов на экране.
 *
 * Вынесено отдельно: этим пользуются и появление блоков, и ленивые карты.
 * Если браузер не умеет IntersectionObserver, обработчик вызывается сразу
 * для всех элементов — блок лучше показать без анимации, чем не показать.
 */
export function observeOnce(
    elements: Element[],
    onEnter: (el: Element) => void,
    options: IntersectionObserverInit = {},
): void {
    if (!elements.length) return;

    if (!('IntersectionObserver' in window)) {
        elements.forEach(onEnter);
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;

            onEnter(entry.target);
            observer.unobserve(entry.target);
        });
    }, options);

    elements.forEach((el) => observer.observe(el));
}
