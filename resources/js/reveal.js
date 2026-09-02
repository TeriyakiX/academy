/**
 * Появление блоков при прокрутке.
 * Элементу с классом .ab-reveal добавляется .is-visible, когда он входит в экран.
 * CSS-анимации внутри блоков привязаны к .is-visible, поэтому запускаются в нужный момент.
 */
const targets = document.querySelectorAll('.ab-reveal');

if (targets.length) {
    // Без поддержки IntersectionObserver просто показываем всё сразу.
    if (!('IntersectionObserver' in window)) {
        targets.forEach((el) => el.classList.add('is-visible'));
    } else {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target); // анимация проигрывается один раз
                });
            },
            { rootMargin: '0px 0px -12% 0px', threshold: 0.08 }
        );

        targets.forEach((el) => observer.observe(el));
    }
}
