<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            DROP TRIGGER IF EXISTS `calculate_work_duration`;
            CREATE TRIGGER calculate_work_duration
            BEFORE UPDATE ON workTime
            FOR EACH ROW
            BEGIN
                SET NEW.totalTime = TIMESTAMPDIFF(SECOND, OLD.clockInAt, NEW.clockOutAt);
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS calculate_work_duration');
    }
};
