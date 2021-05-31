@hasrole('teacher')
<div class="dropdown">
    <button class="btn btn-success btn-block mb-2 dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Create </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <a class="dropdown-item" href="{{ route('post.create.view', [$classroom, 'Post']) }}">Announcement</a>
        <a class="dropdown-item" href="{{ route('post.activity.view', $classroom) }}">Activity</a>
        <a class="dropdown-item" href="{{ route('post.create.view', [$classroom, 'Material']) }}">Material</a>
    </div>
</div>
@endhasrole
