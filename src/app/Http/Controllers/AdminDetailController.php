<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;

class AdminDetailController extends Controller
{
    public function show($id){
        $attendance = Attendance::with('user')->findOrFail($id);
        return view('admin.detail',compact('attendance'));
    }

    public function update(Request $request,$id){
        $attendance = Attendance::findOrFail($id);
        $request->validate([
            'clock_in' => 'nullable|date_format:H:i',
            'clock_out' => 'nullable|date_format:H:i',
            'break_start' => 'nullable|date_format:H:i',
            'break_end' => 'nullable|date_format:H:i',
        ]);
        $workDate = Carbon::parse($attendance->work_date)->toDateString();
        if($request->clock_in){
            $attendance->clock_in = Carbon::parse($workDate.''.$request->clock_in);
        }
        if($request->clock_out){
            $attendance->clock_out = Carbon::parse($workDate.''.$request->clock_out);
        }
        if($request->break_start){
            $attendance->break_start = Carbon::parse($workDate.''.$request->break_start);
        }
        if($request->break_end){
            $attendance->break_end = Carbon::parse($workDate.''.$request->break_end);
        }
        $attendance->save();
        return redirect()->route('admin.detail',$attendance->id)
        ->with('success','勤怠情報を更新しました。');
    }
}
