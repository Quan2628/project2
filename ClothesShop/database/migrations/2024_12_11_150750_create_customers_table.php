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
        Schema::create('Customer', function (Blueprint $table) {
            $table->id('cus_id');
            $table->string('cus_name');
            $table->string('cus_email');
            $table->string('cus_password');
            $table->string('cus_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Customer');
    }
};
