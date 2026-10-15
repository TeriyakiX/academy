<template>
    <div class="ab-ev">
        <div class="ab-ev__tabs" role="tablist" aria-label="Месяцы">
            <button
                v-for="m in monthTabs"
                :key="m.name"
                class="ab-ev__tab"
                :class="{ 'is-active': m.name === active }"
                type="button"
                role="tab"
                :aria-selected="m.name === active"
                @click="active = m.name"
            >
                {{ m.name }}
                <span class="ab-ev__tab-count">{{ m.count }}</span>
            </button>

            <!-- Прошедшие встречи не прячем: по ним видно, что школа живёт
                 и что ещё бывает, кроме ближайших дат. -->
            <button
                v-if="past.length"
                class="ab-ev__tab ab-ev__tab--past"
                :class="{ 'is-active': active === PAST }"
                type="button"
                role="tab"
                :aria-selected="active === PAST"
                @click="active = PAST"
            >
                Прошли
                <span class="ab-ev__tab-count">{{ past.length }}</span>
            </button>
        </div>

        <!-- Разделы берём по всем встречам, чтобы строка не прыгала. -->
        <div v-if="sections.length > 1" class="ab-ev__tabs ab-ev__tabs--sections" role="tablist" aria-label="Разделы">
            <button
                class="ab-ev__tab"
                :class="{ 'is-active': !section }"
                type="button"
                role="tab"
                :aria-selected="!section"
                @click="section = ''"
            >
                Все
                <span class="ab-ev__tab-count">{{ current.length }}</span>
            </button>
            <button
                v-for="name in sections"
                :key="name"
                class="ab-ev__tab"
                :class="{ 'is-active': section === name, 'is-empty': !counts[name] }"
                type="button"
                role="tab"
                :aria-selected="section === name"
                :disabled="!counts[name]"
                @click="section = name"
            >
                {{ name }}
                <span class="ab-ev__tab-count">{{ counts[name] ?? 0 }}</span>
            </button>
        </div>

        <transition-group name="ab-ev-fade" tag="ul" class="ab-ev__list">
            <li v-for="e in visible" :key="e.title + e.date" class="ab-ev__card" :class="{ 'is-past': isPast(e) }">
                <component :is="e.slug ? 'a' : 'div'" class="ab-ev__photo" :href="link(e)">
                    <img :src="e.photo || '/assets/master-class.webp'" :alt="e.title"
                         width="420" height="280" loading="lazy" decoding="async">

                    <span v-if="e.section" class="ab-ev__badge">{{ e.section }}</span>
                    <span v-if="seats(e)" class="ab-ev__seats" :class="{ 'is-last': lastSeats(e) }">{{ seats(e) }}</span>
                </component>

                <div class="ab-ev__body">
                    <div class="ab-ev__when">
                        <b class="ab-ev__day">{{ e.day }}<span>{{ e.month }}</span></b>
                        <span class="ab-ev__time">
                            {{ e.time }}
                            <em>{{ e.weekday }}</em>
                        </span>
                    </div>

                    <p v-if="countdown(e)" class="ab-ev__soon" :class="{ 'is-past': isPast(e) }">{{ countdown(e) }}</p>

                    <h3 class="ab-ev__title">
                        <a v-if="e.slug" :href="link(e)">{{ e.title }}</a>
                        <template v-else>{{ e.title }}</template>
                    </h3>
                    <p class="ab-ev__text">{{ e.text }}</p>

                    <p class="ab-ev__price">{{ e.price ? money(e.price) : 'Бесплатно' }}</p>

                    <a v-if="!isPast(e) && e.slug" class="ab-btn ab-btn--primary ab-ev__btn" :href="link(e)">
                        Подробнее и запись
                    </a>
                    <button v-else-if="!isPast(e)" class="ab-btn ab-btn--primary ab-ev__btn"
                            type="button" data-modal-path="events">
                        Записаться
                    </button>
                    <a v-else-if="e.slug" class="ab-ev__closed" :href="link(e)">Встреча прошла — посмотреть</a>
                    <span v-else class="ab-ev__closed">Запись закрыта</span>
                </div>
            </li>
        </transition-group>

        <p v-if="!visible.length" class="ab-ev__empty">
            Здесь пока пусто — напишите нам, подскажем ближайшие даты.
        </p>
    </div>
</template>

<script setup lang="ts">
import { computed, ref, watch } from 'vue';
import { formatPrice } from '@/shared/utils';

const props = defineProps<{
    months: TEventMonths;
}>();

/** Вкладка с прошедшими встречами. */
const PAST = 'Прошли';

const today = new Date();
today.setHours(0, 0, 0, 0);

const isPast = (e: IEvent) => !!e.date && new Date(e.date) < today;

/** Месяцы, где остались будущие встречи. Пустые вкладки не показываем. */
const monthTabs = computed(() => Object.entries(props.months)
    .map(([name, list]) => ({ name, count: list.filter((e) => !isPast(e)).length }))
    .filter((m) => m.count > 0));

const past = computed(() => Object.values(props.months).flat().filter(isPast));

const active = ref(monthTabs.value[0]?.name ?? PAST);
const section = ref('');

/** Встречи выбранной вкладки. */
const current = computed(() => (active.value === PAST
    ? past.value
    : (props.months[active.value] ?? []).filter((e) => !isPast(e))));

const sections = computed(() => [...new Set(
    Object.values(props.months).flat().map((e) => e.section).filter(Boolean),
)] as string[]);

const counts = computed(() => current.value.reduce<Record<string, number>>((acc, e) => {
    if (e.section) acc[e.section] = (acc[e.section] ?? 0) + 1;

    return acc;
}, {}));

const visible = computed(() => (section.value
    ? current.value.filter((e) => e.section === section.value)
    : current.value));

/* Раздела может не быть на другой вкладке — тогда возвращаем «Все»,
   иначе человек видит пустой список и думает, что встреч нет. */
watch(active, () => {
    if (section.value && !counts.value[section.value]) {
        section.value = '';
    }
});

/** «Осталось 4 места»: голые «4 из 10» людям ничего не говорили. */
const seats = (e: IEvent) => {
    if (!e.seats_total) return e.seats ?? '';

    const left = e.seats_left ?? 0;

    if (!left) return 'Мест нет';

    const tail = left % 10 === 1 && left % 100 !== 11 ? 'место'
        : (left % 10 >= 2 && left % 10 <= 4 && (left % 100 < 10 || left % 100 >= 20) ? 'места' : 'мест');

    return `Осталось ${left} ${tail}`;
};

const lastSeats = (e: IEvent) => !!e.seats_total && (e.seats_left ?? 0) <= 2;

/** «Через 4 дня», «Завтра», «Сегодня» — или что встреча уже прошла. */
const countdown = (e: IEvent) => {
    if (!e.date) return '';

    const days = Math.round((new Date(e.date).setHours(0, 0, 0, 0) - today.getTime()) / 86400000);

    if (days < 0) return 'Встреча прошла';
    if (days === 0) return 'Сегодня';
    if (days === 1) return 'Завтра';
    if (days > 30) return '';

    const tail = days % 10 === 1 && days % 100 !== 11 ? 'день'
        : (days % 10 >= 2 && days % 10 <= 4 && (days % 100 < 10 || days % 100 >= 20) ? 'дня' : 'дней');

    return `Через ${days} ${tail}`;
};

/** Адрес страницы встречи. */
const link = (e: IEvent) => (e.slug ? `/events/${e.slug}.html` : undefined);

const money = (n: number) => formatPrice(n);
</script>
