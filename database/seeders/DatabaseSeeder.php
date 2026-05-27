<?php

namespace Database\Seeders;

use App\Models\Degree;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserAccounts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        UserAccounts::query()->firstOrCreate(
            ['username' => env('ADMIN_USERNAME', 'admin')],
            [
                'email' => env('ADMIN_EMAIL', 'admin@example.com'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin12345')),
                'role' => 'admin',
                'is_active' => true,
                'must_change_password' => false,
            ]
        );

        $user = User::query()->firstOrCreate(
            ['email' => 'shenna@example.com'],
            [
                'name' => 'shenna',
                'password' => Hash::make('password123'),
            ]
        );

        DB::table('profiles')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'bio' => 'time to learn Laravel',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('posts')->updateOrInsert(
            ['user_id' => $user->id, 'title' => 'Welcome to Laravel'],
            [
                'content' => 'Welcome to Laravel',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $degree = Degree::query()->firstOrCreate([
            'degree_title' => 'BSIT',
        ]);

        $studentAccount = UserAccounts::query()->firstOrCreate(
            ['username' => 'shenna.student'],
            [
                'email' => 'shenna.student@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'is_active' => true,
                'must_change_password' => false,
            ]
        );

        $student = Student::query()->firstOrCreate(
            ['email' => 'shenna.student@example.com'],
            [
                'fname' => 'Shenna',
                'mname' => null,
                'lname' => 'Student',
                'user_account_id' => $studentAccount->id,
                'degree_id' => $degree->id,
                'contactno' => '09123456789',
            ]
        );

        $teacherAccount = UserAccounts::query()->firstOrCreate(
            ['username' => 'teacher.demo'],
            [
                'email' => 'teacher.demo@example.com',
                'password' => Hash::make('password123'),
                'role' => 'teacher',
                'is_active' => true,
                'must_change_password' => false,
            ]
        );

        Teacher::query()->firstOrCreate(
            ['email' => 'teacher.demo@example.com'],
            [
                'fname' => 'Demo',
                'mname' => null,
                'lname' => 'Teacher',
                'user_account_id' => $teacherAccount->id,
                'contactno' => '09987654321',
            ]
        );

        $course1Id = DB::table('courses')->where('course_name', 'ELEC 1')->value('id');

        if (! $course1Id) {
            $course1Id = DB::table('courses')->insertGetId([
                'course_name' => 'ELEC 1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $course2Id = DB::table('courses')->where('course_name', 'ELEC 2')->value('id');

        if (! $course2Id) {
            $course2Id = DB::table('courses')->insertGetId([
                'course_name' => 'ELEC 2',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $student->courses()->syncWithoutDetaching([$course1Id, $course2Id]);
    }
}
