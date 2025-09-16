<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_date',
        'clock_in',
        'clock_out',
        // 要確認
        // 'working_hours',
        'status',
        'remarks',
    ];
    protected $casts = [
        'clock_in'=>'datetime',
        'clock_out'=>'datetime',
    ];
    protected static function booted(){
        static::saving(function($attendance){
            if($attendance->clock_in && $attendance->clock_out){
                $totalMinutes = $attendance->clock_out->diffInMinutes($attendance->clock_in);
                $breakMinutes = $attendance->breakTimes()
                ->whereNotNull('break_start')
                ->whereNotNull('break_end')
                ->get()
                ->sum(fn($break)=>$break->break_end->diffInMinutes($break->break_start));
                $attendance->working_hours = round(($totalMinutes - $breakMinutes)/60,2);
                // $this->saveQuietly();
            }
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function breakTimes(){
        return $this->hasMany(BreakTime::class);
    }

    public function recalcWorkingHours(){
        if ($this->clock_in && $this->clock_out) {
            $totalMinutes = $this->clock_out->diffInMinutes($this->clock_in);
            $breakMinutes = $this->breakTimes()
                ->whereNotNull('break_start')
                ->whereNotNull('break_end')
                ->get()
                ->sum(fn($break) => $break->break_end->diffInMinutes($break->break_start));
            $this->working_hours = round(($totalMinutes - $breakMinutes) / 60, 2);
            $this->saveQuietly();
        }
    }
}
