<template>
    <div class="ab-hd">
        <!-- Переключатель направлений -->
        <div class="ab-hd__tabs" role="tablist">
            <button
                v-for="(d, i) in directions"
                :key="d.title"
                class="ab-hd__tab"
                :class="{ 'is-active': i === index }"
                type="button"
                role="tab"
                :aria-selected="i === index"
                @click="pick(i)"
                @mouseenter="index = i"
            >
                {{ d.short }}
            </button>
        </div>

        <!-- Фото направления -->
        <div class="ab-hd__stage"
             @touchstart.passive="onStart" @touchmove.passive="onMove" @touchend="onEnd">
            <transition name="ab-hd-fade" mode="out-in">
                <a :key="active.title" class="ab-hd__card" :href="active.href">
                    <img class="ab-hd__photo" :src="active.photo" :alt="active.title"
                         width="620" height="520" loading="eager" decoding="async">

                    <div class="ab-hd__overlay">
                        <h2 class="ab-hd__title">{{ active.title }}</h2>
                        <p class="ab-hd__text">{{ active.text }}</p>
                        <span class="ab-hd__link">
                            {{ active.link }}
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M7 17 17 7M9 7h8v8" fill="none" stroke="currentColor"
                                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </a>
            </transition>

            <!-- Индикаторы -->
            <div class="ab-hd__dots">
                <button
                    v-for="(d, i) in directions"
                    :key="'dot-' + i"
                    class="ab-hd__dot"
                    :class="{ 'is-active': i === index }"
                    type="button"
                    :aria-label="d.title"
                    @click="pick(i)"
                ></button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

const props = defineProps<{
    directions: IDirection[];
}>();

const index = ref(0);
const active = computed(() => props.directions[index.value]);

// Автопереключение, пока пользователь не вмешался
let timer: ReturnType<typeof setInterval> | null = null;
const stop = () => timer && clearInterval(timer);

onMounted(() => {
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced) return;
    timer = setInterval(() => {
        index.value = (index.value + 1) % props.directions.length;
    }, 5000);
});

onBeforeUnmount(stop);

/* Переключение вручную останавливает автопрокрутку. */
const go = (step: number) => {
    stop();
    const n = props.directions.length;
    index.value = (index.value + step + n) % n;
};

const pick = (i: number) => {
    stop();
    index.value = i;
};

/* Листание пальцем: карточка направления меняется свайпом,
   точки под ней остаются указателем положения. */
const SWIPE = 40;
let startX = 0;
let deltaX = 0;

const onStart = (e: TouchEvent) => {
    startX = e.touches[0].clientX;
    deltaX = 0;
};

const onMove = (e: TouchEvent) => {
    deltaX = e.touches[0].clientX - startX;
};

const onEnd = () => {
    if (Math.abs(deltaX) < SWIPE) return;
    go(deltaX < 0 ? 1 : -1);
    deltaX = 0;
};
</script>
