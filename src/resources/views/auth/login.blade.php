@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2 class="auth-title">ログイン（一般ユーザー）</h2>
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf
        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
        @error('email')
        <div style="color:red;">{{ $message }}</div>
        @enderror
        <input type="password" name="password" placeholder="パスワード" >
        @error('password')
        <div style="color:red;">{{ $message }}</div>
        @enderror
        <button type="submit" class="auth-button">ログイン</button>
    </form>
    <p class="auth-link">アカウントをお持ちでないですか？ <a href="{{ route('register') }}">新規登録</a></p>
</div>
@endsection
