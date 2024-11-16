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
        Schema::create('exchangerate_new', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 10)->nullable();
            $table->decimal('rate', 6, 4)->nullable();
            $table->string('created_by', 100)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchangerate_new');
    }
};
