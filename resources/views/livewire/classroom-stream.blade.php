<div>
    @foreach($posts as $post)
    @if($post->type == 'Post')
        <div class="d-flex align-items-start profile-feed-item mt-3">
            <img src="{!! $post->users->profile_photo_url !!}" alt="profile" class="img-sm rounded-circle">
            <div class="ml-4">
            <h6>
                <a href="{{ route('post.show', [$post,$classroom]) }}">{!! $post->users->name !!}</a>
                <small class="ml-4 text-muted"><i class="fa fa-clock-o mr-1"></i>{!! $post->created_at->diffForHumans() !!}</small>
            </h6>
            <p>
                {!! $post->body !!}
            </p>
            @foreach ($post->media as $media)
                <a href="{{ route('download.file', $media) }}">
                    <div class="btn btn-outline-primary file-icon mr-3">
                        @if($media->mime_type == 'image/jpeg')
                            <i class="mdi mdi-file-image"></i>
                        @elseif ($media->mime_type == 'application/pdf')
                            <i class="mdi mdi-file-pdf"></i>
                        @else
                            <i class="mdi mdi-folder"></i>
                        @endif
                    </div>
                </a>
            @endforeach
            </div>
        </div>
    @endif

    {{--  <div class="stage-wrapper pl-4 p-2 mt-2 rounded">
        <div class="stages pl-5 ">
          <div class="stage-badge">
            <img class="img-sm rounded-circle" src="{!! $post->users->profile_photo_url !!}" alt="profile image">
          </div>
          <p>{!! $post->body !!}</p>
          <div class="file-icon-wrapper">
            @foreach ($post->media as $media)
                <a href="{{ route('download.file', $media) }}">
                    <div class="btn btn-outline-primary file-icon mr-3">
                        @if($media->mime_type == 'image/jpeg')
                            <i class="mdi mdi-file-image"></i>
                        @elseif ($media->mime_type == 'application/pdf')
                            <i class="mdi mdi-file-pdf"></i>
                        @else
                            <i class="mdi mdi-folder"></i>
                        @endif
                    </div>
                </a>
            @endforeach
            <div id="profile-list-left" class="py-2">
                    @foreach ($post->comments as $comment)
                        <div class="card rounded mb-1">
                            <div class="card-body p-2">
                                <div class="media">
                                    <img src="{!! $comment->user->profile_photo_url !!}" alt="image" class="img-sm mr-3 rounded-circle">
                                    <div class="media-body">
                                        <h6 class="mb-1">{!! $comment->user->name !!}</h6>
                                        <p class="mb-0 text-muted">{!! $comment->body !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
            <div class="form-group">
                <input class="form-control" type="text" wire:keydown.enter="comment('{{ $post->id }}')" wire:model="postComment" placeholder="What's on your mind?">
            </div>
          </div>
        </div>
    </div>  --}}
    @endforeach
</div>
