<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
 | Товары: оборудование и расходники, которые школа продаёт и на которых учит.
 |
 | Цена хранится одна — розничная. Дилерские цены из прайса поставщика
 | на сайт не попадают, это внутренняя коммерческая информация.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->unsignedSmallInteger('sort')->default(100);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->nullable()
                  ->constrained()->nullOnDelete();

            $table->string('slug')->unique();
            $table->string('sku')->nullable()->index();   // артикул поставщика
            $table->string('brand')->nullable()->index();
            $table->string('title');
            $table->string('summary')->nullable();        // короткое описание в карточку каталога
            $table->text('description')->nullable();      // полный текст на странице товара

            $table->unsignedInteger('price')->nullable(); // розничная цена, ₽
            $table->unsignedInteger('old_price')->nullable();
            $table->string('availability')->default('in_stock'); // in_stock | on_order | out_of_stock
            $table->unsignedSmallInteger('stock')->nullable();

            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('specs')->nullable();            // [['Параметр', 'Значение'], ...]

            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort')->default(100);
            $table->timestamps();

            $table->index(['is_active', 'sort']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_categories');
    }
};
