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

        $products = Product::active()
            ->when($current, fn ($q) => $q->where('product_category_id', $current->id))
            ->orderBy('sort')->orderBy('title')
            ->get();

        return view('pages.shop', [
            'seo' => [
                'title'       => $current
                    ? $current->title . ' — купить в Академии Бариста'
                    : 'Оборудование для кофеен — каталог Академии Бариста',
                'description' => 'Профессиональные кофемашины, кофемолки и аксессуары для кофеен. '
                    . 'То же оборудование, на котором проходит обучение в Академии Бариста.',
                'canonical'   => 'https://academy-barista.ru/shop.html',
                'body_attrs'  => ['class' => 'body'],
                'css'         => [],
                'js'          => [],
                // страницы фильтра не должны плодить дубли в поиске
                'robots'      => $current ? 'noindex, follow' : '',
            ],
            'categories' => $categories,
            'current'    => $current,
            'products'   => $products,
        ]);
    }

    public function show(string $slug): View
    {
        $product = Product::active()->with('category')->where('slug', $slug)->firstOrFail();

        $similar = Product::active()
            ->where('id', '!=', $product->id)
            ->when($product->product_category_id,
                fn ($q) => $q->where('product_category_id', $product->product_category_id))
            ->orderBy('sort')->limit(3)->get();

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
            'product' => $product,
            'similar' => $similar,
        ]);
    }
}
