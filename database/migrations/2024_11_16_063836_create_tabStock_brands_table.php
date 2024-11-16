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
        Schema::create('tabStock_brands', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 45)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 100)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabStock_brands');
    }
};
