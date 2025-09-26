@extends('layouts.admin')

@section('title', 'スタッフ別勤怠一覧')

@section('content')
<div class="user-id-wrapper">
    <h1 class="page-title">{{ $user->name }}さんの勤怠一覧</h1>
    <div class="month-navigation">
        <a href="{{ route('admin.users.attendances.index', ['user' => $user->id, 'month' => $prevMonth]) }}">前月</a>
        <span>{{ substr($month,0,4) }}年{{ substr($month,5,2) }}月</span>
        <a href="{{ route('admin.users.attendances.index', ['user' => $user->id, 'month' => $nextMonth]) }}">翌月</a>
    </div>
    <table class="table">
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
            <td>{{ $attendance->work_date }}</td>
            <td>{{ $attendance->clock_in }}</td>
            <td>{{ $attendance->clock_out }}</td>
            <td>{{ $attendance->break_time }}</td>
            <td>{{ $attendance->working_hours }}</td>
            <td>
                <a href="{{ route('admin.detail', $attendance->id) }}" class="btn-link">詳細</a>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
