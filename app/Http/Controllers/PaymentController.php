<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function show(Request $request)
    {
        $price = session('registration_fee', null);

        if (!$price) {
            return redirect()->route('home')->withErrors('Registration fee not found.');
        }

        return view('auth.payment', compact('price'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_amount' => 'required|numeric|min:0',
        ]);

        $price = session('registration_fee', null);
        if (!$price) {
            return redirect()->route('home')->withErrors('Registration fee not found.');
        }

        $paymentAmount = $request->input('payment_amount');

        if ($paymentAmount > $price) {
            $overpaid = $paymentAmount - $price;
            session(['overpaid_amount' => $overpaid]);

            return back()->with([
                'overpaid' => true,
                'overpaid_amount' => $overpaid,
            ]);
        }

        $balanceOption = $request->input('balance');
        if ($balanceOption === 'yes') {
            if (Auth::check()) {
                $user = Auth::user();
                $overpaidAmount = session('overpaid_amount', 0);

                if ($overpaidAmount > 0) {
                    $user->coins += $overpaidAmount;
                    $user->save();
                    session()->forget('overpaid_amount');

                    return redirect()->route('home')->with('success', __('lang.overpaid_amount_added'));
                } else {
                    return redirect()->route('home')->withErrors(__('lang.overpaid_amount_not_found'));
                }
            } else {
                return redirect()->route('login')->withErrors(__('lang.please_log_in'));
            }
        } elseif ($balanceOption === 'no') {
            return redirect()->route('auth.payment.show')->withErrors(__('lang.reenter_payment_amount'));
        }

        return redirect()->route('home')->with('success', __('lang.payment_successful'));
    }

    public function topUp()
    {
        $user = auth()->user();
        $user->coins += 100;
        $user->save();

        return redirect()->back()->with('success', __('lang.coins_added', ['amount' => 100]));
    }
}
