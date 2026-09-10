import { qsa } from '@/shared/utils/dom';
import { observeOnce } from './useIntersection';

/**
 * Появление блоков при прокрутке: элементу с .ab-reveal добавляется
 * .is-visible, когда он входит в экран. CSS-анимации внутри блоков
 * привязаны к этому классу, поэтому запускаются в нужный момент.
 */
export function useReveal(): void {
    observeOnce(
        qsa('.ab-reveal'),
        (el) => el.classList.add('is-visible'),
        { rootMargin: '0px 0px -12% 0px', threshold: 0.08 },
    );
}
