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
        Schema::create('order', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('shipping_id');
            $table->unsignedBigInteger('payment_id');
            $table->decimal('order_total', 10, 2);
            $table->string('order_status');
            $table->timestamps();

            $table->foreign('customer_id')->references('cus_id')->on('customer');
            $table->foreign('shipping_id')->references('shipping_id')->on('shipping');
            $table->foreign('payment_id')->references('payment_id')->on('payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
