<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\BreakTime;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        $todayAttendance = Attendance::where('user_id',$user->id)
        ->whereDate('created_at',Carbon::today())
        ->first();
        $latestBreak = null;
        if($todayAttendance){
            $latestBreak = BreakTime::where('attendance_id',$todayAttendance->id)
            ->latest('id')->first();
        }
        return view('user.attendance',[
            'attendance' => $todayAttendance,
            'latestBreak' => $latestBreak,
        ]);
    }

    public function store(Request $request){
        Attendance::create([
            'user_id' => auth()->id(),
            'work_date' => today(),
            'clock_in' => now(),
            'status' =>'出勤中',
        ]);
        return redirect()->route('attendances.index');
    }

    public function clockIn(Request $request){
        $user = $request->user();
        Attendance::create([
            'user_id' => $user->id,
            'clock_in' => Carbon::now(),
            'work_date' => now()->toDateString(),
            'status' => '出勤中',
        ]);
        return redirect()->route('attendances.index');
    }

    public function clockOut(Request $request){
        $user = $request->user();
        $attendance = Attendance::where('user_id',$user->id)
        ->whereDate('created_at',Carbon::today())
        ->first();
        if($attendance){
            $clockOut = Carbon::now();
            $clockIn = Carbon::parse($attendance->clock_in);
            $totalBreak = $attendance->breakTimes->sum(function($break){
                $start = Carbon::parse($break->break_start);
                $end = $break->break_end ? Carbon::parse($break->break_end) : Carbon::now();
                return $end->diffInMinutes($start);
            });
            $workingMinutes = $clockIn->diffInMinutes($clockOut) - $totalBreak;
            $attendance->update([
                'clock_out' => Carbon::now(),
                'working_hours' => round($workingMinutes / 60, 2),
                'status' => '退勤済',
            ]);
        }
        return redirect()->route('attendances.index');
    }

    public function startBreak(Request $request){
        $user = $request->user();
        $attendance = Attendance::where('user_id',$user->id)
        ->whereDate('created_at',Carbon::today())
        ->first();
        if($attendance){
            $attendance->breakTimes()->create([
                'break_start' => Carbon::now(),
            ]);
            $attendance->update([
                'status' => '休憩中',
            ]);
        }
        return redirect()->route('attendances.index');
    }

    public function endBreak(Request $request){
        $user = $request->user();
        $attendance = Attendance::where('user_id',$user->id)
        ->whereDate('created_at',Carbon::today())
        ->first();
        if($attendance){
            $latestBreak = $attendance->breakTimes()->latest('id')->first();
            if($latestBreak && !$latestBreak->break_end){
                $latestBreak->update([
                    'break_end' => Carbon::now(),
                ]);
                $attendance->update([
                    'status' => '出勤中',
                ]);
            }
        }
        return redirect()->route('attendances.index');
    }

    public function list(Request $request){
        $user = $request->user();
        $month = $request->get('month',now()->format('Y-m'));

        $attendances = Attendance::where('user_id',$user->id)
        ->whereMonth('work_date',Carbon::parse($month)->month)
        ->whereYear('work_date',Carbon::parse($month)->year)->get();

        foreach ($attendances as $attendance){
            $totalBreak = $attendance->breakTimes->sum(function($break){
                $start = Carbon::parse($break->break_start);
                $end = $break->break_end ? Carbon::parse($break->break_end):Carbon::now();
                return $end->diffInMinutes($start);
            });
            $attendance->break_minutes =round($totalBreak/60,2);
        }
        return view('user.list',[
            'attendances' => $attendances,
            'currentMonth' => Carbon::parse($month)->format('Y年m月'),
            'prevMonth' => Carbon::parse($month)->subMonth()->format('Y-m'),
            'nextMonth' => Carbon::parse($month)->addMonth()->format('Y-m'),
        ]);
    }
}
