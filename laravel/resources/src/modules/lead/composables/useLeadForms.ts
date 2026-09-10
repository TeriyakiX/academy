import LeadService from '@/modules/lead/services/LeadService';
import { claim, qs, qsa } from '@/shared/utils/dom';

/*
 | Поведение всех форм заявки на сайте.
 |
 | Форма остаётся обычной: method="post" action="/lead". Скрипт добавляет
 | три вещи, каждая из которых раньше стоила человеку перезагрузки:
 |  - телефон форматируется по мере набора;
 |  - незаполненный номер видно до отправки;
 |  - повторное нажатие кнопки не создаёт вторую заявку.
 */

const FORM = 'form[action="/lead"]';
const ERROR_CLASS = 'ab-field-error';

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

function bind(form: HTMLFormElement): void {
    if (!claim(form, 'leadReady')) return;

    const phone = qs<HTMLInputElement>('input[name="phone"]', form);
    const name = qs<HTMLInputElement>('input[name="name"]', form);
    const submit = qs<HTMLButtonElement>('button[type="submit"]', form);

    phone?.addEventListener('input', () => {
        phone.value = LeadService.maskPhone(phone.value);
        clearError(phone);
    });

    name?.addEventListener('input', () => clearError(name));

    form.addEventListener('submit', (e) => {
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

        // страница уходит на «спасибо» — блокируем кнопку, чтобы
        // нетерпеливое второе нажатие не отправило заявку дважды
        if (submit) {
            submit.disabled = true;
            submit.dataset.label = submit.textContent ?? '';
            submit.textContent = 'Отправляем…';
        }
    });
}

export function useLeadForms(): void {
    qsa<HTMLFormElement>(FORM).forEach(bind);
}
