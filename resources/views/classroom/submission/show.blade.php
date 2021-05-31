@extends('classroom.template.classroom-template')

@section('content')
<table class="table table-borderless w-100 mt-4">
    <tbody>
        <tr>
            <td>
                <strong>Full Name :</strong> {{ $submission->user->name }}</td>
            <td>
                <strong>File :</strong>
                @foreach ($submission->media as $media)
                <a href="{{ route('download.file', $media) }}">
                    @if($media->mime_type == 'image/jpeg')
                        <i class="mdi mdi-file-image"></i> Download
                    @elseif ($media->mime_type == 'application/pdf')
                        <i class="mdi mdi-file-pdf"></i> Download
                    @else
                        <i class="mdi mdi-folder"></i> Download
                    @endif
                </a>
                @endforeach
            </td>
        </tr>
        <tr>
        <td>
            <strong>Submitted :</strong> {{ $submission->created_at->diffForHumans() }}</td>
        <td>
            <strong>Email :</strong> {{ $submission->user->email }}</td>
        </tr>
        <tr>
    </tbody>
</table>
<form class="forms-sample mt-4" method="POST" action="{{ route('submission.update-detail', $submission) }}">
    @csrf
    @method('PATCH')

    <div class="form-group">
      <label for="exampleInputEmail1">Grade</label>
      <input type="text" class="form-control" name="grade" value="{{ $submission->grade ?? '' }}" placeholder="100/100">
    </div>
    <div class="form-group">
        <label for="exampleTextarea1">Remarks</label>
        <textarea class="form-control" name="remark" rows="2">{{ $submission->remark }}</textarea>
    </div>
    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
    <button type="button" data-toggle="modal" data-target="#destroy-submission" class="btn btn-danger mr-2">Delete</button>
</form>

<div class="modal fade" id="destroy-submission" tabindex="-1" role="dialog" aria-labelledby="destroy-submissionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="destroy-submissionLabel">Delete Student Submission</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <p>Are you sure you want to delete this submission?</p>
          <p class="mt-3">This cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <a href="{{ route('submission.delete', $submission) }}" onclick="event.preventDefault(); document.getElementById('destroy-student-submission').submit();" type="button" class="btn btn-success">Confirm</a>

            <form id="destroy-student-submission" action="{{ route('submission.delete', $submission) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>
@endsection
