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
        Schema::create('units_of_measurement', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 100)->nullable();
            $table->string('size', 100)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 200)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units_of_measurement');
    }
};
