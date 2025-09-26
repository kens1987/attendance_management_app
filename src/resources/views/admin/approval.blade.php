@extends('layouts.admin')

@section('title', '修正申請承認')

@section('content')
<div class="approval-wrapper">
    <h1 class="page-title">修正申請承認</h1>
    <form action="{{ route('admin.requests.update', $request->id) }}" method="post" class="approval-form">
        @csrf
        @method('put')
        <div class="form-group">
            <label>名前</label>
            <input type="text" value="山田太郎" disabled>
        </div>
        <div class="form-group">
            <label>修正内容</label>
            <textarea disabled>出勤時間を 09:00 → 10:00 に修正</textarea>
        </div>
        <div class="form-actions">
            <button type="submit" name="status" value="approved" class="btn-submit">承認</button>
            <button type="submit" name="status" value="rejected" class="btn-reject">却下</button>
        </div>
    </form>
</div>
@endsection
