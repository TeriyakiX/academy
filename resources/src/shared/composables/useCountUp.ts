import { qsa } from '@/shared/utils/dom';
import { observeOnce } from './useIntersection';

/**
 * Цифра набегает от нуля, когда доезжает до экрана: <b data-count="1000">.
 * Длительность одна для всех чисел, поэтому большие бегут быстрее —
 * так ряд цифр заканчивает движение одновременно.
 */
export function useCountUp(): void {
    const DURATION = 1100;

    const slow = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    observeOnce(
        qsa<HTMLElement>('[data-count]'),
        (el) => {
            const target = Number(el.dataset.count ?? 0);

            if (!target || slow) {
                el.textContent = String(target);
                return;
            }

            const started = performance.now();

            const step = (now: number) => {
                const p = Math.min((now - started) / DURATION, 1);
                /* замедление к концу: быстро стартует, мягко останавливается */
                const eased = 1 - Math.pow(1 - p, 3);

                el.textContent = String(Math.round(target * eased));

                if (p < 1) {
                    requestAnimationFrame(step);
                }
            };

            requestAnimationFrame(step);
        },
        { rootMargin: '0px 0px -10% 0px', threshold: 0.3 },
    );
}
