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
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ $user->avatar->image_data }}" class="img-fluid rounded-start" alt="User Avatar">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">@lang('lang.occupation'): {{ $user->occupation->name }}</p>
                        <p class="card-text">@lang('lang.field_of_work'):</p>
                        <ul>
                            @forelse ($user->userFOW as $fow)
                                <li>{{ $fow->fieldOfWork->name }}</li>
                            @empty
                                <li>@lang('lang.no_field_of_work')</li>
                            @endforelse
                        </ul>
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
            </div>
        </div>
    @endforeach
</div>
@endsection
