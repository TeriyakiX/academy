<template>
    <div class="ab-cw">
        <!-- Полоса шагов: видно, сколько осталось и куда можно вернуться -->
        <ol class="ab-cw__steps">
            <li
                v-for="s in steps"
                :key="s.n"
                class="ab-cw__step"
                :class="{ 'is-active': step === s.n, 'is-done': step > s.n }"
            >
                <button
                    class="ab-cw__step-btn"
                    type="button"
                    :disabled="s.n > maxReached"
                    @click="goTo(s.n)"
                >
                    <span class="ab-cw__step-n">
                        <svg v-if="step > s.n" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m5 12 5 5L20 7" fill="none" stroke="currentColor"
                                  stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <template v-else>{{ s.n }}</template>
                    </span>
                    <span class="ab-cw__step-text">
                        <b>{{ s.title }}</b>
                        <i>{{ s.note }}</i>
                    </span>
                </button>
            </li>
        </ol>

        <div class="ab-cw__body">
            <!-- ШАГ 1. Программы -->
            <section v-show="step === 1" class="ab-cw__pane">
                <div class="ab-cw__tabs">
                    <button
                        v-for="school in schoolNames"
                        :key="school"
                        class="ab-cw__tab"
                        :class="{ 'is-active': school === activeSchool }"
                        type="button"
                        @click="activeSchool = school"
                    >
                        {{ school }}
                        <span v-if="countIn(school)" class="ab-cw__tab-badge">{{ countIn(school) }}</span>
                    </button>
                </div>

                <ul class="ab-cw__list">
                    <li v-for="course in schools[activeSchool]" :key="course.id">
                        <label class="ab-cw__course" :class="{ 'is-picked': isPicked(course.id) }">
                            <input
                                class="ab-cw__check"
                                type="checkbox"
                                :checked="isPicked(course.id)"
                                @change="toggle(course)"
                            >

                            <span class="ab-cw__course-main">
                                <span class="ab-cw__course-title">{{ course.title }}</span>
                                <span class="ab-cw__course-meta">
                                    <span v-if="course.duration">{{ course.duration }}</span>
                                    <span v-if="course.format"> · {{ course.format }}</span>
                                </span>
                            </span>

                            <span class="ab-cw__course-price">{{ money(course.price) }}</span>
                        </label>
                    </li>
                </ul>
            </section>

            <!-- ШАГ 2. Кому -->
            <section v-show="step === 2" class="ab-cw__pane">
                <p class="ab-cw__hint">
                    Эти данные впишем в сертификат. Любое поле можно оставить пустым —
                    тогда выпишем сертификат на предъявителя.
                </p>

                <div class="ab-cw__fields">
                    <label class="ab-cw__field">
                        <span>Кому</span>
                        <input v-model.trim="recipient.name" type="text" placeholder="Имя получателя" maxlength="60">
                    </label>

                    <label class="ab-cw__field">
                        <span>От кого</span>
                        <input v-model.trim="recipient.from" type="text" placeholder="Ваше имя" maxlength="60">
                    </label>

                    <label class="ab-cw__field ab-cw__field--wide">
                        <span>Пожелание <i>— необязательно</i></span>
                        <textarea v-model.trim="recipient.wish" rows="2"
                                  placeholder="Короткая подпись на сертификате" maxlength="160"></textarea>
                    </label>
                </div>
            </section>

            <!-- ШАГ 3. Контакты и отправка -->
            <section v-show="step === 3" class="ab-cw__pane">
                <p class="ab-cw__hint">
                    Перезвоним в рабочее время, уточним детали и пришлём сертификат.
                </p>

                <!--
                    Обычная форма на тот же адрес, что и все заявки сайта:
                    сервер её уже принимает, проверяет и отправляет менеджеру.
                -->
                <form class="ab-cw__form" method="post" action="/lead">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="loaded_at" :value="loadedAt">
                    <input type="hidden" name="source" value="Подарочный сертификат">
                    <input type="hidden" name="page" :value="page">
                    <input type="hidden" name="courses" :value="summary">

                    <!-- ловушка для автоматических отправок -->
                    <div class="ab-guard" aria-hidden="true">
                        <label>
                            Не заполняйте это поле
                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                        </label>
                    </div>

                    <div class="ab-cw__fields">
                        <label class="ab-cw__field">
                            <span>Как вас зовут</span>
                            <input type="text" name="name" placeholder="Имя" required autocomplete="name">
                        </label>

                        <label class="ab-cw__field">
                            <span>Телефон</span>
                            <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required autocomplete="tel">
                        </label>

                        <label class="ab-cw__field ab-cw__field--wide">
                            <span>Комментарий <i>— необязательно</i></span>
                            <textarea name="comment" rows="2" placeholder="Когда нужен сертификат"></textarea>
                        </label>
                    </div>

                    <button class="ab-btn ab-btn--primary ab-btn--lg ab-btn--block" type="submit">
                        Отправить заявку
                    </button>

                    <p class="ab-cw__note">
                        Нажимая кнопку, вы соглашаетесь с
                        <a href="/privacy-policy.html" target="_blank">политикой конфиденциальности</a>
                    </p>
                </form>
            </section>
        </div>

        <!-- Итог: виден на каждом шаге, поэтому выбор не теряется из виду -->
        <aside class="ab-cw__total">
            <p v-if="!picked.length" class="ab-cw__empty">
                Выберите программу — стоимость появится здесь.
            </p>

            <template v-else>
                <ul class="ab-cw__chosen">
                    <li v-for="c in picked" :key="c.id">
                        <button class="ab-cw__remove" type="button" :aria-label="`Убрать ${c.title}`"
                                @click="toggle(c)">
×
</button>
                        <span>{{ c.title }}</span>
                        <b>{{ money(c.price) }}</b>
                    </li>
                </ul>

                <p v-if="nextStep" class="ab-cw__upsell">
                    Добавьте ещё {{ nextStep.need }} — скидка вырастет до {{ nextStep.percent }}%
                </p>

                <div class="ab-cw__sum">
                    <span>Итого</span>
                    <span class="ab-cw__sum-value">
                        <s v-if="selection.discount">{{ money(selection.total) }}</s>
                        <b>{{ money(selection.final) }}</b>
                    </span>
                </div>

                <p v-if="selection.discount" class="ab-cw__saved">
                    Скидка {{ selection.discount }}% — экономия {{ money(selection.total - selection.final) }}
                </p>
            </template>

            <div class="ab-cw__nav">
                <button v-if="step > 1" class="ab-btn ab-btn--outline" type="button" @click="back">
                    Назад
                </button>
                <button
                    v-if="step < 3"
                    class="ab-btn ab-btn--primary"
                    type="button"
                    :disabled="!picked.length"
                    @click="next"
                >
                    {{ step === 1 ? 'К оформлению' : 'К контактам' }}
                </button>
            </div>

            <!-- Второй шаг необязательный, поэтому из него виден выход дальше -->
            <button v-if="step === 2" class="ab-cw__skip" type="button" @click="next">
                Пропустить — сертификат на предъявителя
            </button>

            <!-- На третьем шаге кнопки «дальше» нет: заявку отправляет форма
                 слева. Без подсказки шаг выглядит тупиком. -->
            <p v-if="step === 3" class="ab-cw__last">
                Остался последний шаг: заполните имя и телефон в форме — и мы перезвоним.
            </p>
        </aside>
    </div>
</template>

<script setup lang="ts">
import { computed, reactive, ref, watch } from 'vue';
import CourseService from '@/modules/course/services/CourseService';
import { formatPrice } from '@/shared/utils';

const props = defineProps<{
    schools: TSchools;
    discounts: TDiscountTiers;
    /** Токен формы и метка времени приходят из Blade: их выдаёт сервер. */
    token: string;
    loadedAt: string;
    page: string;
}>();

/* Выбор переживает перезагрузку: человек уходит читать про курс и возвращается. */
const STORAGE_KEY = 'ab-certificate';

const steps = [
    { n: 1 as const, title: 'Программа', note: 'что дарим' },
    { n: 2 as const, title: 'Кому', note: 'подпись в сертификате' },
    { n: 3 as const, title: 'Контакты', note: 'как с вами связаться' },
];

const step = ref<TCertificateStep>(1);
const maxReached = ref<TCertificateStep>(1);

const schoolNames = computed(() => Object.keys(props.schools));
const activeSchool = ref(schoolNames.value[0]);

const pickedIds = ref<TCourseId[]>(restore());

const recipient = reactive<ICertificateRecipient>({ name: '', from: '', wish: '' });

function restore(): TCourseId[] {
    try {
        const raw = localStorage.getItem(STORAGE_KEY);
        return raw ? JSON.parse(raw) : [];
    } catch {
        return [];
    }
}

watch(pickedIds, (ids) => {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(ids));
    } catch { /* приватный режим — молча пропускаем */ }
}, { deep: true });

const allCourses = computed<ICourse[]>(() => Object.values(props.schools).flat());

const picked = computed<ICourse[]>(() =>
    pickedIds.value
        .map((id) => allCourses.value.find((c) => c.id === id))
        .filter((c): c is ICourse => Boolean(c)),
);

const isPicked = (id: TCourseId) => pickedIds.value.includes(id);

function toggle(course: ICourse) {
    pickedIds.value = isPicked(course.id)
        ? pickedIds.value.filter((id) => id !== course.id)
        : [...pickedIds.value, course.id];
}

const countIn = (school: TSchool) => props.schools[school].filter((c) => isPicked(c.id)).length;

/* Деньги считает тот же сервис, что и конструктор курсов. */
const selection = computed<ICourseSelection>(() =>
    CourseService.calculate(picked.value, props.schools, props.discounts),
);

const nextStep = computed(() => CourseService.nextDiscount(picked.value.length, props.discounts));

const money = (n: number) => formatPrice(n);

/** Что уйдёт менеджеру в заявке. */
const summary = computed(() => {
    const list = picked.value.map((c) => c.title).join(' + ');
    const price = money(selection.value.final);
    const sale = selection.value.discount ? ` со скидкой ${selection.value.discount}%` : '';

    const to = recipient.name ? `. Кому: ${recipient.name}` : '';
    const from = recipient.from ? `. От: ${recipient.from}` : '';
    const wish = recipient.wish ? `. Пожелание: ${recipient.wish}` : '';

    return `Сертификат — ${list} — ${price}${sale}${to}${from}${wish}`;
});

function goTo(n: number) {
    if (n > maxReached.value) return;
    step.value = n as TCertificateStep;
}

function next() {
    if (step.value === 1 && !picked.value.length) return;

    step.value = (step.value + 1) as TCertificateStep;
    if (step.value > maxReached.value) maxReached.value = step.value;
}

function back() {
    step.value = (step.value - 1) as TCertificateStep;
}
</script>
