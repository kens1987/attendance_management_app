@extends('layouts.admin')

@section('title', '申請詳細')

@section('content')
<div class="request-detail">
    <h1>勤怠修正申請詳細</h1>

    <p><strong>名前:</strong> {{ $request->user->name }}</p>
    <p><strong>対象日:</strong> {{ $request->attendance->work_date }}</p>
    <p><strong>理由:</strong> {{ $request->reason }}</p>

    <h2>修正項目</h2>
    <table>
        <thead>
            <tr>
                <th>項目</th>
                <th>修正前</th>
                <th>修正後</th>
            </tr>
        </thead>
        <tbody>
            @foreach($request->items as $item)
                <tr>
                    <td>{{ $item->field_name }}</td>
                    <td>{{ $item->before_value }}</td>
                    <td>{{ $item->after_value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($request->status === 'pending')
    <form method="POST" action="{{ route('admin.requests.approve', $request->id) }}">
        @csrf
        <button type="submit" class="btn btn-primary">承認</button>
    </form>
    @else
        <p class="text-green-600">承認済み（{{ $request->approved_at }}）</p>
    @endif
    </div>
@endsection
