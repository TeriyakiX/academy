import { observeOnce } from '@/shared/composables/useIntersection';
import { qsa } from '@/shared/utils/dom';

/**
 * Ленивые карты.
 *
 * Iframe хранит адрес в data-src и подгружается, когда блок подъезжает
 * к экрану: карта Яндекса тянет за собой заметный объём и на первом
 * экране не нужна ни на одной странице.
 */
export function useLazyMaps(): void {
    const load = (el: Element) => {
        const frame = el as HTMLIFrameElement;
        if (frame.dataset.src && frame.src !== frame.dataset.src) frame.src = frame.dataset.src;
    };

    observeOnce(qsa('.lazy-map[data-src]'), load, { rootMargin: '0px 0px 300px 0px' });
}
