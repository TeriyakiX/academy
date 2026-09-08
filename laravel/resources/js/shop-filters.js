/**
 * Списки фильтров каталога на узком экране.
 *
 * Значение варианта — готовый адрес с выбранными фильтрами,
 * поэтому переход сводится к смене адреса. Без скрипта работают
 * кнопки-фильтры, которые видны на широком экране.
 */
document.addEventListener('change', (e) => {
    const select = e.target.closest('select[data-filter-go]');
    if (!select || !select.value) return;

    window.location.href = select.value;
});
