<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show user profile page
     */
    public function show()
    {
        $user = Auth::user();
        $transactions = $user->transactions()->latest()->paginate(10);

        return view('profile.show', compact('user', 'transactions'));
    }

    /**
     * Show edit profile form
     */
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        Auth::user()->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Show change password form
     */
    public function editPassword()
    {
        return view('profile.edit-password');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('profile.show')->with('success', 'Password berhasil diubah');
    }

    /**
     * Show wallet/balance history
     */
    public function wallet()
    {
        $user = Auth::user();
        $transactions = $user->transactions()->where('status', 'completed')->latest()->paginate(20);
        $totalSpent = $user->transactions()->where('status', 'completed')->sum('total_price');

        return view('profile.wallet', compact('user', 'transactions', 'totalSpent'));
    }
}
