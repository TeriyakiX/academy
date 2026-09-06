/**
 * Складные колонки подвала на телефоне.
 *
 * Пять колонок ссылок занимали на телефоне почти два экрана. На узком
 * экране заголовок колонки становится кнопкой, список скрыт до нажатия.
 * Колонка с описанием и колонка с контактами не сворачиваются — там
 * телефон и адрес, их ищут чаще всего.
 */

const MOBILE = '(max-width: 760px)';
const mq = window.matchMedia(MOBILE);

function toggleColumn(col, open) {
    const list = col.querySelector('ul');
    const title = col.querySelector('.site-footer__col-title');
    if (!list || !title) return;

    col.classList.toggle('is-open', open);
    title.setAttribute('aria-expanded', String(open));
    list.hidden = !open;
}

function setup() {
    const cols = document.querySelectorAll('.site-footer__col');
    if (!cols.length) return;

    cols.forEach((col) => {
        const title = col.querySelector('.site-footer__col-title');
        const list = col.querySelector('ul');

        // без списка сворачивать нечего; контакты оставляем открытыми
        if (!title || !list || col.classList.contains('site-footer__col--contacts')) return;

        if (!col.dataset.accordionReady) {
            col.dataset.accordionReady = '1';
            col.classList.add('site-footer__col--foldable');
            title.setAttribute('role', 'button');
            title.setAttribute('tabindex', '0');

            const flip = () => toggleColumn(col, list.hidden);

            title.addEventListener('click', () => {
                if (mq.matches) flip();
            });
            title.addEventListener('keydown', (e) => {
                if (mq.matches && (e.key === 'Enter' || e.key === ' ')) {
                    e.preventDefault();
                    flip();
                }
            });
        }

        // на широком экране колонки всегда раскрыты
        toggleColumn(col, !mq.matches);
    });
}

setup();
mq.addEventListener('change', setup);
