@extends('layouts.master')

@section('content')
<div class="container">
    <h2>@lang('lang.users')</h2>

    <form method="GET" action="{{ route('home') }}">
        <div class="row mb-3">
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
                <button type="submit" class="btn btn-primary">@lang('lang.search')</button>
            </div>
        </div>
    </form>

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
