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
        Schema::create('email_subscriptions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('document_type')->nullable();
            $table->string('receipient_email')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by')->nullable();
            $table->integer('is_cc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_subscriptions');
    }
};
