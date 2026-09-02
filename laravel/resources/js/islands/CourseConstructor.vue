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

<script setup>
import { computed, ref, watch } from 'vue';

const props = defineProps({
    schools: { type: Object, required: true },
    discounts: { type: Object, required: true },
});

const STORAGE_KEY = 'ab-constructor';

const activeSchool = ref(Object.keys(props.schools)[0]);
const selectedIds = ref(restore());

function restore() {
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

const allCourses = computed(() => Object.values(props.schools).flat());

const selected = computed(() =>
    selectedIds.value
        .map((id) => allCourses.value.find((c) => c.id === id))
        .filter(Boolean)
);

const isSelected = (id) => selectedIds.value.includes(id);

function toggle(course) {
    const i = selectedIds.value.indexOf(course.id);
    if (i === -1) selectedIds.value = [...selectedIds.value, course.id];
    else selectedIds.value = selectedIds.value.filter((id) => id !== course.id);
}

function countIn(school) {
    return props.schools[school].filter((c) => isSelected(c.id)).length;
}

const schoolCount = computed(() =>
    Object.keys(props.schools).filter((s) => countIn(s) > 0).length
);

const total = computed(() => selected.value.reduce((sum, c) => sum + c.price, 0));

// пороги: {количество: процент}
const tiers = computed(() =>
    Object.entries(props.discounts)
        .map(([count, percent]) => ({ count: Number(count), percent: Number(percent) }))
        .sort((a, b) => a.count - b.count)
);

const discount = computed(() => {
    let d = 0;
    for (const t of tiers.value) if (selected.value.length >= t.count) d = t.percent;
    return d;
});

const nextStep = computed(() => {
    const next = tiers.value.find((t) => selected.value.length < t.count);
    return next ? { need: next.count - selected.value.length, percent: next.percent } : null;
});

const finalPrice = computed(() => Math.round(total.value * (1 - discount.value / 100)));

const money = (n) => new Intl.NumberFormat('ru-RU').format(n) + ' ₽';

function submit() {
    window.dispatchEvent(new CustomEvent('constructor:submit', {
        detail: {
            courses: selected.value.map((c) => ({ id: c.id, title: c.title, price: c.price })),
            total: total.value,
            discount: discount.value,
            final: finalPrice.value,
        },
    }));
}
</script>
