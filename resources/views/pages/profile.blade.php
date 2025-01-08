@extends('layouts.master')

@section('content')
    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header text-center py-5">
            <img src="{{ $user->avatar ? $user->avatar->image_data : 'default-avatar.png' }}" alt="Avatar"
                class="rounded-circle mb-3" width="150">
            <h2 class="font-weight-bold">{{ $user->name }}</h2>
            <p class="text-muted">@lang('lang.occupation'): {{ $user->occupation->name }}</p>
            <p class="text-muted">@lang('lang.experience'): {{ $user->experience_years }} @lang('lang.years')</p>
            <p class="text-muted">@lang('lang.email'): {{ $user->email }}</p>
            <p class="text-muted">@lang('lang.phone'): {{ $user->phone_number }}</p>
        </div>

        <!-- Avatar Shop Button -->
        <div class="text-center mt-4">
            <a href="{{ route('avatars.index') }}" class="btn btn-primary btn-lg px-4 py-2">@lang('lang.visit_avatar_shop')</a>
        </div>

        <!-- Avatar Inventory -->
        <div class="avatar-inventory mt-5">
            <h3 class="text-center">@lang('lang.select_avatar')</h3>
            <div class="row">
                @foreach ($purchasedAvatars as $avatar)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
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

        <!-- Friend List -->
        <div class="friend-list mt-5">
            <h3 class="text-center">@lang('lang.friend')</h3>
            @if ($friends->isEmpty())
                <p class="text-center">@lang('lang.no_friends_yet')</p>
            @else
                <ul class="list-group">
                    @foreach ($friends as $friend)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ optional($friend->avatar)->image_data ?: 'default-avatar.png' }}"
                                    alt="Avatar" class="rounded-circle me-3" width="50">
                                <div>
                                    <h5 class="mb-0">{{ $friend->name }}</h5>
                                    <p class="mb-0 text-muted">@lang('lang.occupation'):
                                        {{ optional($friend->occupation)->name ?? __('No occupation') }}</p>
                                </div>
                            </div>
                            <form action="{{ route('profile.removeFriend', $friend->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">@lang('lang.remove_friend')</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <style>
        .profile-header {
            background-color: #f7f7f7;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            border-radius: 10px;
            object-fit: contain;
            height: 200px;
        }

        .btn-primary {
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 25px;
        }

        .btn-danger {
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 25px;
        }

        .friend-list {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .list-group-item:hover {
            background-color: #f1f1f1;
        }

        .text-muted {
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .card-img-top {
                height: 150px;
            }
        }
    </style>
@endsection
