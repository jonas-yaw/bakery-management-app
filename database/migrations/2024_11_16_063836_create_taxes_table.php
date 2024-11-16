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
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tax', 11)->nullable();
            $table->string('period', 11)->nullable();
            $table->decimal('broker', 15, 3)->nullable();
            $table->decimal('agent', 15, 3)->nullable();
            $table->decimal('sticker', 15, 3)->nullable();
            $table->decimal('withholding', 15, 3)->nullable();
            $table->decimal('vat', 15, 3)->nullable();
            $table->decimal('NHIL', 15, 3)->nullable()->default(2.5);
            $table->decimal('GetFund', 15, 3)->nullable()->default(2.5);
            $table->decimal('COVID_19_HRL', 15, 3)->nullable()->default(1);
            $table->decimal('fire_levy', 15, 3)->nullable()->default(1);
            $table->string('created_by', 200)->nullable();
            $table->timestamp('created_on')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
