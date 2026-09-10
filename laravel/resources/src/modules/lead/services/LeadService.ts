import { formatPhone } from '@/shared/utils';

/**
 * Проверка и подготовка заявки на стороне браузера.
 *
 * Сервер проверяет всё заново — здесь мы лишь избавляем человека
 * от лишнего перехода: сказать «телефон введён не полностью» можно
 * сразу, не перезагружая страницу.
 */
class LeadService {
    /** Российский номер — 11 цифр, начинается с 7 или 8. */
    private static readonly PHONE_DIGITS = 11;

    /** Оставляет только цифры и приводит 8… к 7…. */
    digits(phone: string): string {
        return phone.replace(/\D/g, '').replace(/^8/, '7');
    }

    /** Достроен ли номер до полного. */
    isPhoneComplete(phone: string): boolean {
        const digits = this.digits(phone);

        return digits.length === LeadService.PHONE_DIGITS && digits.startsWith('7');
    }

    /** Приводит ввод к виду +7 (925) 152-28-66 по мере набора. */
    maskPhone(input: string): string {
        const digits = this.digits(input).slice(0, LeadService.PHONE_DIGITS);

        if (!digits) return '';

        const [, code = '', first = '', second = '', third = ''] =
            digits.match(/^7?(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})$/) ?? [];

        let result = '+7';
        if (code) result += ` (${code}`;
        if (code.length === 3) result += ')';
        if (first) result += ` ${first}`;
        if (second) result += `-${second}`;
        if (third) result += `-${third}`;

        return result;
    }

    validate(lead: ILead): ILeadValidation {
        const errors: ILeadValidation['errors'] = {};

        if (!lead.name.trim()) {
            errors.name = 'Напишите, как к вам обращаться';
        }

        if (!this.isPhoneComplete(lead.phone)) {
            errors.phone = 'Введите номер полностью';
        }

        return { valid: !Object.keys(errors).length, errors };
    }

    /** Номер в том виде, в каком его удобно читать в заявке. */
    normalize(lead: ILead): ILead {
        return { ...lead, name: lead.name.trim(), phone: formatPhone(lead.phone) };
    }
}

export default new LeadService();
