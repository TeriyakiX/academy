<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/*
 | Каталог оборудования.
 |
 | Адреса новые, к старому сайту отношения не имеют, поэтому расширение .html
 | здесь взято только ради единообразия со всеми остальными страницами.
 */
class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $categories = ProductCategory::orderBy('sort')->orderBy('title')->get();

        $active = $request->query('category');
        $current = $active ? $categories->firstWhere('slug', $active) : null;

        /*
         | Заказчик просил выбирать сначала производителя, а уже потом
         | тип оборудования. Список брендов собираем из самого каталога,
         | чтобы он не расходился с товарами.
         */
        /* Считаем позиции под каждый фильтр, чтобы человек видел,
           сколько найдётся, ещё до нажатия. Цветовые исполнения
           считаем за одну карточку — как они и показываются. */
        $all = Product::active()->get();
        $cards = fn ($items) => $items->unique(fn ($p) => $p->variant_group ?: 'p' . $p->id)->count();

        $brands = $all->pluck('brand')->filter()->unique()->sort()->values();

        $brand = $request->query('brand');
        if ($brand && !$brands->contains($brand)) {
            $brand = null;
        }

        $products = Product::active()
            ->when($brand, fn ($q) => $q->where('brand', $brand))
            ->when($current, fn ($q) => $q->where('product_category_id', $current->id))
            ->orderBy('sort')->orderBy('title')
            ->get()
            /* Цветовые исполнения одной модели показываем одной карточкой:
               выбор цвета — уже внутри товара. */
            ->unique(fn ($p) => $p->variant_group ?: 'p' . $p->id)
            ->values();

        /* Показываем каталог порциями: 24 карточки за раз.
           Кнопка «Показать ещё» добавляет следующую порцию, а адрес
           страницы остаётся рабочим и без JavaScript. */
        $perPage = 24;
        $shown = (int) $request->query('show', $perPage);
        $shown = max($perPage, min($shown, $products->count()));
        $total = $products->count();
        $products = $products->take($shown);

        return view('pages.shop', [
            'seo' => [
                'title'       => $this->pageTitle($brand, $current),
                'description' => 'Профессиональные кофемашины, кофемолки и аксессуары для кофеен. '
                    . 'То же оборудование, на котором проходит обучение в Академии Бариста.',
                'canonical'   => 'https://academy-barista.ru/shop.html',
                'body_attrs'  => ['class' => 'body'],
                'css'         => [],
                'js'          => [],
                // страницы фильтра не должны плодить дубли в поиске
                'robots'      => ($current || $brand) ? 'noindex, follow' : '',
            ],
            'categories' => $categories,
            'current'    => $current,
            'brands'     => $brands,
            'brandCounts' => $brands->mapWithKeys(fn ($b) => [$b => $cards(
                $all->where('brand', $b)->when($current, fn ($c) => $c->where('product_category_id', $current->id))
            )]),
            'catCounts'  => $categories->mapWithKeys(fn ($c) => [$c->slug => $cards(
                $all->where('product_category_id', $c->id)->when($brand, fn ($q) => $q->where('brand', $brand))
            )]),
            'allCount'   => $cards($all),
            'brand'      => $brand,
            'products'   => $products,
            'total'      => $total,
            'shown'      => $shown,
            'perPage'    => $perPage,
        ]);
    }

    /** Заголовок страницы с учётом выбранных производителя и раздела. */
    private function pageTitle(?string $brand, $current): string
    {
        if ($brand && $current) {
            return $current->title . ' ' . $brand . ' — купить в Академии Бариста';
        }
        if ($brand) {
            return 'Оборудование ' . $brand . ' — купить в Академии Бариста';
        }
        if ($current) {
            return $current->title . ' — купить в Академии Бариста';
        }

        return 'Оборудование для кофеен — каталог Академии Бариста';
    }

    public function show(string $slug): View
    {
        $product = Product::active()->with('category')->where('slug', $slug)->firstOrFail();

        /* Другие цвета этой же модели — для переключателя на странице. */
        $variants = $product->variant_group
            ? Product::active()->where('variant_group', $product->variant_group)
                ->orderBy('sort')->get()
            : collect();

        $similar = Product::active()
            ->where('id', '!=', $product->id)
            ->when($product->variant_group,
                fn ($q) => $q->where(fn ($w) => $w->whereNull('variant_group')
                    ->orWhere('variant_group', '!=', $product->variant_group)))
            ->when($product->product_category_id,
                fn ($q) => $q->where('product_category_id', $product->product_category_id))
            ->orderBy('sort')->get()
            ->unique(fn ($p) => $p->variant_group ?: 'p' . $p->id)
            ->take(10);

        return view('pages.product', [
            'seo' => [
                'title'       => $product->title . ' — купить в Академии Бариста',
                'description' => $product->summary
                    ?: mb_substr((string) $product->description, 0, 200),
                'canonical'   => 'https://academy-barista.ru' . $product->url,
                'og_image'    => $product->image,
                'body_attrs'  => ['class' => 'body'],
                'css'         => [],
                'js'          => [],
            ],
            'product'  => $product,
            'variants' => $variants,
            'similar'  => $similar,
        ]);
    }
}
