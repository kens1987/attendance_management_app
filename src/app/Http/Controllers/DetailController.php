<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\BreakTime;
use App\Http\Requests\DetailRequest;

class DetailController extends Controller
{
    public function show($id){
        $attendance = Attendance::with('breakTimes')->findOrFail($id);
        $attendance->approval_status = ($attendance->approval_status === 'editable') ? 'editable' : 'readonly';
        return view('user.detail', compact('attendance'));
    }

    public function update(DetailRequest $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
        if ($attendance->approval_status === 'pending') {
            return back()->with('error', '承認待ちのため修正できません。');
        }
        // 出勤更新
        $attendance->update([
            'clock_in'  => $request->clock_in ? Carbon::parse($attendance->work_date.' '.$request->clock_in) : null,
            'clock_out' => $request->clock_out ? Carbon::parse($attendance->work_date.' '.$request->clock_out) : null,
            'remarks'   => $request->remarks,
            'approval_status' => 'pending',
        ]);
        // 休憩更新
            foreach($request->breaks ?? [] as $key => $breakData){
                if($key === 'new'){
                    // 新規追加
                    if(!empty($breakData['start']) || !empty($breakData['end'])){
                        $attendance->breakTimes()->create([
                            'break_start' => !empty($breakData['start']) ? Carbon::parse($attendance->work_date.' '.$breakData['start']) : null,
                            'break_end' => !empty($breakData['end']) ? Carbon::parse($attendance->work_date.' '.$breakData['end']) : null,
                        ]);
                    }
                }else{
                    // 既存レコード更新
                    $break = $attendance->breakTimes[$key] ?? null;
                    if($break){
                        $break->update([
                            'break_start' => !empty($breakData['start']) ? Carbon::parse($attendance->work_date.' '.$breakData['start']) : null,
                            'break_end' => !empty($breakData['end']) ? Carbon::parse($attendance->work_date.' '.$breakData['end']) : null,
                        ]);
                    }
                }
            }
            return redirect()->route('user.attendance.show',$id)->with('success','勤怠情報を更新しました。');
    }
}
