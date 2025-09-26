@extends('layouts.admin')

@section('title', '申請一覧')

@section('content')
<div class="request-wrapper">
    <h1 class="page-title">申請一覧</h1>
    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>名前</th>
                <th>内容</th>
                <th>承認</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2025-09-24</td>
                <td>山田太郎</td>
                <td>出勤時間修正</td>
                <td><a href="{{ route('admin.approval', 1) }}" class="btn-link">承認画面へ</a></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
