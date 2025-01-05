@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>@lang('lang.users')</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @foreach ($usersWithFriendRequestStatus as $user)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $user->name }}</h5>
                    <p>@lang('lang.gender'): {{ $user->gender }}</p>
                    <p>@lang('lang.occupation'): {{ $user->occupation->name }}</p>
                    <p>@lang('lang.experience'): {{ $user->experience_years }} years</p>
                    <p>@lang('lang.linkedin'): {{ $user->linkedin_username }}</p>
                    <p>@lang('lang.phone'): {{ $user->phone_number }}</p>

                    @if (!$user->friendRequestExists)
                        <form action="{{ route('sendFriendRequest', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">👍 @lang('lang.add_friend')</button>
                        </form>
                    @else
                        <p class="text-muted">@lang('lang.friend_request_sent')</p>
                    @endif
                </div>
            </div>
        @endforeach

    </div>
@endsection
