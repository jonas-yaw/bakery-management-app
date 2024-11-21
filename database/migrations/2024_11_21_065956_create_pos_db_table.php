<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 45)->nullable();
        });

        Schema::create('audits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_type')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('event');
            $table->unsignedInteger('auditable_id');
            $table->string('auditable_type');
            $table->text('old_values')->nullable();
            $table->text('new_values')->nullable();
            $table->text('url')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('tags')->nullable();
            $table->timestamps();

            $table->index(['auditable_id', 'auditable_type']);
            $table->index(['user_id', 'user_type']);
        });

        Schema::create('authentication_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('authenticatable_type');
            $table->unsignedBigInteger('authenticatable_id');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('login_at')->nullable();
            $table->boolean('login_successful')->default(false);
            $table->timestamp('logout_at')->nullable();
            $table->boolean('cleared_by_user')->default(false);
            $table->json('location')->nullable();

            $table->index(['authenticatable_type', 'authenticatable_id']);
        });

        Schema::create('banks_new', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->nullable()->index('name');
            $table->string('prefix', 30)->nullable();
            $table->string('address', 150)->nullable();
        });

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

        Schema::create('countries', function (Blueprint $table) {
            $table->string('id', 2)->primary();
            $table->string('name', 64);
            $table->string('plan', 100)->nullable();
            $table->integer('worldwide')->nullable();
            $table->integer('worldwide_1')->nullable();
            $table->integer('schengen')->nullable();
            $table->string('code', 4)->nullable();
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 20)->nullable();
            $table->string('created_by', 200)->nullable();
            $table->timestamp('created_on')->nullable();
            $table->softDeletes();
        });

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

        Schema::create('customer_title', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 10)->nullable();
        });

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

        Schema::create('email_subscriptions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('document_type')->nullable();
            $table->string('receipient_email')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by')->nullable();
            $table->integer('is_cc')->nullable();
        });

        Schema::create('employee_types', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 45)->nullable();
        });

        Schema::create('exchangerate_new', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 10)->nullable();
            $table->decimal('rate', 6, 4)->nullable();
            $table->string('created_by', 100)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::create('gender', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 45)->nullable();
        });

        Schema::create('identification_types', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 45)->nullable();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('reference_number', 45)->nullable();
            $table->string('filename', 200)->nullable();
            $table->string('created_by', 45)->nullable();
            $table->dateTime('created_on')->nullable()->useCurrent();
            $table->text('filepath')->nullable();
            $table->string('mime', 20)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->default('');
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('metabase_reports', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 200)->nullable();
            $table->string('link', 200)->nullable();
            $table->string('type', 200)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('html_link', 150)->nullable();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('payment_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 30)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 200)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('updated_by', 200)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

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
            $table->string('size')->nullable();
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

        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id')->index('permission_role_role_id_foreign');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tokenable_type');
            $table->unsignedBigInteger('tokenable_id');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['tokenable_type', 'tokenable_id']);
        });

        Schema::create('professions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 150)->nullable();
            $table->string('created_by', 200)->nullable();
            $table->timestamp('created_on')->nullable();
            $table->softDeletes();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->nullable();
            $table->string('category', 150)->nullable();
            $table->string('route', 150)->nullable()->default('');
            $table->text('url')->nullable();
            $table->text('url_public')->nullable();
            $table->string('access', 150)->nullable();
            $table->string('created_by', 150)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('updated_by', 150)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('status', 100)->nullable();
            $table->string('permission', 100)->nullable();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id')->index('role_user_role_id_foreign');

            $table->primary(['user_id', 'role_id']);
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('sale_channels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('channel', 100)->nullable();
        });

        Schema::create('serials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('counter')->nullable();
            $table->string('name', 20)->nullable();
            $table->string('prefix', 10)->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 40)->nullable();
            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->string('status', 200)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 200)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('updated_by', 200)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::create('tabStock_brands', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 45)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 100)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::create('tabStock_cart', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cart_number', 140)->nullable();
            $table->string('item_code', 140)->nullable();
            $table->string('item', 140)->nullable();
            $table->string('category', 140)->nullable();
            $table->string('quantity', 140)->nullable();
            $table->decimal('price_per_unit', 10)->nullable();
            $table->decimal('sub_total_price', 10)->nullable();
            $table->string('status', 140)->nullable();
            $table->string('invoice_number', 140)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 140)->nullable();
            $table->dateTime('updated_on')->nullable()->index('modified');
            $table->string('updated_by', 140)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::create('tabStock_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 140)->nullable();
            $table->string('barcode', 140)->nullable();
            $table->string('item', 140)->nullable();
            $table->string('category', 140)->nullable();
            $table->string('brand', 140)->nullable();
            $table->string('restock_limit', 140)->nullable();
            $table->string('quantity', 140)->nullable();
            $table->string('size', 140)->nullable();
            $table->decimal('price_per_unit', 10)->nullable();
            $table->decimal('cost_price_per_unit', 10)->nullable();
            $table->text('image')->nullable();
            $table->string('supplier', 140)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 140)->nullable();
            $table->dateTime('updated_on')->nullable()->index('modified');
            $table->string('updated_by', 140)->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->fullText(['barcode', 'item'], 'barcode');
        });

        Schema::create('tabStock_entry_sizes_and_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 140)->nullable();
            $table->string('uom', 140)->nullable();
            $table->string('size', 140)->nullable();
            $table->decimal('price_per_unit', 10)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 140)->nullable();
            $table->dateTime('updated_on')->nullable()->index('modified');
            $table->string('updated_by', 140)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::create('tabStock_item_category', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 45)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 200)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('updated_by', 200)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tax', 11)->nullable();
            $table->string('period', 11)->nullable();
            $table->decimal('broker', 15, 3)->nullable();
            $table->decimal('agent', 15, 3)->nullable();
            $table->decimal('sticker', 15, 3)->nullable();
            $table->decimal('withholding', 15, 3)->nullable();
            $table->decimal('vat', 15, 3)->nullable();
            $table->decimal('NHIL', 15, 3)->nullable()->default(2.5);
            $table->decimal('GetFund', 15, 3)->nullable()->default(2.5);
            $table->decimal('COVID_19_HRL', 15, 3)->nullable()->default(1);
            $table->decimal('fire_levy', 15, 3)->nullable()->default(1);
            $table->string('created_by', 200)->nullable();
            $table->timestamp('created_on')->nullable();
            $table->softDeletes();
        });

        Schema::create('units_of_measurement', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 100)->nullable();
            $table->string('size', 100)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('created_by', 200)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::create('user_status', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 45)->nullable();
        });

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

        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `gen_debit_number`(in branchid varchar(5))
BEGIN
select concat('INV',DATE_FORMAT(now(),'%Y%m'),lpad(debit_generation_count,5,'0')) AS MYID
from branch_setup where branch_code=branchid;

update branch_setup set debit_generation_count=debit_generation_count + 1 where branch_code = branchid;
END");

        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `gen_receipt_number`(in branchid varchar(2))
BEGIN
select concat('RCP',DATE_FORMAT(now(),'%Y%m'),lpad(receiptnumber,5,'0')) AS MYID
from branch_setup where branch_code=branchid;

update branch_setup set receiptnumber=receiptnumber + 1 where branch_code = branchid;
END");

        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_current_day_earning`(in adate date)
begin 

set @adate := adate;


drop table if exists tmp1;
create TEMPORARY table tmp1
select sub_total_price as total_selling_price,quantity,
reference
 from payments
 where receipt_date = @adate;


drop table if exists tmp2;
create TEMPORARY table tmp2 
select A.*,B.cost_price_per_unit 
from tmp1 A left join tabStock_entry B 
on A.reference = B.code;



select sum((total_selling_price - (cost_price_per_unit*quantity))) as profit_and_loss from tmp2;



end");

        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_daily_sales_report`(in startdate date,in enddate date,in collection_mode_filter VARCHAR(100), in product_category_filter VARCHAR(100))
begin 

set @startdate := startdate;
set @enddate := enddate;
set @collection_mode := collection_mode_filter;
set @product_category := product_category_filter;

drop table if exists tmp1;
create TEMPORARY table tmp1 
select receipt_number,left(receipt_date,10) as receipt_date,price_per_unit,quantity,sub_total_price,collection_mode,
paid_by,created_by,product,category,
customer_name,customer_mobile_number
 from payments
where left(receipt_date,10) BETWEEN @startdate and @enddate
and (@collection_mode = 'All' or collection_mode = @collection_mode)
and (@product_category  = 'All' or category = @product_category );



drop table if exists tmp2;
create TEMPORARY table tmp2 
select 'Total' as receipt_number,
' ' as receipt_date,
sum(price_per_unit) as price_per_unit,
sum(quantity) as quantity,
sum(sub_total_price) as sub_total_price,
' ' as collection_mode,
' ' as paid_by,
' ' as created_by,
' ' as product,
' ' as category,
' ' as customer_name,
' ' as customer_mobile_number from tmp1;

insert into tmp1 
select * from tmp2;



select * from tmp1;


end");

        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_monthly_dashboard_trend`(in adate date)
begin 

set @adate = adate;


select MONTH(receipt_date) monthnumber,sum(amount_paid) amount_paid from payments 
where left(receipt_date,4) = left(@adate ,4)
group by MONTH(receipt_date);


end");

        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_monthly_earning_dashboard`(in adate date)
begin 

set @adate := adate;

drop table if exists tmp1;
create TEMPORARY table tmp1
select month(receipt_date) as monthnumber,sub_total_price as total_selling_price,quantity,
reference
 from payments
 where left(receipt_date,4) = left(@adate,4);


drop table if exists tmp2;
create TEMPORARY table tmp2 
select A.*,B.cost_price_per_unit 
from tmp1 A left join tabStock_entry B 
on A.reference = B.code;

select monthnumber,sum((total_selling_price - (cost_price_per_unit*quantity))) as profit_and_loss from tmp2
group by monthnumber;


end");

        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_profit_and_loss`(in startdate date,in enddate date)
begin 

set @startdate := startdate;
set @enddate := enddate;


drop table if exists tmp1;
create TEMPORARY table tmp1
select receipt_number,receipt_date,price_per_unit,sub_total_price as total_selling_price,quantity,amount_paid,
reference,product,category
 from payments
 where receipt_date BETWEEN @startdate and @enddate;


drop table if exists tmp2;
create TEMPORARY table tmp2 
select A.*,B.cost_price_per_unit 
from tmp1 A left join tabStock_entry B 
on A.reference = B.code;



select *,(cost_price_per_unit*quantity) as total_cost_price, 
(total_selling_price - (cost_price_per_unit*quantity)) as profit_and_loss from tmp2;



end");

        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_weekly_dashboard_trend`(in adate date)
begin 

set @adate = adate;

set @sunday :=  @adate  - INTERVAL DAYOFWEEK( @adate ) - 1 DAY;
set @saturday :=  @adate  - INTERVAL DAYOFWEEK( @adate ) - 7 DAY;

#select @sunday ,@saturday

select receipt_date,DAYOFWEEK(receipt_date) weekday,sum(amount_paid) amount_paid from payments 
where receipt_date >= @sunday and receipt_date <= @saturday
group by receipt_date,DAYOFWEEK(receipt_date) ;


end");

        Schema::table('permission_role', function (Blueprint $table) {
            $table->foreign(['permission_id'])->references(['id'])->on('permissions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->dropForeign('role_user_role_id_foreign');
        });

        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropForeign('permission_role_permission_id_foreign');
            $table->dropForeign('permission_role_role_id_foreign');
        });

        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_weekly_dashboard_trend");

        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_profit_and_loss");

        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_monthly_earning_dashboard");

        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_monthly_dashboard_trend");

        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_daily_sales_report");

        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_current_day_earning");

        DB::unprepared("DROP PROCEDURE IF EXISTS gen_receipt_number");

        DB::unprepared("DROP PROCEDURE IF EXISTS gen_debit_number");

        Schema::dropIfExists('users');

        Schema::dropIfExists('user_status');

        Schema::dropIfExists('units_of_measurement');

        Schema::dropIfExists('taxes');

        Schema::dropIfExists('tabStock_item_category');

        Schema::dropIfExists('tabStock_entry_sizes_and_prices');

        Schema::dropIfExists('tabStock_entry');

        Schema::dropIfExists('tabStock_cart');

        Schema::dropIfExists('tabStock_brands');

        Schema::dropIfExists('suppliers');

        Schema::dropIfExists('sessions');

        Schema::dropIfExists('serials');

        Schema::dropIfExists('sale_channels');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('role_user');

        Schema::dropIfExists('reports');

        Schema::dropIfExists('professions');

        Schema::dropIfExists('personal_access_tokens');

        Schema::dropIfExists('permissions');

        Schema::dropIfExists('permission_role');

        Schema::dropIfExists('payments');

        Schema::dropIfExists('payment_type');

        Schema::dropIfExists('password_reset_tokens');

        Schema::dropIfExists('metabase_reports');

        Schema::dropIfExists('jobs');

        Schema::dropIfExists('images');

        Schema::dropIfExists('identification_types');

        Schema::dropIfExists('gender');

        Schema::dropIfExists('exchangerate_new');

        Schema::dropIfExists('employee_types');

        Schema::dropIfExists('email_subscriptions');

        Schema::dropIfExists('email_audit_log');

        Schema::dropIfExists('doc_comments');

        Schema::dropIfExists('customer_title');

        Schema::dropIfExists('customer_new');

        Schema::dropIfExists('currencies');

        Schema::dropIfExists('countries');

        Schema::dropIfExists('company');

        Schema::dropIfExists('branch_setup');

        Schema::dropIfExists('bills');

        Schema::dropIfExists('banks_new');

        Schema::dropIfExists('authentication_log');

        Schema::dropIfExists('audits');

        Schema::dropIfExists('account_types');
    }
};
