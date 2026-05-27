<?php

namespace Tests\Feature;

use App\Models\UserAccounts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_accessible(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Sign in');
    }

    public function test_admin_can_log_in_and_reach_dashboard(): void
    {
        UserAccounts::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
            'role' => 'admin',
            'is_active' => true,
            'must_change_password' => false,
        ]);

        $this->post('/login', [
            'username' => 'admin',
            'password' => 'secret123',
        ])->assertRedirect(route('dashboard'));

        $this->get('/dashboard')
            ->assertOk()
            ->assertSee('Admin Dashboard');
    }

    public function test_student_with_temporary_password_is_forced_to_change_it(): void
    {
        UserAccounts::create([
            'username' => 'student.demo',
            'email' => 'student@example.com',
            'password' => Hash::make('secret123'),
            'role' => 'student',
            'is_active' => true,
            'must_change_password' => true,
        ]);

        $this->post('/login', [
            'username' => 'student.demo',
            'password' => 'secret123',
        ])->assertRedirect(route('password.change.form'));
    }
}
