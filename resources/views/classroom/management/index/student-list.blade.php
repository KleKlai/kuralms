<div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($classroom->students as $key => $student)
              <tr>
                  <td>{{ $key+1 }}</td>
                  <td>
                  <div class="d-flex align-items-center">
                      <img class="img-xs rounded-circle" src="{{ $student->profile_photo_url }}" alt="profile image">
                      <div class="wrapper pl-2">
                      <p class="mb-0 text-gray">{{ $student->name }}</p>
                      <small class="mb-0 text-muted">
                          @foreach($student->getRoleNames() as $role)
                              {{ $role }}
                          @endforeach
                      </small>
                      </div>
                  </div>
                  </td>
                  <td>
                    <button data-toggle="modal" data-target="#deleteStudent" class="btn btn-outline-danger">Remove</button>
                    {{-- <a href="{{ route('management.studentSubmissions', [$classroom, $student]) }}"  class="btn btn-outline-info">Expand</a> --}}
                  </td>
              </tr>

              <div class="modal fade" id="deleteStudent" tabindex="-1" role="dialog" aria-labelledby="deleteStudentLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteStudentLabel">Delete Post</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-center">
                      <p>Are you sure you want to remove this student?</p>
                      <p class="mt-3">This cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('management.removeStudent', [$classroom, $student]) }}" type="button" type="button" class="btn btn-success">Confirm</a>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
            </div>
          @endforeach
      </tbody>
    </table>
</div>


