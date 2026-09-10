/*
 | Формы заявки: маска телефона, подсказки об ошибках и защита
 | от повторной отправки. Сама отправка остаётся обычным POST —
 | заявка уходит и без JavaScript.
 */
import { useConstructorBridge } from './composables/useConstructorBridge';
import { useLeadForms } from './composables/useLeadForms';

export function setupLead(): void {
    useLeadForms();
    useConstructorBridge();
}
