import { defineStore } from 'pinia';
import { computed, ref } from 'vue';
import { MEDIA_MOBILE, MEDIA_TABLET } from '@/shared/constants/breakpoints';

/*
 | Ширина экрана в одном месте.
 |
 | Слушателей resize на странице было несколько: точки каруселей,
 | подвал, меню. Каждый считал ширину сам. Теперь считает один,
 | остальные читают готовое значение.
 */
export default defineStore('Viewport', () => {
    const width = ref(window.innerWidth);
    const isMobile = ref(window.matchMedia(MEDIA_MOBILE).matches);
    const isTablet = ref(window.matchMedia(MEDIA_TABLET).matches);

    const isDesktop = computed(() => !isTablet.value);

    const mobileQuery = window.matchMedia(MEDIA_MOBILE);
    const tabletQuery = window.matchMedia(MEDIA_TABLET);

    mobileQuery.addEventListener('change', (e) => (isMobile.value = e.matches));
    tabletQuery.addEventListener('change', (e) => (isTablet.value = e.matches));

    window.addEventListener('resize', () => (width.value = window.innerWidth), { passive: true });

    return { width, isMobile, isTablet, isDesktop };
});
