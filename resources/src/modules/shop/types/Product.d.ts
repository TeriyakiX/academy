/*
 | Товары каталога оборудования.
 |
 | Поля повторяют модель Product на сервере: страница товара приходит
 | готовой из Blade, а фронтенду эти типы нужны там, где он работает
 | с данными сам — смена цвета, фильтры, похожие позиции.
 */

type TProductId = number;
type TProductSlug = string;

/** Наличие. Значения совпадают с ключами Product::AVAILABILITY. */
type TAvailability = 'in_stock' | 'on_order' | 'out_of_stock';

interface IProduct {
    id: TProductId;
    slug: TProductSlug;
    /** Общий ключ у цветовых исполнений одной модели. */
    variant_group: string | null;
    color: string | null;
    sku: string | null;
    brand: string | null;
    title: string;
    summary: string | null;
    description: string | null;
    price: number | null;
    old_price: number | null;
    availability: TAvailability;
    image: string | null;
    gallery: string[] | null;
    /** Характеристики: «Количество групп» → «2». */
    specs: Record<string, string> | null;
    /** Короткие метки для карточки каталога. */
    chips: string[];
}

interface IProductCategory {
    id: number;
    slug: string;
    title: string;
    products_count?: number;
}

/** Выбранные в каталоге фильтры. */
interface IShopFilters {
    category?: string;
    brand?: string;
    /** Сколько карточек показывать — «показать ещё» без перезагрузки списка. */
    show?: number;
}
