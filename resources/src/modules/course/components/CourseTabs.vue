<template>
    <div class="ab-tabs">
        <!-- Вкладки направлений -->
        <div class="ab-tabs__nav" role="tablist">
            <button
                v-for="(list, name) in schools"
                :key="name"
                class="ab-tabs__tab"
                :class="{ 'is-active': name === active }"
                type="button"
                role="tab"
                :aria-selected="name === active"
                @click="active = name"
            >
                {{ name }}
                <span class="ab-tabs__count">{{ list.length }}</span>
            </button>
        </div>

        <!-- Карточки -->
        <transition-group name="ab-card" tag="div" class="ab-tabs__grid">
            <article v-for="course in schools[active]" :key="course.id" class="ab-card">
                <div class="ab-card__head">
                    <h3 class="ab-card__title">{{ course.title }}</h3>
                    <p class="ab-card__desc">{{ course.desc }}</p>
                </div>

                <ul class="ab-card__facts">
                    <li v-if="course.duration">
                        <span>Длительность</span><b>{{ course.duration }}</b>
                    </li>
                    <li v-if="course.schedule">
                        <span>Расписание</span><b>{{ course.schedule }}</b>
                    </li>
                    <li v-if="course.format">
                        <span>Формат</span><b>{{ course.format }}</b>
                    </li>
                </ul>

                <div class="ab-card__foot">
                    <div class="ab-card__price">
                        <s v-if="course.old">{{ money(course.old) }}</s>
                        <strong>{{ money(course.price) }}</strong>
                    </div>
                    <a class="ab-btn ab-btn--primary ab-btn--sm" :href="course.url">Подробнее</a>
                </div>
            </article>
        </transition-group>

        <div class="ab-tabs__more">
            <a class="ab-btn ab-btn--outline" href="/courses.html">Все программы</a>
            <a class="ab-btn ab-btn--dark" href="/constructor.html">Собрать свой курс</a>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { formatPrice } from '@/shared/utils';

const props = defineProps<{
    schools: TSchools;
}>();

const active = ref(Object.keys(props.schools)[0]);
const money = (n: number) => formatPrice(n);
</script>
