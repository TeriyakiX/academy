import { MEDIA_MOBILE } from '@/shared/constants/breakpoints';
import { claim, isHidden, qs, qsa, toggleDisclosure } from '@/shared/utils/dom';

/**
 * Складные колонки подвала на телефоне.
 *
 * Пять колонок ссылок занимали почти два экрана. На узком экране
 * заголовок колонки становится кнопкой, список скрыт до нажатия.
 * Колонка с контактами не сворачивается — телефон и адрес ищут чаще всего.
 */
export function useFooterAccordion(): void {
    const query = window.matchMedia(MEDIA_MOBILE);

    const setup = () => {
        qsa('.site-footer__col').forEach((col) => {
            const title = qs('.site-footer__col-title', col);
            const list = qs('ul', col);

            // без списка сворачивать нечего; контакты оставляем открытыми
            if (!title || !list || col.classList.contains('site-footer__col--contacts')) return;

            if (claim(col, 'accordionReady')) {
                col.classList.add('site-footer__col--foldable');
                title.setAttribute('role', 'button');
                title.setAttribute('tabindex', '0');

                const flip = () => {
                    const open = isHidden(list);
                    col.classList.toggle('is-open', open);
                    toggleDisclosure(title, list, open);
                };

                title.addEventListener('click', () => {
                    if (query.matches) flip();
                });

                title.addEventListener('keydown', (e) => {
                    if (query.matches && (e.key === 'Enter' || e.key === ' ')) {
                        e.preventDefault();
                        flip();
                    }
                });
            }

            // на широком экране колонки всегда раскрыты
            col.classList.toggle('is-open', !query.matches);
            toggleDisclosure(title, list, !query.matches);
        });
    };

    setup();
    query.addEventListener('change', setup);
}
