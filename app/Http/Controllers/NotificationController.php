<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fund;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notification()
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

        return view('notification', compact('data', 'users', 'funds'));
    }

    public function markAsRead(Request $request)
    {
        $notification = auth()->user()->notifications()->findOrFail($request->id);

        if ($notification->read_at === null) {
            $notification->markAsRead();
        }

        return response()->json(['status' => 'success']);
    }
}
