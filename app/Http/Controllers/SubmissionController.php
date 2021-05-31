<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Classroom;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        dd();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        $classroom = $post->classrooms->first();
        $teacher = $classroom->teachers->first();

        return view('classroom.page.create-submission', compact('post', 'classroom', 'teacher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'file'  => 'required'
        ]);

        $submission = Submission::create([
            'on_post'       => $post->id,
            'on_classroom'  => $post->classrooms->first()->id,
            'from_user' => \Auth::id(),
        ]);

        //Attach Media File to this post
        if($request->hasFile('file')){
            foreach($request->file as $file){
                $submission->addMedia($file)->toMediaCollection('Submission');
            }
        }
        $user = $post->classrooms->first()->teachers->first();

        $details = [
            'header' => $request->type,
            'body' => \Auth::user()->name . ' submitted new assignment',
        ];

        $user->notify(new \App\Notifications\newPost($details));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        $classroom = $submission->classroom;
        $teacher = $submission->classroom->teachers->first();

        return view('classroom.submission.show', compact('classroom','teacher','submission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submission $submission)
    {
        $request->validate([
            'grade'     => 'required',
            'remark'    => 'nullable'
        ]);

        $submission->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submission $submission)
    {
        $classroom = $submission->classroom;
        $submission->delete();

        return redirect()->route('management.index', ['FLbmsVID2kf0', $classroom]);
    }

    public function postSubmission(Post $post)
    {
        $classroom = $post->classrooms->first();
        $teacher = $classroom->teachers->first();
        $submission = $post->submissions;

        return view('classroom.submission.index', compact('classroom', 'teacher', 'submission'));
    }
}
