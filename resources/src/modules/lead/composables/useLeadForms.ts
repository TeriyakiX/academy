import LeadService from '@/modules/lead/services/LeadService';
import { qs } from '@/shared/utils/dom';

/*
 | Поведение всех форм заявки на сайте.
 |
 | Форма остаётся обычной: method="post" action="/lead". Скрипт добавляет
 | три вещи, каждая из которых раньше стоила человеку перезагрузки:
 |  - телефон форматируется по мере набора;
 |  - незаполненный номер видно до отправки;
 |  - повторное нажатие кнопки не создаёт вторую заявку.
 |
 | Слушаем на уровне документа, а не навешиваем обработчики на каждую форму:
 | часть форм рисует Vue уже после загрузки скрипта — например, шаги
 | оформления сертификата, — и такие формы оставались без маски.
 */

const FORM = 'form[action="/lead"]';
const ERROR_CLASS = 'ab-field-error';

function formOf(el: EventTarget | null): HTMLFormElement | null {
    return (el as HTMLElement | null)?.closest<HTMLFormElement>(FORM) ?? null;
}

function showError(field: HTMLElement, message: string): void {
    clearError(field);

    const hint = document.createElement('span');
    hint.className = ERROR_CLASS;
    hint.textContent = message;

    field.setAttribute('aria-invalid', 'true');
    field.after(hint);
}

function clearError(field: HTMLElement): void {
    field.removeAttribute('aria-invalid');

    const hint = field.nextElementSibling;
    if (hint?.classList.contains(ERROR_CLASS)) hint.remove();
}

export function useLeadForms(): void {
    /* Телефон приводим к привычному виду по мере набора. */
    document.addEventListener('input', (e) => {
        const field = e.target as HTMLInputElement | null;
        if (!field || !formOf(field)) return;

        if (field.name === 'phone') {
            field.value = LeadService.maskPhone(field.value);
        }

        if (field.name === 'phone' || field.name === 'name') {
            clearError(field);
        }
    });

    document.addEventListener('submit', (e) => {
        const form = formOf(e.target);
        if (!form) return;

        const name = qs<HTMLInputElement>('input[name="name"]', form);
        const phone = qs<HTMLInputElement>('input[name="phone"]', form);
        const submit = qs<HTMLButtonElement>('button[type="submit"]', form);

        const { valid, errors } = LeadService.validate({
            name: name?.value ?? '',
            phone: phone?.value ?? '',
        });

        if (!valid) {
            e.preventDefault();

            if (errors.name && name) showError(name, errors.name);
            if (errors.phone && phone) showError(phone, errors.phone);

            (errors.name ? name : phone)?.focus();

            return;
        }

        /* Страница уходит на «спасибо» — блокируем кнопку, чтобы
           нетерпеливое второе нажатие не отправило заявку дважды. */
        if (submit) {
            submit.disabled = true;
            submit.textContent = 'Отправляем…';
        }
    });
}
