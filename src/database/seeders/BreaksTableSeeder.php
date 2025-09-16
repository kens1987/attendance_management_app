<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BreakTime;
use App\Models\Attendance;
use Carbon\Carbon;

class BreaksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attendances = Attendance::all();
        foreach($attendances as $attendance) {
            if(!$attendance->start_time || !$attendance->end_time) {
                continue;
            }
            $breakCount = rand(1,2);
            for ($i=0;$i<$breakCount;$i++) {
                $start = Carbon::parse($attendance->start_time)->addHours(rand(2,4));
                $end = $start->copy()->addMinutes(rand(30,60));
                if($end > Carbon::parse($attendance->end_time)) {
                    $end = Carbon::parse($attendance->end_time)->subMinutes(5);
                }
                BreakTime::create([
                    'attendance_id'=>$attendance->id,
                    'start_time'=>$start,
                    'end_time'=>$end,
                ]);
            }
        }
    }
}
