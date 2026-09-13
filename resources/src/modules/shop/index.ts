/*
 | Каталог оборудования: фильтры и смена цвета в карточке товара.
 */
import { useProductVariants } from './composables/useProductVariants';
import { useShopFilters } from './composables/useShopFilters';
import { useShowMore } from './composables/useShowMore';

export function setupShop(): void {
    useShopFilters();
    useShowMore();
    useProductVariants();
}
