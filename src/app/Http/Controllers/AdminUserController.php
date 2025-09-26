<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.user',compact('users'));
    }
}
