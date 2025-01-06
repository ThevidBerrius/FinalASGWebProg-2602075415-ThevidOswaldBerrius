@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Messages</h1>
        <div class="messages">
            @foreach($messages as $message)
                <div class="message">
                    <strong>{{ $message->sender->name }}:</strong> {{ $message->content }}
                </div>
            @endforeach
        </div>
        <form method="POST" action="{{ route('messages.send', ['friend_id' => $friendId]) }}">
            @csrf
            <div class="form-group">
                <label for="content">Message</label>
                <textarea id="content" name="content" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
@endsection
