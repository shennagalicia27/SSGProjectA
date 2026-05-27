<?php

namespace App\Http\Controllers;

use App\Models\UserAccounts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class UserController extends Controller
{
    public function showLoginForm(): View|RedirectResponse
    {
        if (Session::has('user_account')) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = UserAccounts::query()
            ->where('username', $credentials['username'])
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()->withInput($request->only('username'))->withErrors([
                'username' => 'Invalid username or password.',
            ]);
        }

        if (! $user->is_active) {
            return back()->withInput($request->only('username'))->withErrors([
                'username' => 'This account is inactive.',
            ]);
        }

        Session::put('user_account', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
            'must_change_password' => $user->must_change_password,
        ]);

        if (in_array($user->role, ['student', 'teacher'], true) && $user->must_change_password) {
            return redirect()->route('password.change.form');
        }

        return redirect()->route('dashboard');
    }

    public function logout(): RedirectResponse
    {
        Session::forget('user_account');
        Session::flush();

        return redirect()->route('login.form')->with('success', 'You have been logged out.');
    }

    public function showChangePasswordForm(): View
    {
        return view('changePassword');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $sessionUser = $request->session()->get('user_account');

        $user = UserAccounts::query()->findOrFail($sessionUser['id']);

        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (! Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        if (Hash::check($data['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'The new password must be different from the current password.',
            ]);
        }

        $user->update([
            'password' => Hash::make($data['password']),
            'must_change_password' => false,
        ]);

        Session::put('user_account', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
            'must_change_password' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Password updated successfully.');
    }
}
