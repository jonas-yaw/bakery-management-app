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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_current_day_earning");
    }
};
