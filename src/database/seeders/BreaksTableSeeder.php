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

        foreach ($attendances as $attendance) {
            $workStart = Carbon::parse($attendance->start_time);
            $workEnd   = Carbon::parse($attendance->end_time);

            // 勤務時間が短ければスキップ
            if ($workEnd->diffInHours($workStart) < 6) continue;

            // 固定：お昼休憩（12:00〜13:00）
            $lunchStart = $attendance->date . ' 12:00:00';
            $lunchEnd   = $attendance->date . ' 13:00:00';

            BreakTime::create([
                'attendance_id' => $attendance->id,
                'start_time'    => $lunchStart,
                'end_time'      => $lunchEnd,
            ]);

            // ランダム休憩（15〜30分）
            if (rand(0, 1)) {
                $start = Carbon::parse($attendance->date . ' 15:00:00');
                $end   = $start->copy()->addMinutes(rand(15, 30));

                if ($end < $workEnd) {
                    BreakTime::create([
                        'attendance_id' => $attendance->id,
                        'start_time'    => $start,
                        'end_time'      => $end,
                    ]);
                }
            }
        }
    }
}
