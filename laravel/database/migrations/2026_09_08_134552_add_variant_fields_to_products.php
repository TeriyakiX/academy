<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
 | Цветовые исполнения одной модели.
 |
 | В прайсе каждый цвет идёт отдельной позицией: GLOW E2 BLACK, WHITE, GREY.
 | В каталоге это одна карточка с выбором цвета, поэтому позиции связываем
 | через variant_group, а сам цвет храним отдельно.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('variant_group')->nullable()->index()->after('slug');
            $table->string('color')->nullable()->after('variant_group');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['variant_group', 'color']);
        });
    }
};
