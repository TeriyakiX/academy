import { api } from '@/shared/api';

/**
 * Работа с каталогом.
 *
 * Страницы товаров кэшируются в памяти: пользователь щёлкает цвета
 * туда-обратно, и повторно тянуть уже загруженный документ незачем.
 */
class ShopService {
    private readonly pages = new Map<TUrl, Document>();

    /** Страница товара как документ — для подмены части разметки. */
    async fetchProductPage(url: TUrl): Promise<Document> {
        const cached = this.pages.get(url);
        if (cached) return cached;

        const document = await api.document(url);
        this.pages.set(url, document);

        return document;
    }

    /** Собирает адрес каталога с выбранными фильтрами. */
    buildCatalogUrl(filters: IShopFilters, base: TUrl = '/shop.html'): TUrl {
        const query = new URLSearchParams();

        if (filters.category) query.set('category', filters.category);
        if (filters.brand) query.set('brand', filters.brand);
        if (filters.show) query.set('show', String(filters.show));

        const search = query.toString();

        return search ? `${base}?${search}` : base;
    }
}

export default new ShopService();
