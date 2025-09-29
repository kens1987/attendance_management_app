<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceEditRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'user_id',
        'reason',
        'status',
        'approved_by',
        'approved_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'approved_at' => 'datetime',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function attendance(){
        return $this->belongsTo(Attendance::class);
    }
    public function items(){
        return $this->hasMany(AttendanceEditItem::class);
    }
    public function approver(){
        return $this->belongsTo(User::class,'approved_by');
    }
}
