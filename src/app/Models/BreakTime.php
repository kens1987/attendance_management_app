<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    protected $table = 'breaks';
    protected $fillable = [
        'attendance_id',
        'break_start',
        'break_end',
        // 要確認
        // 'duration',
    ];
    protected $casts = [
        'break_start'=>'datetime',
        'break_end'=>'datetime',
    ];
    public function attendance(){
        return $this->belongsTo(Attendance::class);
    }

    protected static function booted(){
        static::saved(function($break){
            $break->attendance?->recalcWorkingHours();
        });
        static::deleted(function($break){
            $break->attendance?->recalcWorkingHours();
        });
    }
}
