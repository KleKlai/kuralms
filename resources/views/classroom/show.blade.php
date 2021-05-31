<x-custom-layout>

    <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4">
                <div class="border-bottom text-center pb-4">
                  <img src="{!! $teacher->profile_photo_url !!}" alt="profile" class="img-lg rounded-circle mb-3">
                  <div class="mb-3">
                    <h3>{!! $teacher->name !!}</h3>
                    <div class="d-flex align-items-center justify-content-center">
                      <h5 class="mb-0 mr-2 text-muted">{!! $classroom->name !!}</h5>
                    </div>
                  </div>
                  <p class="w-75 mx-auto mb-3">{!! $classroom->description ?? '' !!}</p>
                </div>
                <div class="py-4">
                    {{--  <p class="clearfix text-center">
                        <a href="https://meet.google.com/ugx-icgu-ump" target="_blank" class="btn btn-block btn-secondary ">
                            {{ 'https://meet.google.com/ugx-icgu-ump' }}
                        </a>
                    </p>  --}}
                    <p class="clearfix">
                        <span class="float-left">
                        Status
                        </span>
                        <span class="float-right text-muted">
                            @hasrole('teacher')
                            <a href="{{ route('classroom.archive', $classroom) }}">
                                {!! ($classroom->archive) ? 'un - ' : ''; !!} Archive
                            </a>
                            @endhasrole
                            @hasrole('student')
                                Active
                            @endhasrole
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                        Phone
                        </span>
                        <span class="float-right text-muted">
                        0995-224-7045
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                        Mail
                        </span>
                        <span class="float-right text-muted">
                        {!! $teacher->email !!}
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                        Code
                        </span>
                        <span class="float-right text-muted">
                        <a href="#">{!! $classroom->code !!}</a>
                        </span>
                    </p>
                </div>
                @if($classroom->archive)
                    @hasrole('teacher')
                         <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#exampleModal">
                            Delete <i class="mdi mdi-delete ml-1"></i>
                         </button>
                    @endhasrole
                @endif
                @hasrole('student')
                    <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#unenroll">
                        Drop
                    </button>
                @endhasrole
                @hasrole('teacher')
                <div class="dropdown">
                    <button class="btn btn-success btn-block mb-2 dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Create </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <a class="dropdown-item" href="{{ route('post.create.view', [$classroom, 'Post']) }}">Announcement</a>
                        <a class="dropdown-item" href="{{ route('post.activity.view', $classroom) }}">Activity</a>
                        <a class="dropdown-item" href="{{ route('post.create.view', [$classroom, 'Material']) }}">Material</a>
                    </div>
                </div>
                <a href="{{ route('management.index', [Str::random(150),$classroom]) }}" class="btn btn-success btn-block mb-2">Management</a>
                @endhasrole
              </div>
              <div class="col-lg-8">
                <div class="">
                    <ul class="nav nav-tabs tab-basic" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#whoweare" role="tab" aria-controls="whoweare" aria-selected="true">Announcement</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ourgoal" role="tab" aria-controls="ourgoal" aria-selected="false">Activity</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">Materials</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-content-basic">
                      <div class="tab-pane fade show active" id="whoweare" role="tabpanel" aria-labelledby="home-tab">
                        <div class="profile-feed">
                            <livewire:classroom-stream :classroom="$classroom" :teacher="$teacher"/>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="ourgoal" role="tabpanel" aria-labelledby="profile-tab">
                        @include('classroom.index-activity')
                      </div>
                      <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="contact-tab">
                        @include('classroom.index-materials')
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Classroom</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <p>Are you sure you want to delete this classroom? All materials and student submission will be delete after 30days.</p>
              <p class="mt-3">This cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('classroom.destroy', $classroom) }}" onclick="event.preventDefault(); document.getElementById('destroy-classroom').submit();" type="button" class="btn btn-success">Confirm</a>

                <form id="destroy-classroom" action="{{ route('classroom.destroy', $classroom) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="unenroll" tabindex="-1" role="dialog" aria-labelledby="exampleunenroll" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleunenroll">Delete Classroom</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <p>Are you sure you want to drop this classroom? All of your materials and submission will be delete after 30days.</p>
              <p class="mt-3">This cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('classroom.unenroll', [Auth::user(), $classroom]) }}"  type="button" class="btn btn-success">Confirm</a>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
    </div>

    @section('script')
    <script type="text/javascript">
        window.onscroll = function(ev) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                window.livewire.emit('load-more');
            }
        };
   </script>
    @endsection
</x-custom-layout>
