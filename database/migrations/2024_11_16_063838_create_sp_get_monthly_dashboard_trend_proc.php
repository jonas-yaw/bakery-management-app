<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_monthly_dashboard_trend`(in adate date)
begin 

set @adate = adate;


select MONTH(receipt_date) monthnumber,sum(amount_paid) amount_paid from payments 
where left(receipt_date,4) = left(@adate ,4)
group by MONTH(receipt_date);


end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_monthly_dashboard_trend");
    }
};
