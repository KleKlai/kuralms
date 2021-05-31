@extends('classroom.template.classroom-template')

@section('content')
    <form method="POST" action="{{ route('post.update', $post) }}" class="forms-sample" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <textarea class="form-control" name="description" rows="5" placeholder="Write something here...">{!! $post->body !!}</textarea>
        </div>
        <button type="submit" class="btn btn-success mr-2">Save</button>
    </form>
@endsection
