<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function userProfile()
    {
        $user = User::with('profile')->first();

        if (! $user) {
            return 'No user data found.';
        }

        if (! $user->profile) {
            return $user->name . ' has no profile yet.';
        }

        return $user->name . ' - ' . $user->profile->bio;
    }

    public function userPost()
    {
        $user = User::with('posts')->first();

        if (! $user) {
            return 'No user data found.';
        }

        if ($user->posts->isEmpty()) {
            return $user->name . ' has no posts yet.';
        }

        $output = '';

        foreach ($user->posts as $post) {
            $output .= $user->name . ': ' . $post->content . ' - ' . $post->title . '<br>';
        }

        return $output;
    }
    
    public function studentCourses()
    {
        $students = Student::with('courses')
            ->whereHas('courses')
            ->get();

        if ($students->isEmpty()) {
            return 'No student-course data found.';
        }

        $output = '';

        foreach ($students as $student) {
            foreach ($student->courses as $course) {
                $output .= $student->full_name . ' is enrolled in ' . $course->course_name . '<br>';
            }
        }

        return $output;
    }

}
