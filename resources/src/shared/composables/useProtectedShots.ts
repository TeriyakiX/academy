/*
 | Защита снимков документов (бланки свидетельства).
 |
 | Полностью запретить сохранение нельзя — остаётся снимок экрана.
 | Задача скромнее: убрать простые способы утащить файл — правый клик
 | по картинке, перетаскивание на рабочий стол и копирование.
 |
 | Основную работу делает прозрачный слой в разметке: указатель не
 | доходит до <img>, поэтому в меню браузера нет «Сохранить картинку».
 | Здесь закрываем остальное.
 */
export function useProtectedShots(): void {
    const shots = document.querySelectorAll<HTMLElement>('.ab-cdoc__shot');

    if (!shots.length) {
        return;
    }

    shots.forEach((shot) => {
        shot.addEventListener('contextmenu', (event) => event.preventDefault());
        shot.addEventListener('dragstart', (event) => event.preventDefault());
    });
}
