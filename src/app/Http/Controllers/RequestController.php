<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\AttendanceEditRequest;

class RequestController extends Controller
{
    public function index(){
        $pending = AttendanceEditRequest::with(['attendance','user'])
        ->where('status','pending')->where('user_id',auth()->id())
        ->latest()->get();
        $approved = AttendanceEditRequest::with(['attendance','user','approver'])
        ->where('status','approved')->where('user_id',auth()->id())
        ->latest()->get();
        return view('user.request',compact('pending','approved'));
    }

    public function show($id){
        $editRequest = AttendanceEditRequest::with(['attendance.breakTimes','user','approver'])->findOrFail($id);
        $attendance = $editRequest->attendance;
        $attendance->approval_status = $editRequest->status;
        return view('user.detail',compact('attendance', 'editRequest'));
    }

    public function store(Request $request){
        $request->validate([
            'attendance_id' => 'required|exists:attendances,id',
            'reason' => 'required|string|max:255',
            // 'clock_in' => 'nullable|date_format:H:i',
            // 'clock_out' => 'nullable|date_format:H:i',
            // 'remarks' => 'nullable|string|max:255',
        ]);
        $attendance = Attendance::findOrFail($request->attendance_id);
        $attendance->update([
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
            'remarks' => $request->remarks,
        ]);
        AttendanceEditRequest::create([
            'attendance_id' => $request->attendance_id,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'status' => 'approved',
            // 'approved_by' => auth()->id(),
            // 'approved_at' =>now(),
        ]);
        return redirect()->route('requests.index')->with('success','申請を送信しました。');
    }
}
