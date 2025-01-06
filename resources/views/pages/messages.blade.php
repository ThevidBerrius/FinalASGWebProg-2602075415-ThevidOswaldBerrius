@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>@lang('lang.inbox')</h2>
        <ul class="list-group">
            @foreach ($messages as $message)
                <li class="list-group-item">
                    <div>
                        <strong>{{ $message->sender->name }}</strong>: {{ $message->message }}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
