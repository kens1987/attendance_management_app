<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | COACHTECH 管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header class="admin-header">
        <div class="header-logo">COACHTECH</div>
        <nav class="header-nav">
            <a href="{{ route('admin.list') }}">勤怠一覧</a>
            <a href="{{ route('admin.users.index') }}">スタッフ一覧</a>
            <a href="{{ route('admin.requests.index') }}">申請一覧</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">ログアウト</a>
            </form>
        </nav>
    </header>
    <main class="admin-main">
        @yield('content')
    </main>
</body>
</html>
