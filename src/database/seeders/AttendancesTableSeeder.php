<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザー取得（管理者以外の一般ユーザーを対象にする場合）
        $users = User::where('role', 'user')->get();

        // 前月初日～当月末日までの期間を設定
        $start = Carbon::now()->subMonth()->startOfMonth();
        $end   = Carbon::now()->endOfMonth();

        $period = CarbonPeriod::create($start, $end);

        foreach ($users as $user) {
            foreach ($period as $date) {
                // 土日スキップ
                if ($date->isWeekend()) {
                    continue;
                }

                // 勤怠データ作成
                Attendance::create([
                    'user_id' => $user->id,
                    'work_date' => $date->toDateString(),
                    'clock_in' => $date->copy()->setTime(9, 0, 0),
                    'clock_out' => $date->copy()->setTime(18, 0, 0),
                    // 'break_start' => $date->copy()->setTime(12, 0, 0),
                    // 'break_end' => $date->copy()->setTime(13, 0, 0),
                    'status' => '退勤済',
                ]);
            }
        }
    }
}
