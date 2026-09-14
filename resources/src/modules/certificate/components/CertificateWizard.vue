<template>
    <div class="ab-cw">
        <!-- Полоса шагов: видно, сколько осталось и куда можно вернуться -->
        <ol class="ab-cw__steps">
            <li
                v-for="s in steps"
                :key="s.n"
                class="ab-cw__step"
                :class="{ 'is-active': step === s.n, 'is-done': step !== s.n && filled(s.n) }"
            >
                <button
                    class="ab-cw__step-btn"
                    type="button"
                    :disabled="!canOpen(s.n)"
                    @click="goTo(s.n)"
                >
                    <span class="ab-cw__step-n">
                        <svg v-if="step !== s.n && filled(s.n)" viewBox="0 0 24 24" aria-hidden="true">
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

            <!-- ШАГ 2. Кому дарим и куда звонить — одной формой.
                 Раньше это были два отдельных шага, и «Кому» с «Контактами»
                 путались между собой: непонятно, чьё имя куда. -->
            <section v-show="step === 2" class="ab-cw__pane">
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

                    <p class="ab-cw__legend">Что напишем в сертификате</p>

                    <div class="ab-cw__fields">
                        <label class="ab-cw__field">
                            <span>Кому</span>
                            <input v-model.trim="recipient.name" type="text" placeholder="Имя получателя"
                                   maxlength="60" required>
                        </label>

                        <label class="ab-cw__field">
                            <span>От кого <i>— необязательно</i></span>
                            <input v-model.trim="recipient.from" type="text" placeholder="Ваше имя" maxlength="60">
                        </label>

                        <label class="ab-cw__field ab-cw__field--wide">
                            <span>Пожелание <i>— необязательно</i></span>
                            <textarea v-model.trim="recipient.wish" rows="2"
                                      placeholder="Короткая подпись на сертификате" maxlength="160"></textarea>
                        </label>
                    </div>

                    <p class="ab-cw__legend">Куда вам перезвонить</p>

                    <div class="ab-cw__fields">
                        <label class="ab-cw__field">
                            <span>Как вас зовут</span>
                            <input type="text" name="name" placeholder="Имя" required autocomplete="name"
                                   @input="contact.name = ($event.target as HTMLInputElement).value">
                        </label>

                        <label class="ab-cw__field">
                            <span>Телефон</span>
                            <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required autocomplete="tel"
                                   @input="contact.phone = ($event.target as HTMLInputElement).value">
                        </label>

                        <label class="ab-cw__field ab-cw__field--wide">
                            <span>Комментарий <i>— необязательно</i></span>
                            <textarea name="comment" rows="2" placeholder="Когда нужен сертификат"></textarea>
                        </label>
                    </div>

                    <!-- Кнопка серая, пока не заполнено всё обязательное:
                         имя получателя, ваше имя и телефон. -->
                    <button class="ab-btn ab-btn--primary ab-btn--lg ab-btn--block" type="submit"
                            :disabled="!canSend">
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
                <button v-if="step === 2" class="ab-btn ab-btn--outline" type="button" @click="back">
                    Назад
                </button>
                <button
                    v-if="step === 1"
                    class="ab-btn ab-btn--primary"
                    type="button"
                    :disabled="!picked.length"
                    @click="next"
                >
                    К оформлению
                </button>
            </div>

            <!-- Пока не из чего собирать сертификат, кнопка серая — говорим почему. -->
            <p v-if="step === 1 && !picked.length" class="ab-cw__last">
                Выберите хотя бы одну программу.
            </p>

            <p v-else-if="step === 2 && !canSend" class="ab-cw__last">
                Заполните имя получателя, ваше имя и телефон — тогда кнопка отправки станет активной.
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
    { n: 1 as const, title: 'Что дарим', note: 'программы и стоимость' },
    { n: 2 as const, title: 'Кому и куда звонить', note: 'подпись и ваши контакты' },
];

const step = ref<TCertificateStep>(1);

const schoolNames = computed(() => Object.keys(props.schools));
const activeSchool = ref(schoolNames.value[0]);

const pickedIds = ref<TCourseId[]>(restore());

const recipient = reactive<ICertificateRecipient>({ name: '', from: '', wish: '' });

/* Контакты держим отдельно: поля остаются обычными полями формы,
   а нам нужно знать, можно ли уже включать кнопку отправки. */
const contact = reactive({ name: '', phone: '' });

/* Отправка доступна, когда собрано всё нужное: программа, имя
   получателя и контакты. Иначе менеджеру придёт нечего обрабатывать. */
const canSend = computed(
    () => picked.value.length > 0 && recipient.name.length > 0 && contactReady.value,
);

const contactReady = computed(
    /* 10 цифр — номер без кода страны, 11 — уже с ним: маска дорисовывает
       «+7» после нашего обработчика, поэтому считаем от десяти. */
    () => contact.name.trim().length > 1 && contact.phone.replace(/\D/g, '').length >= 10,
);

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

/*
 | Шаг считается пройденным по данным, а не по тому, что его открывали:
 | иначе можно прощёлкать мастер насквозь и отправить пустой сертификат.
 */
function filled(n: number): boolean {
    if (n === 1) return picked.value.length > 0;

    return canSend.value;
}

/** Ко второму шагу пускаем только с выбранной программой. */
function canOpen(n: number): boolean {
    return n === 1 || picked.value.length > 0;
}

function goTo(n: number) {
    if (!canOpen(n)) return;
    step.value = n as TCertificateStep;
}

function next() {
    if (!picked.value.length) return;
    step.value = 2;
}

/* Если все программы сняли, возвращаем на первый шаг: дальше идти не с чем. */
watch(() => picked.value.length, (n) => { if (!n) step.value = 1; });

function back() {
    step.value = 1;
}
</script>
