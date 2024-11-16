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
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->nullable();
            $table->string('category', 150)->nullable();
            $table->string('route', 150)->nullable()->default('');
            $table->text('url')->nullable();
            $table->text('url_public')->nullable();
            $table->string('access', 150)->nullable();
            $table->string('created_by', 150)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('updated_by', 150)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('status', 100)->nullable();
            $table->string('permission', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
