@extends('layouts.app')

@section('title', 'スタッフ一覧')

@section('content')
<section class="card">
    <h1>スタッフ一覧</h1>
    <table class="table">
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>所属</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
        @foreach($staffs as $staff)
            <tr>
                <td>{{ $staff->name }}</td>
                <td>{{ $staff->email }}</td>
                <td>{{ $staff->department }}</td>
                <td><a href="{{ route('admin.attendances', $staff->id) }}" class="btn btn-small">勤怠</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</section>
@endsection
