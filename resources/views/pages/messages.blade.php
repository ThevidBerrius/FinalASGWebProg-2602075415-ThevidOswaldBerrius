@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>@lang('lang.chat_with') {{ $friend->name }}</h1>
        <div class="messages">
            @foreach ($messages as $message)
                <div class="message">
                    <strong>{{ $message->sender->name }}:</strong> {{ $message->content }}
                </div>
            @endforeach
        </div>
        <form method="POST" action="{{ route('messages.send', ['friend_id' => $friend->id]) }}">
            @csrf
            <div class="form-group">
                <textarea id="content" name="content" class="form-control" rows="1"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">@lang('lang.send')</button>
        </form>

    </div>
@endsection

