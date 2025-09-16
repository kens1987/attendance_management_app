<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach($users as $user){
            for($i = 0; $i < 5; $i++){
                $date =Carbon::today()->subDays($i);
                $clockIn = $date->copy()->setTime(rand(8,9),rand(0,59));
                $clockOut = $date->copy()->setTime(rand(17,18),rand(0,59));
                Attendance::create([
                    'user_id'=>$user->id,
                    'work_date'=>$date,
                    'clock_in'=>$clockIn,
                    'clock_out'=>$clockOut,
                    'working_hours'=>round((strtotime($clockOut)-strtotime($clockIn))/3600,2),
                    'status'=>'退勤済み',
                    'remarks'=>null,
                ]);
            }
        }
    }
}
