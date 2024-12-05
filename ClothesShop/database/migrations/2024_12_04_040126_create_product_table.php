<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Product', function (Blueprint $table) {
            $table->id('product_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('product_name');
            $table->text('product_description');
            $table->decimal('product_price', 10, 2);
            $table->string('product_image');
            $table->boolean('product_status');
            $table->timestamps();

            $table->foreign('category_id')->references('cat_id')->on('category_product');
            $table->foreign('brand_id')->references('brand_id')->on('brand_product');
        });
        DB::statement('ALTER TABLE product ADD CONSTRAINT ck_product_price CHECK (product_price>=0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE product DROP CONSTRAINT ck_product_price');
        Schema::dropIfExists('Product');
    }
};
