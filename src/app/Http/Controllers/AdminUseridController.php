<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;

class AdminUseridController extends Controller
{
    public function index(User $user,Request $request){
        $month = $request->input('month',now()->format('Y-m'));

        $attendances = Attendance::where('user_id',$user->id)
        ->where('work_date','like',$month.'%')
        ->orderBy('work_date','asc')->get();

        $prevMonth = date('Y-m',strtotime($month.'-01 -1 month'));
        $nextMonth = date('Y-m',strtotime($month.'-01 +1 month'));

        return view('admin.user_id',compact('user','attendances','month','prevMonth','nextMonth'));
    }
}
