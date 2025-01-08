@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">@lang('lang.users')</h2>

        <!-- Search Form -->
        <form method="GET" action="{{ route('home') }}">
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="gender" class="form-label">@lang('lang.gender')</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="">@lang('lang.select_gender')</option>
                        <option value="male">@lang('lang.male')</option>
                        <option value="female">@lang('lang.female')</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="occupation" class="form-label">@lang('lang.occupation')</label>
                    <select name="occupation" id="occupation" class="form-select">
                        <option value="">@lang('lang.select_occupation')</option>
                        @foreach ($occupations as $occupation)
                            <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">@lang('lang.search')</button>
                </div>
            </div>
        </form>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- User Cards -->
        <div class="row">
            @foreach ($usersWithFriendRequestStatus as $user)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="{{ $user->avatar->image_data }}" class="img-fluid rounded-start user-avatar" alt="User Avatar">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <p class="card-text">
                                        <strong>@lang('lang.occupation'):</strong> {{ $user->occupation->name }}
                                    </p>
                                    <p class="card-text"><strong>@lang('lang.field_of_work'):</strong></p>
                                    <ul class="list-unstyled">
                                        @forelse ($user->userFOW as $fow)
                                            <li>• {{ $fow->fieldOfWork->name }}</li>
                                        @empty
                                            <li>@lang('lang.no_field_of_work')</li>
                                        @endforelse
                                    </ul>
                                    @if (!$user->friendRequestExists)
                                        <form action="{{ route('sendFriendRequest', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary mt-2">
                                                👍 @lang('lang.add_friend')
                                            </button>
                                        </form>
                                    @else
                                        <p class="text-muted mt-2">@lang('lang.friend_request_sent')</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .user-avatar {
            width: 100%;
            height: 150px;
            object-fit: contain;
            object-position: center;
        }
    </style>
@endsection
