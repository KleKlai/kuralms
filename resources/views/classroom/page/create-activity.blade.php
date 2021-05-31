@extends('classroom.template.classroom-template')

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

@section('content')
<form method="POST" action="{{ route('post.activity.store', $classroom) }}" class="forms-sample" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <textarea class="form-control" name="description" rows="5" placeholder="Write something here..."></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Attachment</label>
        <input type="file" name="file[]" class="dropify" multiple/>
    </div>
    <h5>Due Date</h5>
    <hr>
    <div class="form-group">
        <label for="exampleFormControlFile1">Date</label>
        <div id="datepicker-popup" class="input-group date datepicker">
          <input type="text" class="form-control" name="date" autocomplete="off"/>
          <span class="input-group-addon input-group-append border-left">
            <span class="mdi mdi-calendar input-group-text"></span>
          </span>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Time</label>
        <div class="input-group date" id="timepicker-example" data-target-input="nearest">
          <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
            <input type="text" class="form-control datetimepicker-input" name="time" data-target="#timepicker-example" autocomplete="off"/>
            <div class="input-group-addon input-group-append">
              <i class="mdi mdi-clock input-group-text"></i>
            </div>
          </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success mr-2">Publish</button>
</form>
@endsection

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
