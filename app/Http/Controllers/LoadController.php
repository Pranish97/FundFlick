<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\Bank;
use Illuminate\Support\Facades\Auth;

class LoadController extends Controller
{
    public function load()
    {
        return view('load');
    }

    public function loadFromBank(Request $request)
    {
        $request->validate([
            'bank_name' => 'required',
            'user_id' => 'required',
            'amount' => 'required',
            'pin' => 'required',
        ]);

        $bankName = $request->input('bank_name');
        $userId = $request->input('user_id');
        $amount = $request->input('amount');
        $pin = $request->input('pin');

        $bank = Bank::where('bank_name', $bankName)
            ->where('user_id', $userId)
            ->first();

        if ($bank) {
            if ($bank->pin == $pin) {
                if ($bank->amount >= $amount) {
                    $bank->amount -= $amount;
                    $bank->save();

                    $user = Auth::user();
                    $user->user_amount += $amount;
                    $user->save();

                    $fund = Fund::create([
                        'user_id' => $user->id,
                        'amount' => $request->amount,
                        'amount_updated_time' => now(),
                        'amount_type' => 'credited',
                        'remarks' => 'Bank',
                        'updated_user_amount' => $user->user_amount,
                        'receiver_id' => $request->user_id,
                    ]);
                    $fund->save();

                    return back()->with('success', 'Amount successfully loaded from bank.');
                } else {
                    return back()->with('error', 'Insufficient funds in the bank account.');
                }
            } else {
                return back()->with('error', 'Incorrect Pin');
            }
        } else {
            return back()->with('error', 'Bank Details Not Found');
        }
    }
}
