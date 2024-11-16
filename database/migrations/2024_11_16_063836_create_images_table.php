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
        Schema::create('images', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('reference_number', 45)->nullable();
            $table->string('filename', 200)->nullable();
            $table->string('created_by', 45)->nullable();
            $table->dateTime('created_on')->nullable()->useCurrent();
            $table->text('filepath')->nullable();
            $table->string('mime', 20)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
