@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>@lang('lang.friend_list')</h2>
        <ul class="list-group">
            @foreach ($friends as $friend)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ $friend->friend->avatar ? $friend->friend->avatar->image_data : 'default-avatar.png' }}" alt="Avatar" class="rounded-circle me-3" width="50">
                        <div>
                            <h5>{{ $friend->friend->name }}</h5>
                            <p>@lang('lang.occupation'): {{ $friend->friend->occupation->name ?? __('No occupation') }}</p>
                        </div>
                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal-{{ $friend->friend->id }}">@lang('lang.send_message')</button>
                </li>

                <!-- Modal -->
                <div class="modal fade" id="messageModal-{{ $friend->friend->id }}" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="messageModalLabel">@lang('lang.send_message_to') {{ $friend->friend->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('friends.sendMessage') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ $friend->friend->id }}">
                                    <div class="mb-3">
                                        <label for="message" class="form-label">@lang('lang.message')</label>
                                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">@lang('lang.send')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
@endsection
