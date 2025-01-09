<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PaymentController extends Controller
{
    //
    public function showPaymentForm(User $user)
    {
        $registrationFee = 1000; // Get random registration fee

        return view('payment', compact('user', 'registrationFee'));
    }

    public function processPayment(Request $request, User $user)
    {
        $request->validate([
            'amount' => 'required|integer|min:' . rand(100000, 125000),
        ]);

        $amount = $request->input('amount');
        $registrationFee = 1000;

        if ($amount < $registrationFee) {
            return redirect()->back()->with('error', 'You are still underpaid.');
        } elseif ($amount > $registrationFee) {
            // Handle overpayment (e.g., add to wallet balance)
            // ...
            return redirect()->back()->with('success', 'Payment successful. Excess amount will be added to your wallet balance.');
        } else {
            // Update user with payment status
            $user->registration_fee_paid = true;
            $user->save();

            return redirect()->route('home')->with('success', 'Payment successful. You are now registered!');
        }
    }
}
