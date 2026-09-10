import { storeToRefs } from 'pinia';
import useViewportStore from '@/shared/store/useViewportStore';

/** Ширина экрана для компонентов. Слушатели живут в сторе, здесь только чтение. */
export function useBreakpoints() {
    const { width, isMobile, isTablet, isDesktop } = storeToRefs(useViewportStore());

    return { width, isMobile, isTablet, isDesktop };
}
