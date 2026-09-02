<template>
    <div class="ab-faq__list">
        <div v-for="(item, i) in items" :key="i" class="ab-faq__item" :class="{ 'is-open': open === i }">
            <button
                class="ab-faq__question"
                type="button"
                :aria-expanded="open === i"
                @click="toggle(i)"
            >
                <span>{{ item.q }}</span>
                <svg class="ab-faq__icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 5v14M5 12h14" fill="none" stroke="currentColor"
                          stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>

            <!-- Плавное раскрытие: высота считается по фактическому контенту -->
            <div class="ab-faq__body" :style="{ maxHeight: open === i ? heights[i] + 'px' : '0px' }">
                <div class="ab-faq__answer" :ref="(el) => (bodies[i] = el)">
                    <p>{{ item.a }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { nextTick, onMounted, ref } from 'vue';

const props = defineProps({
    items: { type: Array, required: true },
});

const open = ref(null);
const bodies = ref([]);
const heights = ref(props.items.map(() => 0));

const measure = () => {
    heights.value = bodies.value.map((el) => (el ? el.scrollHeight : 0));
};

function toggle(i) {
    measure(); // пересчитываем перед открытием: шрифты и ширина могли измениться
    open.value = open.value === i ? null : i;
}

onMounted(async () => {
    await nextTick();
    measure();
    window.addEventListener('resize', measure);
});
</script>
