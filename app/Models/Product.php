<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'product_category_id', 'slug', 'variant_group', 'color',
        'sku', 'brand', 'title', 'summary', 'description',
        'price', 'old_price', 'availability', 'stock',
        'image', 'gallery', 'specs', 'is_active', 'sort',
    ];

    protected $casts = [
        'gallery'   => 'array',
        'specs'     => 'array',
        'is_active' => 'boolean',
    ];

    /** Понятные подписи наличия — используются и в каталоге, и в карточке. */
    public const AVAILABILITY = [
        'in_stock'     => 'В наличии',
        'on_order'     => 'Под заказ',
        'out_of_stock' => 'Нет в наличии',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }

    /**
     * Три коротких признака для карточки каталога:
     * длинная строка конфигурации там читается плохо.
     */
    public function getChipsAttribute(): array
    {
        $map = [
            'Количество групп' => fn ($v) => $v . ' ' . ($v == 1 ? 'группа' : ($v <= 4 ? 'группы' : 'групп')),
            'Объём бойлера'    => fn ($v) => 'бойлер ' . $v,
            'Жернова'          => fn ($v) => $v,
            'Бункеров для зерна' => fn ($v) => $v . ' бункера для зерна',
            'Управление'       => fn ($v) => $v,
            'PID-контроль'     => fn () => 'PID-контроль',
        ];

        $chips = [];
        foreach ($map as $key => $format) {
            foreach ($this->specs ?? [] as [$name, $value]) {
                if ($name === $key) { $chips[] = $format($value); break; }
            }
            if (count($chips) >= 3) break;
        }

        return $chips;
    }

    public function getUrlAttribute(): string
    {
        return '/shop/' . $this->slug . '.html';
    }

    public function getAvailabilityLabelAttribute(): string
    {
        return self::AVAILABILITY[$this->availability] ?? 'Уточняйте';
    }

    /** Цена прописью для вёрстки: «230 000 ₽» либо «по запросу». */
    public function getPriceLabelAttribute(): string
    {
        return $this->price
            ? number_format($this->price, 0, ',', ' ') . ' ₽'
            : 'Цена по запросу';
    }

    public function getOldPriceLabelAttribute(): ?string
    {
        return $this->old_price
            ? number_format($this->old_price, 0, ',', ' ') . ' ₽'
            : null;
    }
}
