<x-custom-layout>
    <div class="row">

        <!-- Create Classroom -->
        @hasrole('teacher')
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Create Classroom</h4>
                <form method="POST" action="{{ route('classroom.store') }}" class="forms-sample">
                    @csrf

                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label> <textarea class="form-control" name="description" rows="2"></textarea> </div>
                    <button type="submit" class="btn btn-success mr-2">Create</button>
                </form>
              </div>
            </div>
        </div>

        @else
        <!-- Join Classroom -->
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Join Classroom</h4>
                <form method="POST" action="{{ route('classroom.join') }}" class="forms-sample">
                    @csrf
                    <div class="form-group">
                      <label for="name">Code</label>
                      <input type="text" class="form-control" name="code" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Join</button>
                </form>
              </div>
            </div>
        </div>
        @endhasrole
    </div>
</x-custom-layout>

