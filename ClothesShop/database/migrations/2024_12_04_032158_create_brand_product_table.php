<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Brand_Product', function (Blueprint $table) {
            $table->id('brand_id');
            $table->string('brand_name');
            $table->text('brand_description');
            $table->boolean('brand_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Brand_Product');
    }
};
