@extends('layouts.admin')

@section('title', 'スタッフ一覧')

@section('content')
<div class="user-wrapper">
    <h1 class="page-title">スタッフ一覧</h1>
    <table class="table">
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>月次勤怠</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('admin.users.attendances.index', $user->id) }}" class="btn-link">
                    勤怠
                </a>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

