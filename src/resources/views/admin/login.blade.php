@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2 class="auth-title">管理者ログイン</h2>
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf
        <input type="email" name="email" placeholder="メールアドレス" required>
        <input type="password" name="password" placeholder="パスワード" required>
        <button type="submit" class="auth-button">ログイン</button>
    </form>
</div>
@endsection
