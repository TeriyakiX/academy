<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\CrmClient;
use Illuminate\Console\Command;

/**
 * Каталог из CRM в витрину сайта.
 *
 * Товары ведёт школа в CRM, но витрине нужны фильтры, сортировка и
 * постраничный вывод по базе — поэтому не ходим в CRM на каждый запрос,
 * а раскладываем её каталог в свои таблицы. Сопоставление идёт по адресу
 * страницы: правка в CRM обновляет позицию, а не создаёт вторую.
 *
 * Позиции, которых в CRM больше нет, со страниц убираются (is_active),
 * но не удаляются: адреса остаются живыми, пока их не уберут руками.
 */
class CatalogSyncCommand extends Command
{
    protected $signature = 'site:catalog-sync';

    protected $description = 'Забрать каталог оборудования из CRM';

    public function handle(CrmClient $crm): int
    {
        if (!$crm->enabled()) {
            $this->warn('CRM не настроена: CRM_API_URL пуст.');

            return self::SUCCESS;
        }

        $data = $crm->cached('catalog');

        if (!$data || empty($data['products'])) {
            $this->warn('CRM не отдала каталог — витрина осталась прежней.');

            return self::SUCCESS;
        }

        $ids = [];

        foreach ($data['categories'] ?? [] as $category) {
            $ids[$category['slug']] = ProductCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'title'       => $category['title'],
                    'description' => $category['description'] ?? null,
                    'sort'        => $category['sort'] ?? 100,
                ]
            )->id;
        }

        $seen = [];

        foreach ($data['products'] as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'product_category_id' => $ids[$product['category'] ?? ''] ?? null,
                    'sku'           => $product['sku'] ?? null,
                    'brand'         => $product['brand'] ?? null,
                    'title'         => $product['title'],
                    'summary'       => $product['summary'] ?? null,
                    'description'   => $product['description'] ?? null,
                    'variant_group' => $product['variant_group'] ?? null,
                    'color'         => $product['color'] ?? null,
                    'price'         => $product['price'] ?? null,
                    'old_price'     => $product['old_price'] ?? null,
                    'image'         => $product['image'] ?? null,
                    'gallery'       => $product['gallery'] ?? null,
                    'specs'         => $product['specs'] ?? null,
                    'is_active'     => true,
                    'sort'          => $product['sort'] ?? 100,
                ]
            );

            $seen[] = $product['slug'];
        }

        $hidden = Product::whereNotIn('slug', $seen)->where('is_active', true)->update(['is_active' => false]);

        $this->info('Разделов: ' . count($ids) . ', товаров: ' . count($seen) . ', скрыто: ' . $hidden . '.');

        return self::SUCCESS;
    }
}
