/*
 | Поведение общего каркаса страницы: шапка, меню, модалка заявки,
 | карты и подвал. Подключается на каждой странице.
 */
import { useFooterAccordion } from './composables/useFooterAccordion';
import { useLazyMaps } from './composables/useLazyMaps';
import { useMobileMenu } from './composables/useMobileMenu';
import { useRequestModal } from './composables/useRequestModal';

export function setupLayout(): void {
    useMobileMenu();
    useRequestModal();
    useLazyMaps();
    useFooterAccordion();
}
