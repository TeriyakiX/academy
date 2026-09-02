/* Слайдер отзывов. На главной раньше не использовался —
   параметры взяты те же, что на странице сертификатов. */
import { S as Splide } from "./splide.min.js";

new Splide(".reviews__slider", {
    perPage: 2,
    perMove: 1,
    gap: "15px",
    pagination: false,
    arrows: true,
    breakpoints: { 1000: { perPage: 1 } },
}).mount();
