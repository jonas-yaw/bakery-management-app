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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ref_id')->nullable();
            $table->string('email')->nullable()->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('username')->index('ix_user');
            $table->string('password', 60);
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->string('fullname')->nullable();
            $table->string('location')->nullable();
            $table->string('usertype')->nullable();
            $table->string('assigned_agent', 150)->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamp('created_at')->default('2021-12-01 01:00:00');
            $table->string('created_by', 150)->nullable();
            $table->timestamp('updated_at')->default('2021-12-01 01:00:00');
            $table->string('session_id')->nullable();
            $table->string('signature')->nullable();
            $table->string('allow_credit', 3)->nullable()->default('No');
            $table->string('status', 50)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->boolean('active_status')->default(false);
            $table->string('avatar')->default('avatar.png');
            $table->boolean('dark_mode')->default(false);
            $table->string('messenger_color')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('title', 50)->nullable();
            $table->string('manager', 200)->nullable();
            $table->string('designation', 200)->nullable();
            $table->dateTime('last_password_reset_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
