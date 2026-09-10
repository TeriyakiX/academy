import { defineStore } from 'pinia';
import { ref } from 'vue';

/*
 | Доступ к модалке заявки из любого места.
 |
 | Саму модалку рисует Blade, открывает её модуль layout. Компонентам
 | вроде конструктора курсов нужно уметь её позвать, но лезть в чужой
 | DOM они не должны — поэтому layout отдаёт сюда способ открыть,
 | а остальные просто просят.
 */
export default defineStore('Modal', () => {
    const opener = ref<((target: string) => void) | null>(null);

    /** Layout сообщает, как открывать модалки на этой странице. */
    function register(fn: (target: string) => void): void {
        opener.value = fn;
    }

    /** Открыть модалку. Если её на странице нет — ничего не делаем. */
    function open(target = 'consultation'): void {
        opener.value?.(target);
    }

    return { register, open };
});
