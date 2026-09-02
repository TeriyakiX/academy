<template>
    <div class="ab-rv">
        <!-- Крупный отзыв -->
        <div class="ab-rv__stage">
            <transition name="ab-rv-fade" mode="out-in">
                <blockquote class="ab-rv__quote" :key="index">
                    <div class="ab-rv__stars" :aria-label="`Оценка ${active.rating} из 5`">
                        <svg v-for="n in 5" :key="n" viewBox="0 0 24 24"
                             :class="{ 'is-on': n <= active.rating }">
                            <path d="m12 3 2.6 5.6 6.1.8-4.5 4.2 1.2 6-5.4-3-5.4 3 1.2-6L3.3 9.4l6.1-.8L12 3Z"/>
                        </svg>
                    </div>

                    <p class="ab-rv__text">{{ active.text }}</p>

                    <footer class="ab-rv__author">
                        <span class="ab-rv__avatar">{{ initials(active.name) }}</span>
                        <span class="ab-rv__meta">
                            <strong>{{ active.name }}</strong>
                            <span>{{ active.date }}</span>
                        </span>
                        <a v-if="active.href" class="ab-rv__source" :href="active.href"
                           target="_blank" rel="noopener">Отзыв на Яндекс Картах</a>
                    </footer>
                </blockquote>
            </transition>

            <div class="ab-rv__nav">
                <button class="ab-rv__arrow" type="button" aria-label="Предыдущий отзыв" @click="prev">‹</button>
                <span class="ab-rv__counter">{{ index + 1 }} / {{ reviews.length }}</span>
                <button class="ab-rv__arrow" type="button" aria-label="Следующий отзыв" @click="next">›</button>
            </div>
        </div>

        <!-- Список для выбора -->
        <ul class="ab-rv__list">
            <li v-for="(r, i) in reviews" :key="r.name + i">
                <button class="ab-rv__item" :class="{ 'is-active': i === index }"
                        type="button" @click="index = i">
                    <span class="ab-rv__item-name">{{ r.name }}</span>
                    <span class="ab-rv__item-text">{{ short(r.text) }}</span>
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    reviews: { type: Array, required: true },
});

const index = ref(0);
const active = computed(() => props.reviews[index.value]);

const next = () => (index.value = (index.value + 1) % props.reviews.length);
const prev = () => (index.value = (index.value - 1 + props.reviews.length) % props.reviews.length);

const initials = (name) =>
    name.split(' ').slice(0, 2).map((w) => w[0]).join('').toUpperCase();

const short = (text) => (text.length > 90 ? text.slice(0, 90).trimEnd() + '…' : text);
</script>
