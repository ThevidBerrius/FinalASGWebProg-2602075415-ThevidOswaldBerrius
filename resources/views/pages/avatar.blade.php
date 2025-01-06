@extends('layouts.master')

@section('content')
<div class="container">
    <h2>@lang('lang.select_avatar')</h2>
    
    <div class="alert alert-info">
        @lang('lang.your_coins'): {{ auth()->user()->coins }}
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        @foreach ($avatars as $avatar)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ $avatar->image_data }}" class="card-img-top" alt="Avatar Image">
                    <div class="card-body text-center">
                        <h5 class="card-title">@lang('lang.price'): {{ $avatar->price }} @lang('lang.coins')</h5>
                        @if ($avatar->price > 0)
                            <form action="{{ route('avatars.select') }}" method="POST">
                                @csrf
                                <input type="hidden" name="avatar_id" value="{{ $avatar->id }}">
                                <button type="submit" class="btn btn-primary"
                                    {{ auth()->user()->coins < $avatar->price ? 'disabled' : '' }}>@lang('lang.buy_avatar')</button>
                            </form>
                        @else
                            <button class="btn btn-secondary" disabled>@lang('lang.free_avatar')</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection