@extends('layouts.app')

@section('title', '申請一覧画面（一般ユーザー）')

@section('content')
<div class="request-wrapper">
    <h1 class="request-title">申請一覧</h1>

    <div class="request-tabs">
        <button class="tab active" data-tab="pending">承認待ち</button>
        <button class="tab" data-tab="approved">承認済み</button>
    </div>

    {{-- 承認待ち --}}
    <table class="request-table tab-content active" id="pending">
        <thead>
            <tr>
                <th>状態</th>
                <th>名前</th>
                <th>対象日時</th>
                <th>申請理由</th>
                <th>申請日時</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pending as $req)
                <tr>
                    <td>承認待ち</td>
                    <td>{{ $req->user->name }}</td>
                    <td>{{ $req->attendance->work_date ?? '-' }}</td>
                    <td>{{ $req->reason }}</td>
                    <td>{{ $req->created_at->format('Y/m/d') }}</td>
                    <td><a href="{{ route('requests.show', $req->id) }}" class="detail-link">詳細</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">承認待ちの申請はありません。</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 承認済み --}}
    <table class="request-table tab-content" id="approved">
        <thead>
            <tr>
                <th>状態</th>
                <th>名前</th>
                <th>対象日時</th>
                <th>申請理由</th>
                <th>承認日時</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @forelse($approved as $req)
                <tr>
                    <td>承認済み</td>
                    <td>{{ $req->user->name }}</td>
                    <td>{{ $req->attendance->work_date ?? '-' }}</td>
                    <td>{{ $req->reason }}</td>
                    <td>{{ $req->approved_at ? $req->approved_at->format('Y/m/d') : '-' }}</td>
                    <td><a href="{{ route('requests.show', $req->id) }}" class="detail-link">詳細</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">承認済みの申請はありません。</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- タブ切り替え --}}
<script>
    document.querySelectorAll('.request-tabs .tab').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.request-tabs .tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            button.classList.add('active');
            document.getElementById(button.dataset.tab).classList.add('active');
        });
    });
</script>
@endsection
