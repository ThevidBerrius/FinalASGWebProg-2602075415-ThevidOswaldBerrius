@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">@lang('lang.payment')</div>
                <div class="card-body">
                    <p>@lang('lang.registration_price'): Rp{{ number_format($price) }}</p>

                    @if(session('overpaid'))
                        <p>@lang('lang.overpaid_message', ['amount' => number_format(session('overpaid_amount'))])</p>
                        <form method="POST" action="{{ route('auth.payment.process') }}">
                            @csrf
                            <button type="submit" name="balance" value="yes" class="btn btn-success">
                                @lang('lang.enter_wallet_balance')
                            </button>
                            <button type="submit" name="balance" value="no" class="btn btn-danger">
                                @lang('lang.reenter_payment_amount')
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('auth.payment.process') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="payment_amount" class="form-label">@lang('lang.payment_amount')</label>
                                <input type="number" name="payment_amount" id="payment_amount" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('lang.submit_payment')</button>
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
