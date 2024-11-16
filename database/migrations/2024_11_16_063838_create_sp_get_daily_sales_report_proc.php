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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_daily_sales_report");
    }
};
