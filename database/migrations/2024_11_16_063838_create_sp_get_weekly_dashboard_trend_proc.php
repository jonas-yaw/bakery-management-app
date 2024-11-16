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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_weekly_dashboard_trend");
    }
};
