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
        Schema::create('customer_new', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_number', 20)->nullable()->index('account_number_2');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('fullname')->nullable();
            $table->string('gender', 6)->nullable();
            $table->string('postal_address')->nullable();
            $table->string('residential_address')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->string('mobile_number', 100)->nullable();
            $table->string('mobile_number_2', 11)->nullable();
            $table->string('mobile_number_3', 11)->nullable();
            $table->text('field_of_activity')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('id_type', 50)->nullable();
            $table->string('id_number', 50)->nullable();
            $table->string('sales_channel', 30)->nullable();
            $table->string('account_type', 50)->nullable();
            $table->string('branch', 50)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 50)->nullable()->index('created_by');
            $table->dateTime('updated_on')->nullable();
            $table->string('update_by', 50)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->string('status', 10)->nullable()->default('');
            $table->string('account_manager', 100)->nullable();
            $table->integer('updated_by')->nullable();
            $table->text('communication_channel')->nullable();
            $table->string('title', 20)->nullable();
            $table->string('religion', 100)->nullable();
            $table->string('customer_level', 100)->nullable();

            $table->index(['account_number', 'id', 'fullname'], 'account_number');
            $table->fullText(['first_name', 'last_name', 'account_number', 'mobile_number'], 'first_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_new');
    }
};
