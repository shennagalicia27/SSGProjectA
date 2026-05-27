<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $sessionUser = $request->session()->get('user_account');

        return match ($sessionUser['role']) {
            'student' => $this->studentDashboard($sessionUser['id']),
            'teacher' => $this->teacherDashboard($sessionUser['id']),
            default => $this->adminDashboard(),
        };
    }

    protected function studentDashboard(int $userAccountId): View
    {
        $student = Student::query()
            ->with(['degree', 'userAccount'])
            ->where('user_account_id', $userAccountId)
            ->firstOrFail();

        return view('dashboard.student', compact('student'));
    }

    protected function teacherDashboard(int $userAccountId): View
    {
        $teacher = Teacher::query()
            ->with('userAccount')
            ->where('user_account_id', $userAccountId)
            ->firstOrFail();

        return view('dashboard.teacher', compact('teacher'));
    }

    protected function adminDashboard(): View
    {
        $stats = [
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'degrees' => Degree::count(),
            'active_accounts' => \App\Models\UserAccounts::query()->where('is_active', true)->count(),
        ];

        return view('dashboard.admin', compact('stats'));
    }
}
