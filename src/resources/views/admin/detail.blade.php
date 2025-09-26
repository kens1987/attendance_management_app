@extends('layouts.admin')

@section('title', '勤怠詳細')

@section('content')
<div class="detail-wrapper">
    <h1 class="page-title">勤怠詳細</h1>
    <form action="{{ route('admin.detail.update', $attendance->id) }}" method="post" class="detail-form">
        @csrf
        @method('put')
        <div class="form-group">
            <label>名前</label>
            <input type="text" value="{{ $attendance->user->name }}" disabled>
        </div>
        <div class="form-group">
            <label>日付</label>
            <input type="date" value="{{ $attendance->work_date }}" disabled>
        </div>
        <div class="form-group">
            <label>出勤</label>
            <input type="time" name="clock_in" value="{{ optional($attendance->clock_in)->format('H:i') }}">
        </div>
        <div class="form-group">
            <label>退勤</label>
            <input type="time" name="clock_out" value="{{ optional($attendance->clock_out)->format('H:i') }}">
        </div>
        <div class="form-group">
            <label>休憩開始</label>
            <input type="time" name="break_start" value="{{ optional($attendance->break_start)->format('H:i') }}">
        </div>
        <div class="form-group">
        <label>休憩終了</label>
        <input type="time" name="break_end" value="{{ optional($attendance->break_end)->format('H:i') }}">
    </div>
        <button type="submit" class="btn-submit">修正</button>
    </form>
</div>
@endsection
