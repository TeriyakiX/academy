/**
 * Списки фильтров каталога на узком экране.
 *
 * Значение варианта — готовый адрес с выбранными фильтрами, поэтому
 * переход сводится к смене адреса. Кнопки-фильтры для широкого экрана
 * работают сами, без скрипта.
 */
export function useShopFilters(): void {
    document.addEventListener('change', (e) => {
        const target = e.target as HTMLElement | null;
        const select = target?.closest<HTMLSelectElement>('select[data-filter-go]');

        if (!select?.value) return;

        window.location.href = select.value;
    });
}
