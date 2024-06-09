<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile()
    {

        $user = Auth::user();

        return view('profile', compact('user'));
    }

    public function editProfile()
    {

        $user = Auth::user();

        return view('editProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();

        return redirect('/profile')->with('success', 'User Profile Updated Successfully.');
    }
}
