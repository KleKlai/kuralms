<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Comments;

class ClassroomStream extends Component
{
    use WithFileUploads;

    public $file;
    public $newPost = '';
    public $classroom;
    public $teacher;
    public $postComment = '';

    public $perPage = 8;

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        $this->perPage = $this->perPage + 5;
    }

    public function resetFieldPost()
    {
        $this->file = null;
        $this->newPost = '';
    }

    public function resetFieldComment()
    {
        $this->postComment = '';
    }

    public function store()
    {
        $post = Post::create([
            'user_id'   => \Auth::id(),
            'body'      => $this->newPost,
            'type'      => 'post'
        ]);

        $post->classrooms()->attach($this->classroom->id);

        if(!empty($this->file)){
            $filename = $this->file->store('post');
            $filename = explode("/", $filename);
            $post->addMedia(storage_path("app\\post\\".$filename[1]))->toMediaCollection('attachment');
        }

        $this->resetFieldPost();
    }

    public function comment($onPost)
    {
        $data = Comments::create([
            'on_post'   => $onPost,
            'from_user' => \Auth::id(),
            'body'      => $this->postComment,
        ]);

        $this->resetFieldComment();
    }

    public function render()
    {
        return view('livewire.classroom-stream',[
            'posts' => Post::with('users', 'comments', 'media')->whereHas('classrooms', function ($query) {
                return $query->where('classrooms.id', $this->classroom->id);
            })->latest()->paginate($this->perPage),
        ]);
    }
}
