<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceEditItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_edit_request_id',
        'break_id',
        'field_name',
        'before_value',
        'after_value',
    ];

    public function attendanceEditRequest(){
        return $this->belongsTo(AttendanceEditRequest::class);
    }
    public function break(){
        return $this->belongsTo(BreakTime::class);
    }
}
