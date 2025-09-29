@extends('layouts.app')

@section('title', '勤怠詳細')

@section('content')
<div class="attendance-detail-wrapper">
    <h1 class="attendance-title">勤怠詳細</h1>
    <div class="attendance-view">
        <p><strong>ユーザー名:</strong> {{ $attendance->user->name }}</p>
        <p><strong>日付:</strong> {{ $attendance->work_date }}</p>
    </div>
    @isset($editRequest)
        <div class="edit-request-info">
            <h2>修正申請情報</h2>
            <p><strong>理由:</strong> {{ $editRequest->reason }}</p>
            <p><strong>ステータス:</strong>
                @if($editRequest->status === 'pending')
                    <span style="color: orange;">承認待ち</span>
                @elseif($editRequest->status === 'approved')
                    <span style="color: green;">承認済み</span>
                @else
                    <span style="color: red;">却下</span>
                @endif
            </p>
        </div>
        <hr>
    @endisset
    <hr>
    @if ($attendance->approval_status === 'pending')
        <p style="color:red; font-weight:bold;">＊承認待ちのため修正できません。</p>
    @else
    <form action="{{ route('user.attendance.update', $attendance->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="clock_in">出勤</label>
            <input type="time" name="clock_in" id="clock_in" value="{{ $attendance->clock_in ? $attendance->clock_in->format('H:i') : '' }}">
            @error('clock_in')<div style="color:red;">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="clock_out">退勤</label>
            <input type="time" name="clock_out" id="clock_out" value="{{ $attendance->clock_out ? $attendance->clock_out->format('H:i') : '' }}">
            @error('clock_out')<div style="color:red;">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>休憩</label>
            @foreach ($attendance->breakTimes as $i => $break)
                <div class="break-item">
                    <input type="time" name="breaks[{{ $i }}][start]"value="{{ $break->break_start ? $break->break_start->format('H:i') : '' }}">
                    @error("breaks.$i.start")<div style="color:red;">{{ $message }}</div>@enderror
                    ～
                    <input type="time" name="breaks[{{ $i }}][end]"value="{{ $break->break_end ? $break->break_end->format('H:i') : '' }}">
                    @error("breaks.$i.end")<div style="color:red;">{{ $message }}</div>@enderror
                </div>
            @endforeach
            <div class="break-item">
                <input type="time" name="breaks[new][start]" value="">
                ～
                <input type="time" name="breaks[new][end]" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="remarks">備考</label>
            <textarea name="remarks" id="remarks">{{ $attendance->remarks }}</textarea>
            @error('remarks')<div style="color:red;">{{ $message }}</div>@enderror
        </div>
        <div class="btn-area">
            <button type="submit" class="btn btn-primary">修正</button>
        </div>
    </form>
    @endif
</div>
@endsection
