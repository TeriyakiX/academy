<template>
    <div class="ab-faq__list">
        <div v-for="(item, i) in items" :key="i" class="ab-faq__item" :class="{ 'is-open': isOpen(i) }">
            <button
                class="ab-faq__question"
                type="button"
                :aria-expanded="isOpen(i)"
                @click="toggle(i)"
            >
                <span>{{ item.q }}</span>
                <svg class="ab-faq__icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 5v14M5 12h14" fill="none" stroke="currentColor"
                          stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>

            <div class="ab-faq__body" :style="styleFor(i)">
                <div :ref="setBody(i)" class="ab-faq__answer">
                    <p>{{ item.a }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useAccordion } from '@/shared/composables/useAccordion';

defineProps<{
    items: IFaqItem[];
}>();

const { isOpen, setBody, styleFor, toggle } = useAccordion();
</script>
