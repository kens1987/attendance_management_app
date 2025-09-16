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
                    {{ \Carbon\Carbon::parse($attendance->date)->format('m/d') }}
                    <span class="weekday">
                    ({{ \Carbon\Carbon::parse($attendance->date)->isoFormat('dd') }})
                    </span>
                </td>
                <!-- <td>{{ $attendance->date }}</td> -->
                <td>{{ $attendance->clock_in ?? '-' }}</td>
                <td>{{ $attendance->clock_out ?? '-' }}</td>
                <!-- <td>{{ $attendance->break_time ?? '-' }}</td> -->
                <!-- <td>{{ $attendance->total_time ?? '-' }}</td> -->
                <td>{{ $attendance->break_minutes ?? 0 }} h</td>
                <td>{{ $attendance->working_hours ?? 0 }} h</td>
                <!-- <td>{{ $attendance->break ?? '0.0' }}</td> -->
                <!-- <td>{{ $attendance->total ?? '0.0' }}</td> -->
                <!-- <td>{{ $attendance->working_hours ?? '-' }}</td> -->
                <td><a href="{{ route('user.attendance.detail', $attendance->id) }}" class="detail-btn">詳細</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection


