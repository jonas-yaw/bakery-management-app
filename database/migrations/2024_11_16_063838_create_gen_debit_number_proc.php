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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `gen_debit_number`(in branchid varchar(5))
BEGIN
select concat('INV',DATE_FORMAT(now(),'%Y%m'),lpad(debit_generation_count,5,'0')) AS MYID
from branch_setup where branch_code=branchid;

update branch_setup set debit_generation_count=debit_generation_count + 1 where branch_code = branchid;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS gen_debit_number");
    }
};
