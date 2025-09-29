@extends('layouts.admin')

@section('title', '申請一覧')

@section('content')
<div class="request-wrapper">
    <h1 class="page-title">申請一覧</h1>
    <!-- {{-- タブメニュー --}} -->
    <div class="tab-menu">
        <button class="tab-link active" data-tab="pending">承認待ち</button>
        <button class="tab-link" data-tab="approved">承認済み</button>
    </div>
    <!-- {{-- 承認待ち --}} -->
    <div id="pending" class="tab-content active">
        <table>
            <thead>
                <tr>
                    <th>状態</th>
                    <th>名前</th>
                    <th>対象日</th>
                    <th>申請日</th>
                    <th>理由</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests->where('status', 'pending') as $request)
                    <tr>
                        <td>{{ $request->status }}</td>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->attendance->work_date ?? '-' }}</td>
                        <td>{{ $request->created_at->format('Y/m/d') }}</td>
                        <td>{{ $request->reason }}</td>
                        <td><a href="{{ route('admin.requests.show', $request->id) }}">詳細</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <table>
        <!-- {{-- 承認済み --}} -->
    <div id="approved" class="tab-content">
        <table>
            <thead>
                <tr>
                    <th>状態</th>
                    <th>名前</th>
                    <th>対象日</th>
                    <th>申請日</th>
                    <th>理由</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests->where('status', 'approved') as $request)
                    <tr>
                        <td>{{ $request->status }}</td>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->attendance->work_date ?? '-' }}</td>
                        <td>{{ $request->created_at->format('Y/m/d') }}</td>
                        <td>{{ $request->reason }}</td>
                        <td><a href="{{ route('admin.requests.show', $request->id) }}">詳細</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- {{-- タブ切り替えスクリプト --}} -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-link');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // 全てのタブを非アクティブ化
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));

            // クリックしたタブをアクティブ化
            this.classList.add('active');
            document.getElementById(this.dataset.tab).classList.add('active');
        });
    });
});
</script>
<!-- {{-- 簡易スタイル --}} -->
<style>
.tab-menu {
    margin-bottom: 15px;
}
.tab-link {
    padding: 8px 16px;
    margin-right: 8px;
    border: 1px solid #ccc;
    background: #f9f9f9;
    cursor: pointer;
}
.tab-link.active {
    background: #333;
    color: #fff;
}
.tab-content { display: none; }
.tab-content.active { display: block; }
</style>
@endsection

