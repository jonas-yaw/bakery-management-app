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
        Schema::create('banks_new', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->nullable()->index('name');
            $table->string('prefix', 30)->nullable();
            $table->string('address', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks_new');
    }
};
