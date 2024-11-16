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
        Schema::create('email_audit_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from');
            $table->string('to');
            $table->string('cc')->nullable();
            $table->string('subject');
            $table->longText('body');
            $table->string('attachments')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_audit_log');
    }
};
