@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">@lang('lang.your_friend')</h1>
        <div class="row">
            @foreach ($friends as $friend)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm border-light rounded">
                        <img src="{{ optional($friend->avatar)->image_data ?: 'default-avatar.png' }}"
                            class="card-img-top avatar-img" alt="@lang('lang.avatar')">
                        <div class="card-body">
                            <h5 class="card-title text-center text-dark">{{ $friend->name }}</h5>
                            <p class="card-text text-center text-muted">{{ $friend->occupation->name }}</p>
                            <div class="text-center">
                                <a href="{{ route('messages.show', ['friendId' => $friend->id]) }}"
                                    class="btn btn-primary btn-lg">@lang('lang.chat')</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        .avatar-img {
            height: 200px;
            width: 100%;
            object-fit: contain;
            border-radius: 50%;
            border: 3px solid #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 10px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
            padding: 12px 24px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
@endsection
