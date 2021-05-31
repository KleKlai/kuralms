<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comments;

class PostComment extends Component
{
    public $postID;
    public $newComment;

    public function resetField()
    {
        $this->newComment;
    }

    public function storeComment($onPost)
    {
        Comments::create([
            'on_post'   => $onPost,
            'from_user' => \Auth::id(),
            'body'      => $this->newComment,
        ]);

        $this->resetField();
    }

    public function render()
    {
        return view('livewire.post-comment',[
            'data' => Post::where('id', $this->postID)->with('comments')->latest()->first(),
        ]);
    }
}
