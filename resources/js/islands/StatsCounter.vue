<template>
    <ul class="ab-stats__list">
        <li v-for="(s, i) in items" :key="s.label" class="ab-stats__item">
            <div class="ab-stats__value">
                <span class="ab-stats__num">{{ display[i] }}</span><span
                    v-if="s.suffix" class="ab-stats__suffix">{{ s.suffix }}</span>
            </div>
            <p class="ab-stats__label">{{ s.label }}</p>
            <p class="ab-stats__note">{{ s.note }}</p>
        </li>
    </ul>
</template>

<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    items: { type: Array, required: true },
});

// Начинаем с конечных значений: если JS не отработает, цифры всё равно верные.
const display = ref(props.items.map((s) => format(s.value)));

function format(n) {
    return new Intl.NumberFormat('ru-RU').format(n);
}

/** Набегание чисел: короткая анимация с замедлением к концу. */
function countUp(index, target, duration = 1100) {
    const start = performance.now();

    const tick = (now) => {
        const t = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - t, 3);
        display.value[index] = format(Math.round(target * eased));
        if (t < 1) requestAnimationFrame(tick);
    };

    requestAnimationFrame(tick);
}

onMounted(() => {
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced || !('IntersectionObserver' in window)) return;

    const root = document.querySelector('.ab-stats');
    if (!root) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                props.items.forEach((s, i) => countUp(i, s.value));
                observer.disconnect();
            });
        },
        { threshold: 0.35 }
    );

    // до входа в экран показываем нули, чтобы анимация была заметна
    display.value = props.items.map(() => '0');
    observer.observe(root);
});
</script>
