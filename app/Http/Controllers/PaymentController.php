<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        if ($paymentAmount < $price) {
            $underpaid = $price - $paymentAmount;
            return back()->withErrors("You are still underpaid by Rp{$underpaid}.");
        } elseif ($paymentAmount > $price) {
            $overpaid = $paymentAmount - $price;

            return back()->with([
                'overpaid' => true,
                'overpaid_amount' => $overpaid,
            ]);
        }

        return redirect()->route('home')->with('success', 'Payment successful!');
    }

}
