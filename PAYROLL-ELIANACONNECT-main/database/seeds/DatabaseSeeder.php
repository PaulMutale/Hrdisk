<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call(UsersTableSeeder::class);*/
    
        $this->call(AdminsTableSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(DeductionSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(OvertimeSeeder::class);
        $this->call(CashAdvanceSeeder::class);
        $this->call(AttendanceSeeder::class);
    }
}
