@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">@lang('lang.chat_with') {{ $friend->name }}</h1>
        <div class="messages" style="height: 400px; overflow-y: auto; padding-bottom: 10px;">
            @foreach ($messages as $message)
                <div class="message mb-3">
                    <strong>{{ $message->sender->name }}:</strong> {{ $message->content }}
                </div>
            @endforeach
        </div>

        <form method="POST" action="{{ route('messages.send', ['friend_id' => $friend->id]) }}">
            @csrf
            <div class="form-group mb-3">
                <textarea id="content" name="content" class="form-control" rows="2" placeholder="@lang('lang.type_your_message')" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">@lang('lang.send')</button>
        </form>
    </div>
    <style>
        .messages {
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            height: 400px;
            overflow-y: auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .message strong {
            color: #007bff;
        }

        .message.user-message {
            background-color: #007bff;
            color: white;
            text-align: right;
        }

        .message.friend-message {
            background-color: #e9ecef;
            color: #333;
            text-align: left;
        }

        .form-control {
            border-radius: 15px;
            font-size: 1.1rem;
            padding: 10px 15px;
        }

        .btn-primary {
            font-size: 1.1rem;
            border-radius: 25px;
            padding: 12px;
        }

        .btn-block {
            width: 100%;
        }
    </style>
@endsection
