@extends('classroom.template.classroom-template')

@section('content')
<h1>{{ $grade->user->name }}</h1>
<form method="POST" action="{{ route('grade.update', $grade) }}" class="forms-sample">
    @csrf
    @method('PATCH')

    <div class="form-group row">
        <div class="col-3">
          <label>1st Grading</label>
          <input type="number" class="form-control" name="first" value="{{ $grade->first }}">
        </div>
        <div class="col-3">
          <label>2nd Grading</label>
          <input type="number" class="form-control" name="second" value="{{ $grade->second }}">
        </div>
        <div class="col-3">
            <label>3rd Grading</label>
            <input type="number" class="form-control" name="third" value="{{ $grade->third }}">
        </div>
        <div class="col-3">
            <label>4th Grading</label>
            <input type="number" class="form-control" name="fourth" value="{{ $grade->fourth }}">
        </div>
    </div>

    <button type="submit" class="btn btn-success mr-2">Submit</button>
    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
</form>
@endsection
