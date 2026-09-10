/*
 | Каталог оборудования: фильтры и смена цвета в карточке товара.
 */
import { useProductVariants } from './composables/useProductVariants';
import { useShopFilters } from './composables/useShopFilters';

export function setupShop(): void {
    useShopFilters();
    useProductVariants();
}
