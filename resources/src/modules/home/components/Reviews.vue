<template>
    <div class="ab-rv">
        <!-- Узкий экран: отзывы листаются пальцем -->
        <ul class="ab-rv__swipe">
            <li v-for="r in reviews" :key="r.name + r.date">
                <blockquote class="ab-rv__card">
                    <header class="ab-rv__cardhead">
                        <span class="ab-rv__avatar">{{ initials(r.name) }}</span>
                        <span class="ab-rv__meta">
                            <strong>{{ r.name }}</strong>
                            <span>{{ r.date }}</span>
                        </span>
                        <BaseStars :rating="r.rating" />
                    </header>

                    <p class="ab-rv__text">{{ r.text }}</p>

                    <a v-if="r.href" class="ab-rv__source" :href="r.href"
                       target="_blank" rel="noopener">Отзыв на Яндекс Картах</a>
                </blockquote>
            </li>
        </ul>

        <!-- Крупный отзыв -->
        <div class="ab-rv__stage">
            <transition name="ab-rv-fade" mode="out-in">
                <blockquote :key="index" class="ab-rv__quote">
                    <BaseStars :rating="active.rating" />

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

<script setup lang="ts">
import { computed, ref } from 'vue';
import BaseStars from '@/shared/components/BaseStars.vue';
import { initials, truncate } from '@/shared/utils';

const props = defineProps<{
    reviews: IReview[];
}>();

const index = ref(0);
const active = computed(() => props.reviews[index.value]);

const next = () => (index.value = (index.value + 1) % props.reviews.length);
const prev = () => (index.value = (index.value - 1 + props.reviews.length) % props.reviews.length);

const short = (text: string) => truncate(text, 90);
</script>
