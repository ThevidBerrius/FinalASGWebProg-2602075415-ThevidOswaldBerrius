@extends('layouts.master')

@section('content')
<div class="container">
    <div class="profile-header text-center">
        <img src="{{ $user->avatar }}" alt="Avatar" class="rounded-circle" width="150">
        <h2>{{ $user->name }}</h2>
        <p>@lang('lang.occupation'): {{ $user->occupation->name }}</p>
        <p>@lang('lang.experience'): {{ $user->experience_years }} years</p>
    </div>

    <div class="friend-list mt-5">
        <h3>@lang('lang.friend')</h3>
        @if($friends->isEmpty())
            <p>@lang('lang.no_friends_yet')</p>
        @else
            <ul class="list-group">
                @foreach ($friends as $friend)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ $friend->avatar }}" alt="Avatar" class="rounded-circle me-3" width="50">
                            <div>
                                <h5>{{ $friend->name }}</h5>
                                <p>@lang('lang.occupation'): {{ $friend->occupation->name }}</p>
                            </div>
                        </div>
                        <form action="{{ route('profile.removeFriend', $friend->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">@lang('lang.remove_friend')</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
