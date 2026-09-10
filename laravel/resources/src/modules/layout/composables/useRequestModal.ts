import useModalStore from '@/shared/store/useModalStore';
import { qs, qsa } from '@/shared/utils/dom';

/**
 * Модальное окно заявки.
 *
 * Кнопки с data-modal-path открывают блок с тем же data-modal-target.
 * Если своей модалки у кнопки нет, открываем общую форму заявки —
 * так кнопка никогда не остаётся мёртвой.
 */
export function useRequestModal(): void {
    const modals = qsa('[data-modal-target]');

    if (!modals.length) return;

    const open = (modal: HTMLElement) => {
        modal.hidden = false;
        document.body.classList.add('site-no-scroll');
        qs<HTMLInputElement>('input:not([type=hidden])', modal)?.focus();
    };

    const closeAll = () => {
        modals.forEach((modal) => (modal.hidden = true));
        document.body.classList.remove('site-no-scroll');
    };

    qsa('[data-modal-path]').forEach((button) => {
        button.addEventListener('click', (e) => {
            e.preventDefault();

            const target =
                qs(`[data-modal-target="${button.dataset.modalPath}"]`) ??
                qs('[data-modal-target="consultation"]');

            if (target) open(target);
        });
    });

    modals.forEach((modal) => {
        qsa('[data-modal-close]', modal).forEach((el) => el.addEventListener('click', closeAll));
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeAll();
    });

    // теперь модалку может позвать и Vue-компонент — например конструктор курсов
    useModalStore().register((target) => {
        const modal = qs(`[data-modal-target="${target}"]`);
        if (modal) open(modal);
    });
}
