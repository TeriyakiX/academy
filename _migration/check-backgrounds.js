/**
 * Проверяет, что соседние секции на странице отличаются фоном.
 * Запускается в браузере через mcp javascript_tool на каждой странице.
 *
 * Возвращает список пар «секция → секция», у которых фон совпал.
 */
(() => {
    const sections = [...document.querySelectorAll('main section, .wrapper > section')];

    const bg = (el) => {
        const cs = getComputedStyle(el);
        // градиент считаем отдельным фоном: сравниваем саму строку
        return cs.backgroundImage !== 'none' ? cs.backgroundImage : cs.backgroundColor;
    };

    const rows = sections.map((s) => ({
        cls: s.className.split(' ')[0] || s.tagName.toLowerCase(),
        bg: bg(s),
    }));

    const clashes = [];
    for (let i = 1; i < rows.length; i++) {
        if (rows[i].bg === rows[i - 1].bg) {
            clashes.push(`${rows[i - 1].cls} → ${rows[i].cls}`);
        }
    }

    return { total: rows.length, clashes, order: rows.map((r) => r.cls) };
})();
