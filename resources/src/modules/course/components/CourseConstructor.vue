<template>
    <div class="ctor">
        <!-- Школы -->
        <div class="ctor__tabs">
            <button
                v-for="(list, school) in schools"
                :key="school"
                class="ctor__tab"
                :class="{ 'is-active': school === activeSchool }"
                type="button"
                @click="activeSchool = school"
            >
                {{ school }}
                <span v-if="countIn(school)" class="ctor__tab-badge">{{ countIn(school) }}</span>
            </button>
        </div>

        <div class="ctor__body">
            <!-- Курсы активной школы -->
            <ul class="ctor__list">
                <li
                    v-for="course in schools[activeSchool]"
                    :key="course.id"
                    class="ctor__item"
                    :class="{ 'is-selected': isSelected(course.id) }"
                >
                    <button class="ctor__toggle" type="button" @click="toggle(course)">
                        <span class="ctor__toggle-icon">{{ isSelected(course.id) ? '−' : '+' }}</span>
                    </button>

                    <div class="ctor__item-main">
                        <h3 class="ctor__item-title">{{ course.title }}</h3>
                        <p class="ctor__item-desc">{{ course.desc }}</p>
                        <p class="ctor__item-meta">
                            <span v-if="course.duration">{{ course.duration }}</span>
                            <span v-if="course.format"> · {{ course.format }}</span>
                        </p>
                    </div>

                    <div class="ctor__item-price">
                        <s v-if="course.old" class="ctor__item-old">{{ money(course.old) }}</s>
                        <strong>{{ money(course.price) }}</strong>
                    </div>
                </li>
            </ul>

            <!-- Итог -->
            <aside class="ctor__result">
                <h3 class="ctor__result-title">Ваш курс</h3>

                <p v-if="!selected.length" class="ctor__empty">
                    Выберите курсы слева — чем больше, тем выше скидка.
                </p>

                <ul v-else class="ctor__chosen">
                    <li v-for="c in selected" :key="c.id" class="ctor__chosen-item">
                        <button class="ctor__remove" type="button" title="Убрать" @click="toggle(c)">×</button>
                        <span class="ctor__chosen-name">{{ c.title }}</span>
                        <span class="ctor__chosen-price">{{ money(c.price) }}</span>
                    </li>
                </ul>

                <dl class="ctor__stats">
                    <div><dt>Направлений</dt><dd>{{ schoolCount }}</dd></div>
                    <div><dt>Курсов</dt><dd>{{ selected.length }}</dd></div>
                    <div><dt>Скидка</dt><dd>{{ discount }}%</dd></div>
                </dl>

                <p v-if="nextStep" class="ctor__hint">
                    Добавьте ещё {{ nextStep.need }} — скидка вырастет до {{ nextStep.percent }}%
                </p>

                <div class="ctor__total">
                    <s v-if="discount" class="ctor__total-old">{{ money(total) }}</s>
                    <strong class="ctor__total-sum">{{ money(finalPrice) }}</strong>
                </div>

                <button class="ctor__submit" type="button" :disabled="!selected.length" @click="submit">
                    Оставить заявку
                </button>
            </aside>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed, ref, watch } from 'vue';
import CourseService from '@/modules/course/services/CourseService';
import { formatPrice } from '@/shared/utils';

const props = defineProps<{
    schools: TSchools;
    discounts: TDiscountTiers;
}>();

/** Выбор переживает перезагрузку: человек уходит смотреть курс и возвращается. */
const STORAGE_KEY = 'ab-constructor';

const activeSchool = ref(Object.keys(props.schools)[0]);
const selectedIds = ref<TCourseId[]>(restore());

function restore(): TCourseId[] {
    try {
        const raw = localStorage.getItem(STORAGE_KEY);
        return raw ? JSON.parse(raw) : [];
    } catch {
        return [];
    }
}

watch(selectedIds, (ids) => {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(ids));
    } catch { /* приватный режим — молча пропускаем */ }
}, { deep: true });

const allCourses = computed<ICourse[]>(() => Object.values(props.schools).flat());

const selected = computed<ICourse[]>(() =>
    selectedIds.value
        .map((id) => allCourses.value.find((c) => c.id === id))
        .filter((c): c is ICourse => Boolean(c)),
);

const isSelected = (id: TCourseId) => selectedIds.value.includes(id);

function toggle(course: ICourse) {
    selectedIds.value = isSelected(course.id)
        ? selectedIds.value.filter((id) => id !== course.id)
        : [...selectedIds.value, course.id];
}

function countIn(school: TSchool) {
    return props.schools[school].filter((c) => isSelected(c.id)).length;
}

/* Деньги считает сервис: скидки правят чаще, чем вёрстку. */
const selection = computed<ICourseSelection>(() =>
    CourseService.calculate(selected.value, props.schools, props.discounts),
);

const schoolCount = computed(() => selection.value.schools);
const total = computed(() => selection.value.total);
const discount = computed(() => selection.value.discount);
const finalPrice = computed(() => selection.value.final);

const nextStep = computed(() => CourseService.nextDiscount(selected.value.length, props.discounts));

const money = (n: number) => formatPrice(n);

/** Подобранный курс уходит в форму заявки — её слушает модуль lead. */
function submit() {
    window.dispatchEvent(new CustomEvent<ICourseSelection>('constructor:submit', {
        detail: selection.value,
    }));
}
</script>