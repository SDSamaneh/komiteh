<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|persian_alpha|min:3|max:255',
            'idCard' => 'required|ir_national_id|unique:users,idCard,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|ir_mobile',
            'password' => 'nullable|string|min:4|confirmed',
        ]);

        $user->name = $request->name;
        $user->idCard = $request->idCard;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        // اگر کاربر پسورد وارد کرده بود
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'پروفایل با موفقیت بروزرسانی شد.');
    }
}
