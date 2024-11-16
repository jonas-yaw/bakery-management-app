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
        Schema::create('tabStock_entry_sizes_and_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 140)->nullable();
            $table->string('uom', 140)->nullable();
            $table->string('size', 140)->nullable();
            $table->decimal('price_per_unit', 10)->nullable();
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
        Schema::dropIfExists('tabStock_entry_sizes_and_prices');
    }
};
