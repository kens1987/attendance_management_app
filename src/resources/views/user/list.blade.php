@extends('layouts.app')

@section('title', '勤怠一覧')

@section('content')
<div class="attendance-wrapper">
    <h1 class="attendance-title">勤怠一覧</h1>

    {{-- 月切り替え --}}
    <div class="month-switcher">
        <a href="{{ route('user.attendance.list', ['month' => $prevMonth]) }}" class="arrow">&lt; 前月</a>
        <span class="current-month">{{ $currentMonth }}</span>
        <a href="{{ route('user.attendance.list', ['month' => $nextMonth]) }}" class="arrow">翌月 &gt;</a>
    </div>

    @php
        function formatMinutes($minutes){
            $hours = floor($minutes/60);
            $mins = $minutes%60;
            return sprintf('%d:%02d',$hours,$mins);
        }
    @endphp

    <table class="attendance-table">
        <thead>
            <tr>
                <th>日付</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
                <th>合計</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
        @foreach($attendances as $attendance)
            <tr>
                <td>
                    {{ \Carbon\Carbon::parse($attendance->work_date)->format('m/d') }}
                    <span class="weekday">
                    ({{ \Carbon\Carbon::parse($attendance->work_date)->isoFormat('dd') }})
                    </span>
                </td>
                <td>{{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '-' }}</td>
                <td>{{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : '-' }}</td>
                <td>{{ isset($attendance->break_minutes) ? formatMinutes($attendance->break_minutes) : '0:00' }}</td>
                <td>
                    @php
                        $workingMinutes = isset($attendance->working_hours)
                            ? round($attendance->working_hours * 60)
                            : 0;
                    @endphp
                    {{ formatMinutes($workingMinutes) }}
                </td>
                <td><a href="{{ route('user.attendance.show', $attendance->id) }}" class="detail-btn">詳細</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
