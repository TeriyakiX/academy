import { ref } from 'vue';

/*
 | Раскрывающиеся блоки: вопросы и услуги для бизнеса устроены одинаково.
 |
 | Плавность даёт max-height, а он требует конкретного значения в пикселях —
 | «auto» браузер не анимирует. Поэтому высоту содержимого измеряем
 | по факту, перед самым раскрытием: шрифты и ширина к этому моменту
 | уже посчитаны, и блок не дёргается.
 */
export function useAccordion() {
    const open = ref<number | null>(null);
    const bodies = ref<Array<HTMLElement | null>>([]);

    /** Ссылка на содержимое пункта — вешается на элемент в шаблоне. */
    const setBody = (i: number) => (el: unknown) => {
        bodies.value[i] = el as HTMLElement | null;
    };

    const heightOf = (i: number) => bodies.value[i]?.scrollHeight ?? 0;

    /** Готовый стиль для обёртки: закрытый пункт имеет нулевую высоту. */
    const styleFor = (i: number) => ({
        maxHeight: open.value === i ? `${heightOf(i)}px` : '0px',
    });

    const toggle = (i: number) => {
        open.value = open.value === i ? null : i;
    };

    const isOpen = (i: number) => open.value === i;

    return { open, bodies, setBody, styleFor, toggle, isOpen };
}
