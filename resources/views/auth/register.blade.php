@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-light rounded">
                    <div class="card-header text-center">
                        <h4>@lang('lang.register')</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">@lang('lang.name')</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">@lang('lang.email')</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">@lang('lang.password')</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">@lang('lang.confirm_password')</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="mb-3">
                                <label for="occupation_id" class="form-label">@lang('lang.occupation')</label>
                                <select id="occupation_id" name="occupation_id"
                                    class="form-control @error('occupation_id') is-invalid @enderror" required>
                                    <option value="">Choose...</option>
                                    @foreach ($occupations as $occupation)
                                        <option value="{{ $occupation->id }}"
                                            {{ old('occupation_id') == $occupation->id ? 'selected' : '' }}>
                                            {{ $occupation->name }}</option>
                                    @endforeach
                                </select>
                                @error('occupation_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="fields_of_work" class="form-label">@lang('lang.field_of_work')</label>
                                <select id="fields_of_work" name="fields_of_work[]"
                                    class="form-control @error('fields_of_work') is-invalid @enderror" multiple required
                                    size="5">
                                    @foreach ($fieldsOfWork as $field)
                                        <option value="{{ $field->id }}"
                                            {{ in_array($field->id, old('fields_of_work', [])) ? 'selected' : '' }}>
                                            {{ $field->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small>@lang('lang.select_up_to_three')</small>
                                @error('fields_of_work')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">@lang('lang.gender')</label>
                                <select id="gender" name="gender"
                                    class="form-control @error('gender') is-invalid @enderror" required>
                                    <option value="">Choose...</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="linkedin_username" class="form-label">@lang('lang.linkedin')</label>
                                <input id="linkedin_username" type="text"
                                    class="form-control @error('linkedin_username') is-invalid @enderror"
                                    name="linkedin_username" value="{{ old('linkedin_username') }}" required>
                                <small>Format: https://www.linkedin.com/in/<username></small>
                                @error('linkedin_username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">@lang('lang.phone')</label>
                                <input id="phone_number" type="text"
                                    class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                    value="{{ old('phone_number') }}" required>
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="experience_years" class="form-label">@lang('lang.experience')</label>
                                <input id="experience_years" type="number"
                                    class="form-control @error('experience_years') is-invalid @enderror"
                                    name="experience_years" value="{{ old('experience_years') }}" required>
                                @error('experience_years')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">@lang('lang.registration_price')</label>
                                <input id="price" type="text" class="form-control"
                                    value="{{ rand(100000, 125000) }}" readonly>
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary w-100">
                                    @lang('lang.register')
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
            margin-top: 50px;
        }

        @media (max-width: 768px) {
            .container {
                margin-top: 30px;
            }

            .card {
                border-radius: 8px;
            }
        }
    </style>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectElement = document.getElementById('fields_of_work');

        selectElement.addEventListener('change', function() {
            const selectedOptions = Array.from(selectElement.selectedOptions);

            if (selectedOptions.length > 3) {
                selectedOptions[selectedOptions.length - 1].selected = false;
                alert('You can only select up to three fields of work.');
            }
        });
    });
</script>
