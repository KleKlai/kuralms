<x-custom-layout>
    <div class="row page-title-header">
        <div class="col-md-12">
        <div class="page-header-toolbar">
            <div class="sort-wrapper">
            <a href="{{ route('classroom.create') }}" role="button" class="btn btn-primary">
                @role('teacher')
                    Create Classroom
                @else
                    Join Classroom
                @endrole
            </a>
            </div>
        </div>
        </div>
    </div>

    {{-- List of Course --}}

    <div class="row">
        @forelse($classrooms as $classroom)
            <a href="{{ route('classroom.show', $classroom) }}" class="col-xl-3 col-lg-4 col-md-4 col-sm-12 grid-margin stretch-card text-decoration-none">
                <div class="card card-statistics social-card card-default">
                    <div class="card-body">
                    <img class="d-block img-sm rounded-circle mx-auto mb-2" src="../../../assets/images/faces/face1.jpg" alt="profile image">
                    <p class="text-center user-name">{!! $classroom->name !!}</p>
                    <p class="text-center mb-2 comment">{!! $classroom->description !!}</p>
                    </div>
                </div>
            </a>
        @empty
            Insufficient Data
        @endforelse
    </div>
</x-custom-layout>
