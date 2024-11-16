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
        Schema::create('countries', function (Blueprint $table) {
            $table->string('id', 2)->primary();
            $table->string('name', 64);
            $table->string('plan', 100)->nullable();
            $table->integer('worldwide')->nullable();
            $table->integer('worldwide_1')->nullable();
            $table->integer('schengen')->nullable();
            $table->string('code', 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
