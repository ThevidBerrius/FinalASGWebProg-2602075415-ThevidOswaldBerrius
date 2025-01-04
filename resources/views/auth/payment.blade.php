@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Payment') }}</div>
                <div class="card-body">
                    <p>Registration Fee: Rp{{ number_format($price) }}</p>

                    @if(session('overpaid'))
                        <p>Sorry, you overpaid by Rp{{ number_format(session('overpaid_amount')) }}.</p>
                        <form method="POST" action="{{ route('auth.payment.process') }}">
                            @csrf
                            <button type="submit" name="balance" value="yes" class="btn btn-success">
                                Enter to wallet balance
                            </button>
                            <button type="submit" name="balance" value="no" class="btn btn-danger">
                                Re-enter payment amount
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('auth.payment.process') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="payment_amount" class="form-label">{{ __('Payment Amount') }}</label>
                                <input type="number" name="payment_amount" id="payment_amount" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Submit Payment') }}</button>
                        </form>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
