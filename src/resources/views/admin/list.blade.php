@extends('layouts.admin')

@section('title', '勤怠一覧')

@section('content')
<div class="list-wrapper">
    <h1 class="page-title">勤怠一覧</h1>
    <div class="date-nav">
        <a href="{{ route('admin.list', ['date' => $date->copy()->subDay()->format('Y-m-d')]) }}" class="btn-link">前日</a>
        <span>{{ $date->format('Y-m-d') }}</span>
        <a href="{{ route('admin.list', ['date' => $date->copy()->addDay()->format('Y-m-d')]) }}" class="btn-link">翌日</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>名前</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
                <th>勤務時間</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->work_date }}</td>
                <td>{{ $attendance->user->name }}</td>
                <td>{{ $attendance->clock_in }}</td>
                <td>{{ $attendance->clock_out }}</td>
                <td>{{ $attendance->break_time }}</td>
                <td>{{ $attendance->working_hours }}</td>
                <td>
                    <a href="{{ route('admin.detail', $attendance->id) }}" class="btn-link">詳細</a>
                </td>
            </tr>
            @endforeach
            @if($attendances->isEmpty())
            <tr>
                <td colspan="7">勤怠データがありません</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
