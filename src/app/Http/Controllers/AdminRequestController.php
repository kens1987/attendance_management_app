<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceEditRequest;

class AdminRequestController extends Controller
{
    public function index(){
        $requests = AttendanceEditRequest::with('user','attendance')->latest()->get();
        return view('admin.request',compact('requests'));
    }

    public function show($id){
        $request = AttendanceEditRequest::with('user','attendance','items')->findOrFail($id);
        return view('admin.approval',compact('request'));
    }

    public function approve($id){
        $request = AttendanceEditRequest::with('items','attendance')->findOrFail($id);
        $attendance = $request->attendance;
        foreach ($request->items as $item){
            $attendance->{$item->field_name} = $item->after_value;
        }
        $attendance->save();

        $request->status = 'approved';
        $request->approved_by = Auth::id();
        $request->approved_at = now();
        $request->save();
        return redirect()->route('admin.requests.index')->with('success','申請を承認しました');
    }
}

