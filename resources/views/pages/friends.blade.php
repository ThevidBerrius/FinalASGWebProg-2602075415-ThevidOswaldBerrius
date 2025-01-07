@extends('layouts.master')

@section('content')
<div class="container">
    <h1>@lang('lang.your_friend')</h1>
    <div class="row">
        @foreach($friends as $friend)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ optional($friend->avatar)->image_data ?: 'default-avatar.png' }}" class="card-img-top" alt="@lang('lang.avatar')">
                    <div class="card-body">
                        <h5 class="card-title">{{ $friend->name }}</h5>
                        <p class="card-text">{{ $friend->occupation->name }}</p>
                        <a href="{{ route('messages.show', ['friendId' => $friend->id]) }}" class="btn btn-primary">@lang('lang.chat')</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
