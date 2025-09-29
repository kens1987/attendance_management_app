<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','COACHTECH 勤怠管理')</title>
    <!-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/list.css')}}">
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
    <link rel="stylesheet" href="{{asset('css/request.css')}}">
</head>

<body>
    <header class="header">
        <div class="header-logo">COACHTECH</div>
        <nav class="header-nav">
            <a href="{{ route('attendances.store') }}">勤怠</a>
            <a href="{{ route('user.attendance.list') }}">勤怠一覧</a>
            <!-- <a href="#">スタッフ一覧</a> -->
            <a href="{{ route('requests.index') }}">申請</a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">ログアウト</a>
            </form>
        </nav>
    </header>
    <main class="container">
        @yield('content')
    </main>
</body>
</html>
