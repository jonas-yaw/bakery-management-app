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
        Schema::create('branch_setup', function (Blueprint $table) {
            $table->increments('id');
            $table->string('branch_code', 5)->default('');
            $table->string('branch_prefix', 10)->nullable();
            $table->string('sector', 50)->nullable();
            $table->string('branch_main', 50)->nullable();
            $table->string('branch_name', 100)->nullable();
            $table->string('postal_address', 80)->nullable();
            $table->integer('mobile')->nullable();
            $table->string('region', 20)->nullable();
            $table->integer('clients_count')->nullable()->default(1);
            $table->integer('debit_generation_count')->nullable()->default(1);
            $table->integer('receiptnumber')->nullable()->default(1);
            $table->string('status', 10)->nullable()->default('Active');
            $table->string('created_by', 200)->nullable();
            $table->timestamp('created_on')->nullable();
            $table->softDeletes();
            $table->integer('journalnumber')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_setup');
    }
};
