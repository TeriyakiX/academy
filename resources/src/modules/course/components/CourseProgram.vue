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

<script setup lang="ts">
import { ref } from 'vue';
import { pluralize } from '@/shared/utils';

defineProps<{
    blocks: IProgramBlock[];
}>();

/** Длинные блоки показываем не целиком: список тем уходил на два экрана. */
const LIMIT = 6;
const expanded = ref<number[]>([]);

const visible = (block: IProgramBlock, i: number) =>
    expanded.value.includes(i) ? block.topics : block.topics.slice(0, LIMIT);

function toggle(i: number) {
    expanded.value = expanded.value.includes(i)
        ? expanded.value.filter((n) => n !== i)
        : [...expanded.value, i];
}

const plural = (n: number) => pluralize(n, ['тема', 'темы', 'тем']);
</script>
