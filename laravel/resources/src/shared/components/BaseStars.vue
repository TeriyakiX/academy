<template>
    <span class="ab-rv__stars" :aria-label="`Оценка ${rating} из 5`">
        <svg v-for="n in max" :key="n" viewBox="0 0 24 24" :class="{ 'is-on': n <= rating }">
            <path d="m12 3 2.6 5.6 6.1.8-4.5 4.2 1.2 6-5.4-3-5.4 3 1.2-6L3.3 9.4l6.1-.8L12 3Z" />
        </svg>
    </span>
</template>

<script setup lang="ts">
/*
 | Оценка звёздами. Одна и та же разметка нужна и в крупном отзыве,
 | и в карточке для телефона — держим её в одном месте.
 */
withDefaults(defineProps<{
    rating: number;
    max?: number;
}>(), {
    max: 5,
});
</script>
