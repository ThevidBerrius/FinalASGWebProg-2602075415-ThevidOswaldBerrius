@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4>@lang('lang.login')</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">@lang('lang.email')</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">@lang('lang.password')</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    @lang('lang.login')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .card {
            border-radius: 10px;
        }

        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        .btn-primary {
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 1rem;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.9rem;
            color: #dc3545;
        }

        .container {
            margin-top: 100px;
        }

        @media (max-width: 768px) {
            .container {
                margin-top: 50px;
            }

            .card {
                border-radius: 8px;
            }
        }
    </style>
@endsection
