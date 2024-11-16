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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `gen_receipt_number`(in branchid varchar(2))
BEGIN
select concat('RCP',DATE_FORMAT(now(),'%Y%m'),lpad(receiptnumber,5,'0')) AS MYID
from branch_setup where branch_code=branchid;

update branch_setup set receiptnumber=receiptnumber + 1 where branch_code = branchid;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS gen_receipt_number");
    }
};
