<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Classroom;
use App\Models\User;
use App\Models\Grade;

class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['role_or_permission:teacher']);
    }

    public function index($token, Classroom $classroom)
    {
        $teacher = $classroom->teachers->first();

        return view('classroom.management.index', compact('classroom', 'teacher'));
    }

    public function removeStudent(Classroom $classroom, User $user)
    {
        $classroom->users()->detach($user);

        return redirect()->back();
    }

    public function showStudentSubmissions(Classroom $classroom, User $user)
    {
        $teacher = $classroom->teachers->first();

        $data = User::where('id', $user->id)->whereHas('submissions', function ($query) use ($classroom){
            return $query->where('submissions.on_classroom', $classroom->id);
        })->get();

        dd($data);
        return view('classroom.management.submission-list', compact('classroom', 'teacher'));
    }
}
