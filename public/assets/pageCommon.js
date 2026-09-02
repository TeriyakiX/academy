/* Общая инициализация шапки и футера для новых страниц.
   Импортирует те же модули, что и страничные бандлы сайта. */
import "./modulepreload-polyfill.js";
import { h as headerScroll, m as footerAccordion, a as accordionInit } from "./accordion-footer.js";
import { t as mobileMenu } from "./mobile-menu.js";
import { m as mobileMenuAccordion } from "./mobile-menu-accordion.js";

headerScroll();
mobileMenu();
mobileMenuAccordion();
footerAccordion();
accordionInit();
