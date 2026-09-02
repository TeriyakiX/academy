<template>
    <div class="ab-ev">
        <div class="ab-ev__tabs" role="tablist">
            <button
                v-for="(list, month) in months"
                :key="month"
                class="ab-ev__tab"
                :class="{ 'is-active': month === active }"
                type="button"
                role="tab"
                :aria-selected="month === active"
                @click="active = month"
            >
                {{ month }}
                <span class="ab-ev__tab-count">{{ list.length }}</span>
            </button>
        </div>

        <transition-group name="ab-ev-fade" tag="ul" class="ab-ev__list">
            <li v-for="e in months[active]" :key="e.title + e.date" class="ab-ev__card">
                <div class="ab-ev__date">
                    <b>{{ e.day }}</b>
                    <span>{{ e.month }}</span>
                    <em>{{ e.weekday }}, {{ e.time }}</em>
                </div>

                <div class="ab-ev__body">
                    <h3 class="ab-ev__title">{{ e.title }}</h3>
                    <p class="ab-ev__text">{{ e.text }}</p>

                    <ul class="ab-ev__meta">
                        <li>{{ e.seats }}</li>
                        <li v-if="e.price"><b>{{ money(e.price) }}</b></li>
                    </ul>
                </div>

                <div class="ab-ev__action">
                    <button class="ab-btn ab-btn--primary" type="button" data-modal-path="events">
                        Записаться
                    </button>
                </div>
            </li>
        </transition-group>

        <p v-if="!months[active] || !months[active].length" class="ab-ev__empty">
            На этот месяц мероприятий пока нет — напишите нам, подскажем ближайшие даты.
        </p>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    months: { type: Object, required: true },
});

const active = ref(Object.keys(props.months)[0]);
const money = (n) => new Intl.NumberFormat('ru-RU').format(n) + ' ₽';
</script>
