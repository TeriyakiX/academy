<template>
    <div class="ab-teachers">
        <div class="ab-teachers__stage">
            <button class="ab-teachers__arrow ab-teachers__arrow--prev" type="button"
                    aria-label="Предыдущий преподаватель" @click="prev">‹</button>

            <div class="ab-teachers__card">
                <div class="ab-teachers__photo">
                    <img :src="active.photo" :alt="active.name" width="360" height="440" loading="lazy">
                </div>

                <div class="ab-teachers__info">
                    <h3 class="ab-teachers__name">{{ active.name }}</h3>
                    <p class="ab-teachers__role">{{ active.role }}</p>

                    <p class="ab-teachers__skills-title">Направления:</p>
                    <ul class="ab-teachers__skills">
                        <li v-for="skill in active.skills" :key="skill">{{ skill }}</li>
                    </ul>
                </div>
            </div>

            <button class="ab-teachers__arrow ab-teachers__arrow--next" type="button"
                    aria-label="Следующий преподаватель" @click="next">›</button>
        </div>

        <ul class="ab-teachers__thumbs">
            <li v-for="(t, i) in teachers" :key="t.name">
                <button class="ab-teachers__thumb" :class="{ 'is-active': i === index }"
                        type="button" :aria-label="t.name" @click="index = i">
                    <img :src="t.photo" :alt="t.name" width="64" height="64" loading="lazy">
                    <span>{{ t.name }}</span>
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    teachers: { type: Array, required: true },
});

const index = ref(0);
const active = computed(() => props.teachers[index.value]);

const next = () => (index.value = (index.value + 1) % props.teachers.length);
const prev = () => (index.value = (index.value - 1 + props.teachers.length) % props.teachers.length);
</script>
