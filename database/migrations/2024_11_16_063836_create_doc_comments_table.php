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
        Schema::create('doc_comments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('doc_type', 100)->nullable();
            $table->string('doc_number', 200)->nullable();
            $table->text('comment')->nullable();
            $table->string('created_by', 200)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('updated_by', 200)->nullable();
            $table->string('receipient', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_comments');
    }
};
