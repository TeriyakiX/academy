<template>
    <div class="ab-bus__grid">
        <article
            v-for="(item, i) in items"
            :key="item.title"
            class="ab-bus__card"
            :class="{ 'is-open': isOpen(i) }"
        >
            <div v-if="item.image" class="ab-bus__media">
                <img :src="item.image" :alt="item.title" loading="lazy" width="420" height="240">
            </div>

            <div class="ab-bus__body">
                <h3 class="ab-bus__title">{{ item.title }}</h3>

                <ul class="ab-bus__meta">
                    <li v-if="item.price"><b>{{ money(item.price) }}</b></li>
                    <li v-if="item.duration">{{ item.duration }}</li>
                </ul>

                <p v-if="item.text" class="ab-bus__text">{{ item.text }}</p>

                <div v-if="item.points.length" class="ab-bus__details" :style="styleFor(i)">
                    <div :ref="setBody(i)">
                        <p class="ab-bus__details-title">Что входит:</p>
                        <ul class="ab-bus__points">
                            <li v-for="p in item.points" :key="p">{{ p }}</li>
                        </ul>
                    </div>
                </div>

                <div class="ab-bus__actions">
                    <button
                        v-if="item.points.length"
                        class="ab-bus__toggle"
                        type="button"
                        :aria-expanded="isOpen(i)"
                        @click="toggle(i)"
                    >
                        {{ isOpen(i) ? 'Свернуть' : 'Что входит' }}
                    </button>
                    <button class="ab-btn ab-btn--primary ab-btn--sm" type="button"
                            data-modal-path="consultation">
Оставить заявку
</button>
                </div>
            </div>
        </article>
    </div>
</template>

<script setup lang="ts">
import { useAccordion } from '@/shared/composables/useAccordion';
import { formatPrice } from '@/shared/utils';

defineProps<{
    items: IBusinessService[];
}>();

const { isOpen, setBody, styleFor, toggle } = useAccordion();

const money = (n: number) => formatPrice(n);
</script>
