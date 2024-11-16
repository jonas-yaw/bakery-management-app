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
        Schema::create('tabStock_cart', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cart_number', 140)->nullable();
            $table->string('item_code', 140)->nullable();
            $table->string('item', 140)->nullable();
            $table->string('category', 140)->nullable();
            $table->string('quantity', 140)->nullable();
            $table->decimal('price_per_unit', 10)->nullable();
            $table->decimal('sub_total_price', 10)->nullable();
            $table->string('status', 140)->nullable();
            $table->string('invoice_number', 140)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 140)->nullable();
            $table->dateTime('updated_on')->nullable()->index('modified');
            $table->string('updated_by', 140)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabStock_cart');
    }
};
