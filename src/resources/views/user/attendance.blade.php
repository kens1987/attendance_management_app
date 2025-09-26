@extends('layouts.app')

@section('title', '勤怠')

@section('content')
<section class="card text-center p-6">
    {{-- 状態 --}}
    <p class="status-label mb-2">
        {{ $attendance ? $attendance->status : '勤務外' }}
    </p>

    {{-- 日付 --}}
    <p class="date text-lg font-bold">
        {{ now()->format('Y年n月j日') }} ({{ ['日','月','火','水','木','金','土'][now()->dayOfWeek] }})
    </p>

    {{-- 時刻 --}}
    <p class="time text-5xl font-extrabold my-4">
        {{ now()->format('H:i') }}
    </p>
    @if($attendance && $attendance->status === '退勤済')
        <p class="text-lg font-bold text-green-600 mt-2">お疲れ様でした。</p>
    @endif

    {{-- 出勤・退勤 --}}
    <div class="btn-group">
        @if(!$attendance)
            <form action="{{ route('clock.in') }}" method="POST">
                @csrf
                <button type="submit" class="btn">出勤</button>
            </form>
        @elseif($attendance && !$attendance->clock_out)
            <form action="{{ route('clock.out') }}" method="POST">
                @csrf
                <button type="submit" class="btn">退勤</button>
            </form>
        @endif

        {{-- 休憩 --}}
        @if($attendance && !$attendance->clock_out)
            @if(!$latestBreak || $latestBreak->break_end)
                <form action="{{ route('break.start') }}" method='POST'>
                    @csrf
                    <button type="submit" class="btn">休憩入</button>
                </form>
            @elseif($latestBreak && !$latestBreak->break_end)
                <form action="{{ route('break.end') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">休憩戻</button>
                </form>
            @endif
        @endif
    </div>

    <!-- {{-- 打刻情報表示 --}}
    @if($attendance)
        <p>出勤時間: {{ $attendance->clock_in ? $attendance->clock_in->format('H:i') : '-' }}</p>
        <p>退勤時間: {{ $attendance->clock_out ? $attendance->clock_out->format('H:i') : '-' }}</p>
        @if($attendance->breakTimes->count())
            <h3>休憩履歴</h3>
            <ul>
                @foreach($attendance->breakTimes as $break)
                    <li>
                        開始: {{ $break->start_time ? $break->start_time->format('H:i') : '-' }},
                        終了: {{ $break->end_time ? $break->end_time->format('H:i') : '-' }}
                    </li>
                @endforeach
            </ul>
        @endif
    @endif -->
</section>
@endsection
