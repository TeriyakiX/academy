<template>
    <ul class="ab-stats__list">
        <li v-for="(s, i) in items" :key="s.label" class="ab-stats__item">
            <!-- Кольцо заполняется вместе со счётчиком -->
            <div class="ab-stats__ring">
                <svg viewBox="0 0 100 100" aria-hidden="true">
                    <circle class="ab-stats__ring-bg" cx="50" cy="50" r="44" />
                    <circle
                        class="ab-stats__ring-fill"
                        cx="50" cy="50" r="44"
                        :stroke-dasharray="CIRC"
                        :stroke-dashoffset="CIRC - CIRC * progress[i]"
                    />
                </svg>
                <span class="ab-stats__ring-icon" v-html="s.icon"></span>
            </div>

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

const CIRC = 2 * Math.PI * 44;

// Стартуем с готовых значений: если JS не отработает, цифры всё равно верные.
const display = ref(props.items.map((s) => format(s.value)));
const progress = ref(props.items.map(() => 1));

function format(n) {
    return new Intl.NumberFormat('ru-RU').format(n);
}

/** Одновременно ведём число и заполнение кольца. */
function animate(index, target, duration = 1300) {
    const start = performance.now();

    const tick = (now) => {
        const t = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - t, 3);

        display.value[index] = format(Math.round(target * eased));
        progress.value[index] = eased;

        if (t < 1) requestAnimationFrame(tick);
    };

    requestAnimationFrame(tick);
}

onMounted(() => {
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced || !('IntersectionObserver' in window)) return;

    const root = document.querySelector('.ab-stats');
    if (!root) return;

    display.value = props.items.map(() => '0');
    progress.value = props.items.map(() => 0);

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                props.items.forEach((s, i) => setTimeout(() => animate(i, s.value), i * 120));
                observer.disconnect();
            });
        },
        { threshold: 0.3 }
    );

    observer.observe(root);
});
</script>
