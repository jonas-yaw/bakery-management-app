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
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country', 100)->nullable();
            $table->string('name', 200)->nullable();
            $table->string('legal_name', 200)->nullable();
            $table->string('phone', 50)->nullable();
            $table->integer('fax')->nullable();
            $table->string('email', 50)->nullable();
            $table->string('website', 50)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('office_address', 200)->nullable();
            $table->string('tax_id', 20)->nullable();
            $table->string('company_reg', 20)->nullable();
            $table->decimal('default_tax', 15, 5)->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('logo', 200)->nullable();
            $table->string('document_logo', 100)->nullable();
            $table->string('intro_link', 200)->nullable();
            $table->string('sms_gateway', 150)->nullable();
            $table->string('ussd_code', 10)->nullable();
            $table->string('app_reference_name', 20)->nullable();
            $table->string('url_internal', 20)->nullable();
            $table->string('url_external', 100)->nullable();
            $table->string('metabase_url', 50)->nullable();
            $table->string('metabase_url_external', 50)->nullable();
            $table->string('jasperreport_url', 50)->nullable();
            $table->string('jasperreport_url_external', 50)->nullable();
            $table->string('bulletin_message')->nullable();
            $table->string('company_type', 50)->nullable();
            $table->string('security_layer', 50)->nullable()->default('advanced');
            $table->string('e_proposal_data_id', 50)->nullable();
            $table->string('e_claims_data_id', 50)->nullable();
            $table->string('certificate_template', 50)->nullable();
            $table->string('schedule_template', 50)->nullable();
            $table->string('erp_url', 100)->nullable();
            $table->integer('accounting')->nullable()->default(0);
            $table->string('mapfre_name', 50)->nullable();
            $table->string('document_logo_2', 100)->nullable();
            $table->string('commission_bonus_compute', 3)->nullable()->default('Yes');
            $table->string('erp_company_name', 200)->nullable();
            $table->string('erp_url_external', 100)->nullable();
            $table->string('reservation_currency', 3)->nullable();
            $table->text('motto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
