<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\UserAccounts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        $teachers = Teacher::query()
            ->with('userAccount')
            ->latest()
            ->paginate(10);

        return view('teacher.index', compact('teachers'));
    }

    public function create(): View
    {
        return view('teacher.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['nullable', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('teachers', 'email'),
                Rule::unique('user_accounts', 'email'),
            ],
            'contactno' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('user_accounts', 'username')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($data): void {
            $account = UserAccounts::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'teacher',
                'is_active' => true,
                'must_change_password' => true,
            ]);

            Teacher::create([
                'fname' => $data['fname'],
                'mname' => $data['mname'] ?? null,
                'lname' => $data['lname'],
                'email' => $data['email'],
                'contactno' => $data['contactno'],
                'user_account_id' => $account->id,
            ]);
        });

        return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
    }

    public function show(Teacher $teacher): View
    {
        $teacher->load('userAccount');

        return view('teacher.show', compact('teacher'));
    }

    public function edit(Teacher $teacher): View
    {
        $teacher->load('userAccount');

        return view('teacher.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $teacher->load('userAccount');

        $data = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['nullable', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('teachers', 'email')->ignore($teacher->id),
                Rule::unique('user_accounts', 'email')->ignore($teacher->user_account_id),
            ],
            'contactno' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('user_accounts', 'username')->ignore($teacher->user_account_id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($data, $teacher): void {
            $teacher->userAccount?->update(array_filter([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => filled($data['password'] ?? null) ? Hash::make($data['password']) : null,
                'must_change_password' => filled($data['password'] ?? null) ? true : null,
            ], fn ($value) => ! is_null($value)));

            $teacher->update([
                'fname' => $data['fname'],
                'mname' => $data['mname'] ?? null,
                'lname' => $data['lname'],
                'email' => $data['email'],
                'contactno' => $data['contactno'],
            ]);
        });

        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        DB::transaction(function () use ($teacher): void {
            $account = $teacher->userAccount;
            $teacher->delete();
            $account?->delete();
        });

        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully.');
    }
}
