<x-custom-layout>
    {{-- List of Course --}}
    <div class="row">
        @forelse($classrooms as $classroom)
            <a href="{{ route('classroom.show', $classroom) }}" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 grid-margin stretch-card text-decoration-none">
                <div class="card text-center">
                    <div class="card-body d-flex flex-column">
                      <div class="wrapper">
                        <img src="../../../assets/images/faces/face10.jpg" class="img-lg rounded-circle mb-2" alt="profile image">
                        <h4>{!! $classroom->teachers->first()->user !!}</h4>
                        <p class="text-muted">{!! $classroom->name !!}</p>
                        <p class="mt-4 card-text">{!! $classroom->description !!}</p>
                        @hasrole('teacher')
                        @if($classroom->deleted_at)
                            <button onclick="event.preventDefault(); document.getElementById('restore').submit();" class="btn btn-rounded btn-warning btn-sm mt-3 mb-4">Restore</button>

                            <form id="restore" action="{{ route('restore', $classroom) }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        @endif
                        @endhasrole
                      </div>
                    </div>
                </div>
            </a>
        @empty
            No Data
        @endforelse
    </div>
</x-custom-layout>
