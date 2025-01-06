@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="profile-header text-center">
            <img src="{{ $user->avatar ? $user->avatar->image_data : 'default-avatar.png' }}" alt="Avatar"
                class="rounded-circle" width="150">
            <h2>{{ $user->name }}</h2>
            <p>@lang('lang.occupation'): {{ $user->occupation->name }}</p>
            <p>@lang('lang.experience'): {{ $user->experience_years }} @lang('lang.years')</p>
            <p>@lang('lang.email'): {{ $user->email }}</p>
            <p>@lang('lang.phone'): {{ $user->phone }}</p>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('avatars.index') }}" class="btn btn-primary">@lang('lang.visit_avatar_shop')</a>
        </div>

        <div class="avatar-inventory mt-5">
            <h3>@lang('lang.select_avatar')</h3>
            <div class="row">
                @foreach ($purchasedAvatars as $avatar)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ $avatar->image_data }}" class="card-img-top" alt="Avatar">
                            <div class="card-body text-center">
                                <form action="{{ route('profile.updateAvatar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="avatar_id" value="{{ $avatar->id }}">
                                    <button type="submit" class="btn btn-primary">@lang('lang.select_avatar')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="friend-list mt-5">
            <h3>@lang('lang.friend')</h3>
            @if ($friends && $friends->isEmpty())
                <p>@lang('lang.no_friends_yet')</p>
            @else
                <ul class="list-group">
                    @foreach ($friends as $friend)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ $friend->friend->avatar ? $friend->friend->avatar->image_data : 'default-avatar.png' }}"
                                    alt="Avatar" class="rounded-circle me-3" width="50">
                                <div>
                                    <h5>{{ $friend->friend->name }}</h5>
                                    <p>@lang('lang.occupation'): {{ $friend->friend->occupation->name ?? __('No occupation') }}
                                    </p>
                                </div>
                            </div>
                            <form action="{{ route('profile.removeFriend', $friend->friend_id) }}" method="POST">
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
