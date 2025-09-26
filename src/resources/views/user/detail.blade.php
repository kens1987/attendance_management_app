@extends('layouts.app')

@section('title', '勤怠詳細')

@section('content')
<div class="attendance-detail-wrapper">
    <h1 class="attendance-title">勤怠詳細</h1>
    <div class="attendance-view">
        <p><strong>ユーザー名:</strong> {{ $attendance->user->name }}</p>
        <p><strong>日付:</strong> {{ $attendance->work_date }}</p>
    </div>
    <hr>
    @if ($attendance->approval_status === 'pending')
        <p style="color:red; font-weight:bold;">＊承認待ちのため修正できません。</p>
    @else
    <form action="{{ route('requests.store', $attendance->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="clock_in">出勤</label>
            <input type="time" name="clock_in" id="clock_in" value="{{ $attendance->clock_in ? $attendance->clock_in->format('H:i') : '' }}">
            @error('clock_in')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="clock_out">退勤</label>
            <input type="time" name="clock_out" id="clock_out" value="{{ $attendance->clock_out ? $attendance->clock_out->format('H:i') : '' }}">
            @error('clock_out')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>休憩</label>
            @foreach ($attendance->breakTimes as $i => $break)
                <div class="break-item">
                    <input type="time" name="breaks[{{ $i }}][start]"value="{{ $break->break_start ? $break->break_start->format('H:i') : '' }}">
                    @error('breaks.$i.start')<div class="error">{{ $message }}</div>@enderror
                    ～
                    <input type="time" name="breaks[{{ $i }}][end]"value="{{ $break->break_end ? $break->break_end->format('H:i') : '' }}">
                    @error('breaks.$i.end')<div class="error">{{ $message }}</div>@enderror
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
            @error('remarks')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div class="btn-area">
            <button type="submit" class="btn btn-primary">修正</button>
        </div>
    </form>
    @endif
</div>
@endsection
