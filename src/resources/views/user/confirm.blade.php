@extends('layouts.app')

@section('title', '勤怠詳細確認')

@section('content')
<div class="attendance-detail-wrapper">
    <h1 class="attendance-title">勤怠詳細確認</h1>

    <div class="attendance-card">
        <table class="attendance-table">
            <tr>
                <th>名前</th>
                <td>{{ $attendance->user->name }}</td>
            </tr>
            <tr>
                <th>日付</th>
                <td>{{ \Carbon\Carbon::parse($attendance->work_date)->format('Y年n月j日') }}</td>
            </tr>
            <tr>
                <th>出勤・退勤</th>
                <td>
                    {{ $attendance->clock_in ? $attendance->clock_in->format('H:i') : '--:--' }}
                    ～
                    {{ $attendance->clock_out ? $attendance->clock_out->format('H:i') : '--:--' }}
                </td>
            </tr>
            <tr>
                <th>休憩</th>
                <td>
                    @foreach ($attendance->breakTimes as $break)
                        {{ $break->break_start ? $break->break_start->format('H:i') : '--:--' }}
                        ～
                        {{ $break->break_end ? $break->break_end->format('H:i') : '--:--' }}
                        <br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>備考</th>
                <td>{{ $attendance->remarks ?? 'なし' }}</td>
            </tr>
        </table>
    </div>

    {{-- 常に承認待ち文言を表示するならここ --}}
    <p class="approval-warning">＊承認待ちのため修正はできません。</p>
</div>
@endsection
