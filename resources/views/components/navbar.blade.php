<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="#">ConnectFriend</a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">@lang('lang.home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">@lang('lang.about')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('friends.index') }}">@lang('lang.friend')</a>
                </li>
            </ul>

            <!-- Right Section -->
            <ul class="navbar-nav">
                <!-- Language Dropdown -->
                <li class="nav-item dropdown ms-4">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('lang.language')
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item" href="{{ url('lang/en') }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ url('lang/id') }}">Indonesia</a></li>
                    </ul>
                </li>

                <!-- Authentication Links -->
                @guest
                    <!-- Login and Register Buttons -->
                    <li class="nav-item ms-4">
                        <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">
                            @lang('lang.login')
                        </a>
                        @if (Route::has('register'))
                            <a class="btn btn-primary" href="{{ route('register') }}">
                                @lang('lang.register')
                            </a>
                        @endif
                    </li>
                @else
                    <!-- Notification Dropdown -->
                    @auth
                        <li class="nav-item dropdown ms-4">
                            <a class="nav-link dropdown-toggle position-relative d-flex align-items-center" href="#"
                                id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell me-1"></i> @lang('lang.notification')
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $notifications->count() }}
                                    <span class="visually-hidden">unread notifications</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                                <li class="dropdown-header">@lang('lang.notification')</li>
                                @foreach ($notifications as $notification)
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <small>{{ $notification->created_at->diffForHumans() }}</small><br>
                                            {{ $notification->content }}
                                        </a>
                                        <div class="d-flex justify-content-end mt-2">
                                            @if ($notification->type === 'request')
                                                <form
                                                    action="{{ route('notifications.handle', ['id' => $notification->id, 'action' => 'accept']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm me-2">@lang('lang.accept')</button>
                                                </form>
                                                <form
                                                    action="{{ route('notifications.handle', ['id' => $notification->id, 'action' => 'decline']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm">@lang('lang.decline')</button>
                                                </form>
                                            @elseif ($notification->type === 'message')
                                                <a href="{{ route('messages.show.notification', ['friendId' => $notification->sender_id, 'notificationId' => $notification->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    @lang('lang.go_to_chat')
                                                </a>
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endforeach
                                <li><a class="dropdown-item text-center" href="#">@lang('lang.view_all')</a></li>
                            </ul>
                        </li>
                    @endauth

                    <!-- Profile Dropdown for Authenticated User -->
                    <li class="nav-item dropdown ms-4">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item"
                                    href="{{ route('profile.show', Auth::user()->id) }}">@lang('lang.profile')</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
