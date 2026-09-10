/**
 * Подсчёт стоимости подобранного курса.
 *
 * Логика скидок вынесена из компонента: она не про разметку,
 * а про деньги — её проверяют глазами и правят чаще, чем вёрстку.
 */
class CourseService {
    /** Пороги по возрастанию: {2: 5, 3: 10} → [{count: 2, percent: 5}, …] */
    tiers(discounts: TDiscountTiers): Array<{ count: number; percent: number }> {
        return Object.entries(discounts)
            .map(([count, percent]) => ({ count: Number(count), percent: Number(percent) }))
            .sort((a, b) => a.count - b.count);
    }

    /** Действующая скидка для выбранного количества курсов. */
    discountFor(count: number, discounts: TDiscountTiers): number {
        return this.tiers(discounts).reduce(
            (percent, tier) => (count >= tier.count ? tier.percent : percent),
            0,
        );
    }

    /** Ближайший порог, до которого не хватает курсов. */
    nextDiscount(count: number, discounts: TDiscountTiers): INextDiscount | null {
        const next = this.tiers(discounts).find((tier) => count < tier.count);

        return next ? { need: next.count - count, percent: next.percent } : null;
    }

    /** Полный расчёт по выбранным курсам. */
    calculate(courses: ICourse[], schools: TSchools, discounts: TDiscountTiers): ICourseSelection {
        const total = courses.reduce((sum, course) => sum + course.price, 0);
        const discount = this.discountFor(courses.length, discounts);

        const used = Object.values(schools).filter((list) =>
            list.some((course) => courses.some((chosen) => chosen.id === course.id)),
        ).length;

        return {
            courses,
            schools: used,
            total,
            discount,
            final: Math.round(total * (1 - discount / 100)),
        };
    }
}

export default new CourseService();
