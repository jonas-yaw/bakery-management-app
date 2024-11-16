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
        Schema::create('tabStock_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 140)->nullable();
            $table->string('barcode', 140)->nullable();
            $table->string('item', 140)->nullable();
            $table->string('category', 140)->nullable();
            $table->string('brand', 140)->nullable();
            $table->string('restock_limit', 140)->nullable();
            $table->string('quantity', 140)->nullable();
            $table->string('size', 140)->nullable();
            $table->decimal('price_per_unit', 10)->nullable();
            $table->decimal('cost_price_per_unit', 10)->nullable();
            $table->text('image')->nullable();
            $table->string('supplier', 140)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 140)->nullable();
            $table->dateTime('updated_on')->nullable()->index('modified');
            $table->string('updated_by', 140)->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->fullText(['barcode', 'item'], 'barcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabStock_entry');
    }
};
