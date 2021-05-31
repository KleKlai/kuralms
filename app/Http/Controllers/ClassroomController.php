<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassroom;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Http;
use App\Notifications\newPost;

class ClassroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role_or_permission:teacher|student']);
    }

    public function index()
    {
        $classrooms = Classroom::archive(false)->whereHas('users', function ($query) {
            return $query->where('users.id', auth()->user()->id);
        })->get();

        return view('home', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classroom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classroom = Classroom::create([
            'code'          => Str::random(6),
            'name'          => $request->name,
            'description'   => $request->description
        ]);

        $classroom->users()->attach(auth()->user(), ['is_teacher' => true]);

        return redirect()->route('classroom.show', $classroom);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        $classroom = Classroom::withTrashed()->where('id', $classroom->id)->with('users','teachers','students')->first();

        $users = $classroom->users;
        $teacher = $classroom->teachers->first();
        $students = $classroom->students;

        if(!$users->contains(\Auth::id())){
            return redirect()->route('dashboard');
        }

        $posts = Post::with('users', 'media')->whereHas('classrooms', function ($query) use ($classroom){
            return $query->where('classrooms.id', $classroom->id);
        })->latest()->get();

        return view('classroom.show', compact('classroom', 'users', 'teacher', 'students', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //s
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect()->route('classroom.index');
    }

    public function join(Request $request)
    {
        $classroom = Classroom::where('code', $request->code)->first();
        $grade = Grade::create([
            'on_classroom'  => $classroom->id,
            'from_user'     => \Auth::id(),
        ]);

        $classroom->users()->attach(auth()->user());

        return redirect()->route('classroom.show', $classroom);
    }

    public function unenroll(User $user, Classroom $classroom)
    {

        $classroom->users()->detach($user);

        $teacher = $classroom->teachers->first();

        $details = [
            'header' => 'Student Drop',
            'body' => \Auth::user()->name . ' unenroll classroom ' . $classroom->name,
        ];

        $teacher->notify(new \App\Notifications\newPost($details));

        return redirect()->route('classroom.index');
    }

    public function indexArchive()
    {
        $classrooms = Classroom::archive(true)->whereHas('users', function ($query) {
            return $query->where('users.id', auth()->user()->id);
        })->withTrashed()->get();

        return view('classroom.archive', compact('classrooms'));
    }

    public function archive(Classroom $classroom)
    {
        $classroom->update([
            'archive' => !$classroom->archive,
        ]);

        return back();
    }
}
