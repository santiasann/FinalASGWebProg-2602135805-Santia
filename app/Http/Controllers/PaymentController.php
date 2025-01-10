<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{
    //
    public function payment(Request $request)
    {
        $registration_fee = session('registration_fee', null);

        if (is_null($registration_fee)) {
            return redirect()->route('register')->with('message', 'You must register first.');
        }

        return view('payment', compact('registration_fee'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);
    
        $amount = $request->input('amount');
        $registration_fee = session('registration_fee', 0);
    
        if ($amount < $registration_fee) {
            $underpaid = $registration_fee - $amount;
            return back()->with('message', "You are still underpaid by $underpaid.");
        } elseif ($amount > $registration_fee) {
            $overpaid = $amount - $registration_fee;
            session()->put('overpaid_amount', $overpaid);
            return redirect()->route('payment.confirmation')->with('message', "You overpaid by $overpaid. Would you like to add it to your wallet balance?");
        }
    
        // Payment successful
        return redirect()->route('home')->with('message', 'Payment successful!');
    }

    public function showPaymentConfirmation()
    {
        return view('payment_confirmation');
    }

    public function confirmPayment(Request $request)
    {
        $action = $request->input('action');
        $overpaidAmount = session('overpaid_amount', 0);

        if ($action === 'yes') {
            // Simulate adding the overpaid amount to the user's wallet balance
            // (This assumes a Wallet or User model update)
            session()->forget('overpaid_amount');
            return redirect()->route('home')->with('message', 'Overpaid amount added to your wallet balance.');
        } elseif ($action === 'no') {
            session()->forget('overpaid_amount');
            return redirect()->route('payment')->with('message', 'Please re-enter the correct payment amount.');
        }

        return redirect()->route('home')->with('error', 'Invalid action.');
    }
}
