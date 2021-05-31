<div class="table-responsive">
    <table id="order-listing" class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>1st</th>
        <th>2nd</th>
        <th>3rd</th>
        <th>4th</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($classroom->grades as $grade)

            <tr>
                <td>{{ $grade->user->name }}</td>
                <td>{{ $grade->first }}</td>
                <td>{{ $grade->second }}</td>
                <td>{{ $grade->third }}</td>
                <td>{{ $grade->fourth }}</td>
                <td>
                    <a href="{{ route('grade.edit', $grade) }}" role="button" class="btn btn-outline-primary">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>


