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
        Schema::create('serials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('counter')->nullable();
            $table->string('name', 20)->nullable();
            $table->string('prefix', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serials');
    }
};
