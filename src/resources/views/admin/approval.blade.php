@extends('layouts.app')

@section('title', '修正申請')

@section('content')
<section class="card">
    <h1>修正申請</h1>
    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>申請者</th>
                <th>修正前</th>
                <th>修正後</th>
                <th>理由</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($requests as $request)
            <tr>
                <td>{{ $request->date }}</td>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->before_time }}</td>
                <td>{{ $request->after_time }}</td>
                <td>{{ $request->reason }}</td>
                <td>
                    <form action="{{ route('requests.approve', $request->id) }}" method="POST" style="display:inline;">
                    @csrf
                        <button class="btn btn-small">承認</button>
                    </form>
                    <form action="{{ route('requests.reject', $request->id) }}" method="POST" style="display:inline;">
                    @csrf
                        <button class="btn btn-small btn-danger">却下</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</section>
@endsection
