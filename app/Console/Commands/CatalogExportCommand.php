<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Console\Command;

/**
 * Выгрузка каталога для переноса в CRM.
 *
 * Товары заводились сидером в базе сайта. Чтобы школа вела их сама,
 * каталог переезжает в CRM: эта команда отдаёт его одним json,
 * который на той стороне принимает `site:catalog-import`.
 */
class CatalogExportCommand extends Command
{
    protected $signature = 'site:catalog-export {--file= : куда записать (по умолчанию в вывод)}';

    protected $description = 'Выгрузить каталог оборудования в json для CRM';

    public function handle(): int
    {
        $data = [
            'categories' => ProductCategory::orderBy('sort')
                ->get(['slug', 'title', 'description', 'sort'])
                ->toArray(),

            'products' => Product::with('category:id,slug')
                ->orderBy('sort')
                ->get()
                ->map(fn (Product $p) => [
                    'slug'          => $p->slug,
                    'category'      => $p->category?->slug,
                    'sku'           => $p->sku,
                    'brand'         => $p->brand,
                    'title'         => $p->title,
                    'summary'       => $p->summary,
                    'description'   => $p->description,
                    'variant_group' => $p->variant_group,
                    'color'         => $p->color,
                    'price'         => $p->price,
                    'old_price'     => $p->old_price,
                    'image'         => $p->image,
                    'gallery'       => $p->gallery,
                    'specs'         => $p->specs,
                    'is_active'     => $p->is_active,
                    'sort'          => $p->sort,
                ])
                ->all(),
        ];

        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $file = $this->option('file');

        if ($file) {
            file_put_contents($file, $json);
            $this->info('Записано: ' . $file);

            return self::SUCCESS;
        }

        $this->line($json);

        return self::SUCCESS;
    }
}
