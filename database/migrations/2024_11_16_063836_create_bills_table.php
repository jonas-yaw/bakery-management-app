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
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id')->index('id');
            $table->string('invoice_number', 100)->default('')->index('invoice_number');
            $table->string('account_number', 200)->nullable()->index('account_number');
            $table->string('reference', 100)->nullable()->default('Debit');
            $table->string('fullname')->nullable();
            $table->string('type', 50)->nullable()->default('Debit');
            $table->string('invoice_source', 50)->nullable();
            $table->dateTime('invoice_date')->nullable();
            $table->string('branch', 50)->nullable()->index('branch');
            $table->decimal('amount', 20)->default(0);
            $table->string('transaction_type', 50)->nullable()->default('Room Reservation');
            $table->string('product', 50)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('currency', 50)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 200)->nullable()->index('ix_created_by');
            $table->string('payment_status', 20)->nullable()->index('payment_status');
            $table->string('flag', 20)->nullable()->default('Active');
            $table->string('amount_in_words', 1000)->nullable();
            $table->decimal('exchange_rate', 15, 5)->nullable()->default(1);
            $table->decimal('discount_rate', 10, 5)->nullable()->default(0);
            $table->decimal('discount_amount', 10, 5)->nullable()->default(0);
            $table->string('account_type', 100)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->integer('is_editing')->nullable();
            $table->string('editing_by', 150)->nullable();
            $table->dateTime('editing_time')->nullable();

            $table->index(['invoice_number'], 'ix_invoice_number');
            $table->index(['invoice_number'], 'ix_invoice_number_bills');
            $table->primary(['id']);
            $table->index(['fullname', 'invoice_number', 'account_number', 'branch', 'amount', 'transaction_type', 'flag', 'product'], 'unique_cols');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
