<div class="profile-feed">
    @foreach($posts as $post)
        @if($post->type == 'Activity')
            <div class="d-flex align-items-start profile-feed-item mt-3">
                <img src="{!! $post->users->profile_photo_url !!}" alt="profile" class="img-sm rounded-circle">
                <div class="ml-4">
                <h6>
                    <a href="{{ route('post.show', [$post, $classroom]) }}">{!! $post->users->name !!}</a>
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
    @endforeach
</div>
