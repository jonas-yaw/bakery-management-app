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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_profit_and_loss");
    }
};
