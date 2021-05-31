
@forelse ($data->comments as $data)
    <div class="d-flex align-items-start profile-feed-item mt-3">
        <img src="{!! $data->user->profile_photo_url !!}" alt="profile" class="img-sm rounded-circle">
        <div class="ml-4">
        <h6>
            {!! $data->user->name !!}
            <small class="ml-4 text-muted"><i class="fa fa-clock-o mr-1"></i>{!! $data->created_at->diffForHumans() !!}</small>
        </h6>
        <p>
            {!! $data->body !!}
        </p>

        </div>
    </div>
@empty

@endforelse

<input type="text" wire:keydown.enter="storeComment('{{ $data->id }}')" wire:model="newComment" class="form-control" placeholder="Add comment">

