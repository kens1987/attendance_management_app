@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2 class="auth-title">新規会員登録</h2>
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf
        <input  type="text" name="name" placeholder="ユーザー名" value="{{ old('name') }}" >
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror
        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror
        <input type="password" name="password" placeholder="パスワード" >
        @error('password')
        <div class="error">{{ $message }}</div>
        @enderror
        <input type="password" name="password_confirmation" placeholder="パスワード（確認用）" >
        @error('password')
        <div class="error">{{ $message }}</div>
        @enderror
        <button type="submit" class="auth-button">登録する</button>
    </form>
    <p class="auth-link">すでにアカウントをお持ちですか？ <a href="{{ route('login') }}">ログイン</a></p>
</div>
@endsection
