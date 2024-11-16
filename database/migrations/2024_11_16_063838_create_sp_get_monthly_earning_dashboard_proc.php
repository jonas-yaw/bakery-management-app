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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_monthly_earning_dashboard");
    }
};
