<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fund;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewNotification;
use App\Events\TransactionEvent;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = Auth::user();

        if (!$users) {
            return redirect()->route('login')->with('error', 'You must be logged in to view the dashboard.');
        }

        $funds = Fund::where('user_id', $users->id)->with(['user', 'receiver'])->get();

        $data = [
            'labels' => [],
            'data' => [],
        ];

        foreach ($funds as $fund) {
            $data['labels'][] = $fund->updated_user_amount;
            $data['data'][] = $fund->amount_updated_time;
        }

        return view('dashboard', compact('data', 'users', 'funds'));
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'name' => 'required|exists:users,name',
            'amount' => 'required|numeric|min:0.01',
            'remarks' => 'required|string',
        ]);

        $recipient = User::where('name', $request->name)->first();
        $sender = auth()->user();

        if ($sender->user_amount < $request->amount) {
            return back()->with('amount', 'Insufficient funds.');
        }

        DB::transaction(function () use ($sender, $recipient, $request) {
            $sender->user_amount -= $request->amount;
            $sender->save();

            Fund::create([
                'user_id' => $sender->id,
                'amount' => $request->amount,
                'amount_updated_time' => now(),
                'amount_type' => 'debited',
                'remarks' => $request->remarks,
                'updated_user_amount' => $sender->user_amount,
                'receiver_id' => $recipient->id,
            ]);

            $recipient->user_amount += $request->amount;
            $recipient->save();

            Fund::create([
                'user_id' => $recipient->id,
                'amount' => $request->amount,
                'amount_updated_time' => now(),
                'amount_type' => 'credited',
                'remarks' => $request->remarks,
                'updated_user_amount' => $recipient->user_amount,
                'receiver_id' => $sender->id,
            ]);
            event(new TransactionEvent($sender, $recipient, $request->amount, $request->remarks));
        });

        return back()->with('success', 'Transfer completed successfully.');
    }
}
