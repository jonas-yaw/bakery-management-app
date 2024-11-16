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
        Schema::create('metabase_reports', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 200)->nullable();
            $table->string('link', 200)->nullable();
            $table->string('type', 200)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('html_link', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metabase_reports');
    }
};
