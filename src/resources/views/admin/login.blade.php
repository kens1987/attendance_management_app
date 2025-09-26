@extends('layouts.admin')

@section('title', '管理者ログイン')

@section('content')
<div class="login-wrapper">
    <h1 class="login-title">管理者ログイン</h1>
    <form action="{{ route('admin.login') }}" method="post" class="login-form">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password">
            @error('password')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn-submit">管理者ログインする</button>
    </form>
</div>
@endsection
