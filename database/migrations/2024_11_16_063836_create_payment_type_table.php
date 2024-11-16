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
        Schema::create('payment_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 30)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 200)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('updated_by', 200)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_type');
    }
};
