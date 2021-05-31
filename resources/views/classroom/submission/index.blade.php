@extends('classroom.template.classroom-template')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>File</th>
            <th>Created_at</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($submission as $submission)
                <tr>
                    <td>
                        <a href="{{ route('submission.show-specific', $submission) }}">{{ $submission->user->name }}</a>
                    </td>
                    <td>
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
                    <td
                    data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ $submission->created_at }}">{{ $submission->created_at->diffForHumans() }}</td>
                </tr>
            @empty
                No Data
            @endforelse
        </tbody>
    </table>
@endsection
