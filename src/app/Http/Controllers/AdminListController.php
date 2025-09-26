<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class AdminListController extends Controller
{
    public function index(Request $request){
        $date = $request->query('date') ? Carbon::parse($request->query('date')) : Carbon::today();
        $attendances = Attendance::with('user')
        ->where('work_date',$date->format('Y-m-d'))->get();
        return view('admin.list',compact('attendances','date'));
    }
}
