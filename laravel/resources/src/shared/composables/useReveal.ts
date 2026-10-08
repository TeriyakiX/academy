import { qsa } from '@/shared/utils/dom';
import { observeOnce } from './useIntersection';

/**
 * Появление блоков при прокрутке: элементу с .ab-reveal добавляется
 * .is-visible, когда он входит в экран. CSS-анимации внутри блоков
 * привязаны к этому классу, поэтому запускаются в нужный момент.
 */
export function useReveal(): void {
    const blocks = qsa<HTMLElement>('.ab-reveal');

    /*
     | Блоки, которые уже попали в первый экран, показываем сразу.
     | Наблюдатель ждёт, пока в экран войдёт 8% высоты блока, а у
     | высокой секции это несколько сотен пикселей: её верх уже виден,
     | но блок ещё прозрачный — под первым экраном оставалось белое поле.
     */
    const rest = blocks.filter((el) => {
        if (el.getBoundingClientRect().top >= window.innerHeight) {
            return true;
        }

        el.classList.add('is-visible');

        return false;
    });

    observeOnce(
        rest,
        (el) => el.classList.add('is-visible'),
        { rootMargin: '0px 0px -12% 0px', threshold: 0.08 },
    );
}
