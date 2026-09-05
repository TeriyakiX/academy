<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

/*
 | Стартовое наполнение каталога.
 |
 | Данные сняты с дилерского прайс-листа Carimali / Elektra / Heylo.
 | ВАЖНО: в открытый доступ идёт только розничная цена (РРЦ) — этого требует
 | сам прайс. Дилерские цены в базу не заносим.
 |
 | Названия моделей и артикулы в прайсе приходят изображением, поэтому здесь
 | стоят описательные заголовки. Их нужно заменить на точные, когда
 | заказчик пришлёт прайс таблицей.
 */
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['slug' => 'rozhkovye-kofemashiny', 'sort' => 10,
             'title' => 'Традиционные рожковые кофемашины',
             'description' => 'Профессиональные эспрессо-машины для кофеен и баров.'],
            ['slug' => 'superavtomaty', 'sort' => 20,
             'title' => 'Суперавтоматические кофемашины',
             'description' => 'Автоматические кофемашины для офисов, отелей и точек самообслуживания.'],
            ['slug' => 'kofemolki', 'sort' => 30,
             'title' => 'Кофемолки',
             'description' => 'Профессиональные кофемолки под эспрессо и альтернативу.'],
            ['slug' => 'aksessuary', 'sort' => 40,
             'title' => 'Аксессуары и расходники',
             'description' => 'Холдеры, корзины, чистящие средства и холодильное оборудование.'],
        ];

        foreach ($categories as $c) {
            ProductCategory::updateOrCreate(['slug' => $c['slug']], $c);
        }

        $rozhok = ProductCategory::where('slug', 'rozhkovye-kofemashiny')->value('id');
        $aks    = ProductCategory::where('slug', 'aksessuary')->value('id');

        $espresso = fn (string $groups, string $boiler) => [
            ['Количество групп', $groups],
            ['Объём бойлера', $boiler],
            ['Управление', 'Автомат, PID-контроль'],
            ['Группы', 'Высокие'],
            ['Дополнительно', 'Система предсмачивания'],
        ];

        $holder = fn (string $type, string $basket) => [
            ['Тип', $type],
            ['Корзина', $basket],
        ];

        $products = [
            [
                'slug'  => 'carimali-1-gruppa-chernaya',
                'brand' => 'Carimali',
                'product_category_id' => $rozhok,
                'title' => 'Рожковая кофемашина, 1 группа, чёрная',
                'summary' => 'Одногруппная автоматическая машина с бойлером 4 л и задней зеркальной панелью.',
                'description' => 'Одногруппная кофемашина с высокими группами и бойлером на 4 литра. '
                    . 'Автоматическое дозирование, PID-контроль температуры, система предсмачивания. '
                    . 'Корпус чёрный, задняя зеркальная панель.',
                'price' => 230000, 'availability' => 'in_stock', 'stock' => 37, 'sort' => 10,
                'specs' => $espresso('1', '4 л'),
            ],
            [
                'slug'  => 'carimali-2-gruppy-chernaya-zerkalnaya',
                'brand' => 'Carimali',
                'product_category_id' => $rozhok,
                'title' => 'Рожковая кофемашина, 2 группы, чёрная (зеркальная панель)',
                'summary' => 'Двухгруппная машина с бойлером 11 л, экраном настройки температур и двойным манометром.',
                'description' => 'Двухгруппная кофемашина с высокими группами и бойлером на 11 литров. '
                    . 'Экран настройки температур, PID-контроль, система предсмачивания, двойной манометр. '
                    . 'В комплекте два холдера: двойной на 18 г и одинарный на 7 г.',
                'price' => 295000, 'availability' => 'in_stock', 'sort' => 20,
                'specs' => $espresso('2', '11 л'),
            ],
            [
                'slug'  => 'carimali-2-gruppy-belaya',
                'brand' => 'Carimali',
                'product_category_id' => $rozhok,
                'title' => 'Рожковая кофемашина, 2 группы, белая',
                'summary' => 'Двухгруппная машина с бойлером 11 л и задней прозрачной панелью.',
                'description' => 'Двухгруппная кофемашина с высокими группами и бойлером на 11 литров. '
                    . 'Экран настройки температур, PID-контроль, система предсмачивания, двойной манометр. '
                    . 'В комплекте два холдера: двойной на 18 г и одинарный на 7 г.',
                'price' => 295000, 'availability' => 'in_stock', 'sort' => 30,
                'specs' => $espresso('2', '11 л'),
            ],
            [
                'slug'  => 'carimali-2-gruppy-tsvetnaya',
                'brand' => 'Carimali',
                'product_category_id' => $rozhok,
                'title' => 'Рожковая кофемашина, 2 группы, цветной корпус',
                'summary' => 'Красный, жёлтый или синий корпус — цвет выбирается при заказе.',
                'description' => 'Двухгруппная кофемашина с высокими группами и бойлером на 11 литров. '
                    . 'Экран настройки температур, PID-контроль, система предсмачивания, двойной манометр. '
                    . 'Доступные цвета корпуса: красный, жёлтый, синий.',
                'price' => 295000, 'availability' => 'on_order', 'sort' => 40,
                'specs' => $espresso('2', '11 л'),
            ],
            [
                'slug'  => 'holder-dvoynoy-nimble-18g',
                'brand' => 'Nimble',
                'product_category_id' => $aks,
                'title' => 'Холдер двойной Nimble в сборе, корзина 18 г',
                'summary' => 'Двойной холдер в сборе с корзиной на 18 грамм.',
                'description' => 'Двойной холдер Nimble в сборе с фильтр-корзиной на 18 грамм. '
                    . 'Подходит для профессиональных рожковых кофемашин.',
                'price' => 6629, 'availability' => 'in_stock', 'sort' => 50,
                'specs' => $holder('Двойной', '18 г'),
            ],
            [
                'slug'  => 'holder-dvoynoy-nimble-14g',
                'brand' => 'Nimble',
                'product_category_id' => $aks,
                'title' => 'Холдер двойной Nimble в сборе, корзина 14 г',
                'summary' => 'Двойной холдер в сборе с корзиной на 14 грамм.',
                'description' => 'Двойной холдер Nimble в сборе с фильтр-корзиной на 14 грамм.',
                'price' => 6544, 'availability' => 'in_stock', 'sort' => 60,
                'specs' => $holder('Двойной', '14 г'),
            ],
            [
                'slug'  => 'holder-odinarnyy-nimble-7g',
                'brand' => 'Nimble',
                'product_category_id' => $aks,
                'title' => 'Холдер одинарный Nimble в сборе, корзина 7 г',
                'summary' => 'Одинарный холдер в сборе с корзиной на 7 грамм.',
                'description' => 'Одинарный холдер Nimble в сборе с фильтр-корзиной на 7 грамм.',
                'price' => 5993, 'availability' => 'in_stock', 'sort' => 70,
                'specs' => $holder('Одинарный', '7 г'),
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['slug' => $p['slug']], $p);
        }
    }
}
