/**
 * Совместимость со старыми сборками страниц.
 *
 * Бандлы страниц (masterClass.js, baristaBase.js и т.д.) инициализируют
 * старое мобильное меню и обращаются к его элементам без проверки на null.
 * После перехода на единую шапку этих элементов в разметке нет, и первая же
 * ошибка обрывала инициализацию всего остального на странице — карт, форм,
 * слайдеров, аккордеонов.
 *
 * Скрипт подставляет скрытые заглушки, чтобы старый код отработал вхолостую.
 * Загружается обычным (не module) скриптом до бандла страницы.
 *
 * Удалить, когда все страницы переведут на собственные компоненты.
 */
(function () {
    'use strict';

    var needed = [
        'header-burger',
        'mobile-menu',
        'mobile-menu__close',
        'mobile-menu__button',
        'mobile-menu__overlay',
    ];

    var missing = needed.filter(function (cls) {
        return !document.querySelector('.' + cls);
    });

    if (!missing.length) return;

    var stub = document.createElement('div');
    stub.setAttribute('aria-hidden', 'true');
    stub.dataset.legacyStub = '';
    stub.style.display = 'none';

    missing.forEach(function (cls) {
        var el = document.createElement('div');
        el.className = cls;
        stub.appendChild(el);
    });

    (document.body || document.documentElement).appendChild(stub);
})();
