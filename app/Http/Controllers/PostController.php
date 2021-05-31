<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Notifications\newPost;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $post = Post::with('users', 'comments', 'media')->get();
        dd($post);
    }

    public function create(Classroom $classroom, $type)
    {
        $teacher = $classroom->teachers->first();

        return view('classroom.page.create-post', compact('classroom', 'teacher', 'type'));
    }

    public function store(Request $request, Classroom $classroom)
    {
        $post = Post::create([
            'user_id'   => \Auth::id(),
            'body'  => $request->description,
            'type'  => $request->type,
        ]);

        //Attach Classroom model to this post
        $post->classrooms()->attach($classroom);

        //Attach Media File to this post
        if($request->hasFile('file')){
            foreach($request->file as $file){
                $post->addMedia($file)->toMediaCollection($request->type);
            }
        }

        foreach ($classroom->students as $user){
            $details = [
                'header' => $request->type,
                'body' => \Auth::user()->name . ' created new ' . $request->type . '.',
            ];

            $user->notify(new \App\Notifications\newPost($details));
        }

        return redirect()->route('classroom.show', $classroom);
    }

    public function show(Post $post, Classroom $classroom)
    {
        //TODO: check if the user already submitted the activity
        // $data = Submission::where('on_post', $post->id)->where('from_user', \Auth::id())->get();
        $submission = Submission::Activity($post->id)->get();

        $teacher = $classroom->teachers->first();

        return view('classroom.page.show-post', compact('post', 'classroom', 'teacher', 'submission'));
    }

    public function edit(Post $post, Classroom $classroom)
    {

        $teacher = $classroom->teachers->first();

        return view('classroom.page.edit', compact('post', 'classroom', 'teacher'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update([
            'body'  => $request->description,
        ]);

        $classroom = $post->classrooms->first();

        \Session::flash('success', 'Post updated successfully');

        return redirect()->route('post.show', [$post, $classroom]);
    }

    public function destroy(Post $post)
    {
        $classroom = $post->classrooms->first();

        $post->delete();

        \Session::flash('success', 'Post deleted successfully!');

        return redirect()->route('classroom.show', $classroom);
    }

    public function indexMaterial(Classroom $classroom)
    {
        $teacher = $classroom->teachers->first();
        $posts = Post::with('users', 'comments', 'media')->where('type', 'material')->whereHas('classrooms', function ($query) use ($classroom){
            return $query->where('classrooms.id', $classroom->id);
        })->latest()->get();

        return view('classroom.show-materials', compact('posts', 'classroom', 'teacher'));
    }

    public function createActivity(Classroom $classroom)
    {
        $teacher = $classroom->teachers->first();

        return view('classroom.page.create-activity', compact('teacher', 'classroom'));
    }

    public function storeActivity(Request $request, Classroom $classroom)
    {
        $post = Post::create([
            'user_id'   => \Auth::id(),
            'body'      => $request->description,
            'type'      => 'Activity',
            'date'      => $request->date,
            'time'      => $request->time,
        ]);

        //Attach Classroom model to this post
        $post->classrooms()->attach($classroom);

        //Attach Media File to this post
        if($request->hasFile('file')){
            foreach($request->file as $file){
                $post->addMedia($file)->toMediaCollection($post->type);
            }
        }

        return redirect()->route('classroom.show', $classroom);
    }

    public function indexActivity(Classroom $classroom)
    {
        $teacher = $classroom->teachers->first();
        $posts = Post::with('users', 'comments', 'media')->where('type', 'Activity')->whereHas('classrooms', function ($query) use ($classroom){
            return $query->where('classrooms.id', $classroom->id);
        })->latest()->get();

        return view('classroom.show-activity', compact('posts', 'classroom', 'teacher'));
    }
}
