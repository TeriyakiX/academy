<template>
    <div class="ab-cprog__grid">
        <article v-for="(block, i) in blocks" :key="block.title" class="ab-cprog__block">
            <header class="ab-cprog__head">
                <span class="ab-cprog__n">{{ String(i + 1).padStart(2, '0') }}</span>
                <div>
                    <h3 class="ab-cprog__title">{{ block.title }}</h3>
                    <p class="ab-cprog__count">{{ block.topics.length }} {{ plural(block.topics.length) }}</p>
                </div>
            </header>

            <ul class="ab-cprog__topics">
                <li v-for="(topic, t) in visible(block, i)" :key="t">{{ topic }}</li>
            </ul>

            <button
                v-if="block.topics.length > LIMIT"
                class="ab-cprog__more"
                type="button"
                @click="toggle(i)"
            >
                {{ expanded.includes(i) ? 'Свернуть' : `Показать все ${block.topics.length}` }}
            </button>
        </article>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    blocks: { type: Array, required: true },
});

const LIMIT = 6;
const expanded = ref([]);

const visible = (block, i) =>
    expanded.value.includes(i) ? block.topics : block.topics.slice(0, LIMIT);

function toggle(i) {
    expanded.value = expanded.value.includes(i)
        ? expanded.value.filter((n) => n !== i)
        : [...expanded.value, i];
}

function plural(n) {
    const forms = ['тема', 'темы', 'тем'];
    const mod10 = n % 10;
    const mod100 = n % 100;
    if (mod10 === 1 && mod100 !== 11) return forms[0];
    if (mod10 >= 2 && mod10 <= 4 && (mod100 < 10 || mod100 >= 20)) return forms[1];
    return forms[2];
}
</script>
