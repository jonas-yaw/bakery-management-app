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
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('receipt_type', 50)->nullable();
            $table->string('receipt_number', 50)->default('')->index('ix_receipt_no');
            $table->string('invoice_number', 100)->nullable()->index('invoice_number');
            $table->date('receipt_date')->nullable();
            $table->dateTime('debit_date')->nullable();
            $table->string('currency', 10)->nullable();
            $table->decimal('cost_price_per_unit', 15)->nullable();
            $table->decimal('price_per_unit', 15)->nullable();
            $table->decimal('sub_total_price', 15)->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('amount_paid', 15)->nullable();
            $table->string('collection_mode', 70)->nullable()->index('collection_mode');
            $table->text('reference_number')->nullable();
            $table->string('paid_by', 200)->nullable();
            $table->string('branch', 70)->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('status', 70)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 100)->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('reference', 70)->nullable()->index('policy_number');
            $table->string('product', 200)->nullable();
            $table->string('category')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_mobile_number', 50)->nullable()->default('Pending')->index('commission_status');
            $table->decimal('exchange_rate', 15)->nullable();
            $table->decimal('discount_fee', 15)->nullable()->default(0);
            $table->decimal('delivery_fee', 15)->nullable()->default(0);
            $table->dateTime('deleted_at')->nullable();
            $table->decimal('tendered_amount', 15)->nullable()->default(0);
            $table->decimal('balance', 15)->nullable()->default(0);

            $table->index(['invoice_number'], 'ix_inv_no');
            $table->index(['invoice_number'], 'ix_invoice_number_payments');
            $table->index(['receipt_number'], 'receipt_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
