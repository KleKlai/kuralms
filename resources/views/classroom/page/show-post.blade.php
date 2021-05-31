@extends('classroom.template.classroom-template')

@if($submission->isEmpty())
@section('css')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/bars-1to10.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/bars-horizontal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/bars-movie.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/bars-pill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/bars-reversed.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/bars-square.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/bootstrap-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/css-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/examples.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/fontawesome-stars-o.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-bar-rating/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-asColorPicker/css/asColorPicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/x-editable/bootstrap-editable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-file-upload/uploadfile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}">
    <!-- End Plugin css for this page -->
@endsection
@endif

@section('content')
{{--  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="{{ route('classroom.index') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
        <a href="{{ route('classroom.show', $classroom) }}">Classroom</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Post</li>
    </ol>
</nav>  --}}
@hasrole('teacher')
    <div class="btn-group" role="group" aria-label="Basic example">
        <button class="btn btn-outline-secondary"
        data-toggle="modal" data-target="#exampleModal"><i class="mdi mdi-delete"></i></button>

        <a href="{{ route('post.edit', [$post, $classroom]) }}" type="button" class="btn btn-outline-secondary"
        data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="mdi mdi-pen"></i></a>

        <a href="{{ route('submission.post.index', $post) }}" type="button" class="btn btn-outline-secondary"
        data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Submission"><i class="mdi mdi-file"></i></a>
    </div>

@endhasrole

<div class="profile-feed">
    <div class="d-flex align-items-start profile-feed-item mt-3 mb-3">
        <img src="{!! $post->users->profile_photo_url !!}" alt="profile" class="img-sm rounded-circle">
        <div class="ml-4">
            <h6>
            {!! $post->users->name !!}
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
    @if($post->type == 'Activity')
        @if($submission->isEmpty())
            @hasrole('student')
                <div class="accordion basic-accordion mt-3" id="accordion" role="tablist">
                    <div class="card">
                    <div class="card-header" role="tab" id="headingThree">
                        <h6 class="mb-0">
                        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="card-icon mdi mdi-message-text-outline"></i>Add Submission?</a>
                        </h6>
                    </div>
                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <form method="POST" action="{{ route('submission.store', $post) }}" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Attachment</label>
                                    <input type="file" name="file[]" class="dropify" multiple required/>
                                </div>
                                <button type="submit" class="btn btn-success mr-2">Submit</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            @endhasrole
        @else
        <div class="alert alert-fill-success" role="alert">
            <i class="mdi mdi-alert-circle"></i> Well done! You successfully submit.
        </div>
        Remark: {{ $submission->first()->remark ?? '' }}
        <br/>
        Grade: {{ $submission->first()->grade ?? '' }}
        @endif
    @endif
    <hr>
    <h4>Comment</h4>
    <livewire:post-comment :postID="$post->id"/>
</div>
@endsection

@if($submission->isEmpty())
@section('script')
<!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-asColor/jquery-asColor.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-asGradient/jquery-asGradient.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-asColorPicker/jquery-asColorPicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/x-editable/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-file-upload/jquery.uploadfile.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/shared/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/shared/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/shared/misc.js') }}"></script>
    <script src="{{ asset('assets/js/shared/settings.js') }}"></script>
    <script src="{{ asset('assets/js/shared/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/shared/formpickers.js') }}"></script>
    <script src="{{ asset('assets/js/shared/form-addons.js') }}"></script>
    <script src="{{ asset('assets/js/shared/x-editable.js') }}"></script>
    <script src="{{ asset('assets/js/shared/inputmask.js') }}"></script>
    <script src="{{ asset('assets/js/shared/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/shared/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/shared/jquery-file-upload.js') }}"></script>
    <script src="{{ asset('assets/js/shared/form-repeater.js') }}"></script>
    <!-- End custom js for this page -->
@endsection
@endif

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <p>Are you sure you want to delete this post?</p>
          <p class="mt-3">This cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <a href="{{ route('post.delete', $post) }}" type="button" onclick="event.preventDefault(); document.getElementById('post-delete').submit();" type="button" class="btn btn-success">Confirm</a>

            <form id="post-delete" action="{{ route('post.delete', $post) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>
