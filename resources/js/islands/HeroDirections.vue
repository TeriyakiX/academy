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
                @click="index = i"
                @mouseenter="index = i"
            >
                {{ d.short }}
            </button>
        </div>

        <!-- Фото направления -->
        <div class="ab-hd__stage">
            <transition name="ab-hd-fade" mode="out-in">
                <a class="ab-hd__card" :key="active.title" :href="active.href">
                    <img class="ab-hd__photo" :src="active.photo" :alt="active.title"
                         width="620" height="520" loading="eager" decoding="async">

                    <div class="ab-hd__overlay">
                        <h2 class="ab-hd__title">{{ active.title }}</h2>
                        <p class="ab-hd__text">{{ active.text }}</p>
                        <span class="ab-hd__link">
                            {{ active.link }}
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M7 17 17 7M9 7h8v8" fill="none" stroke="currentColor"
                                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                    @click="index = i"
                ></button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

const props = defineProps({
    directions: { type: Array, required: true },
});

const index = ref(0);
const active = computed(() => props.directions[index.value]);

// Автопереключение, пока пользователь не вмешался
let timer = null;
const stop = () => timer && clearInterval(timer);

onMounted(() => {
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced) return;
    timer = setInterval(() => {
        index.value = (index.value + 1) % props.directions.length;
    }, 5000);
});

onBeforeUnmount(stop);
</script>
