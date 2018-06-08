@extends('layouts.app')

@section('title')
    {{$app->name}} Records
@endsection

@section('content')
    <a href="/profile" class="btn btn-primary btn-lg float-right mt-2">Back</a>
    <h1 class="display-4">
        {{$app->name}} Records
    </h1>
    @if(count($records) == 0)
        <h1>Your app does not currently have any records!</h1>
    @else
        <table class="table table-striped mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $records->firstItem() + $loop->index }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->score }}</td>
                        <td>{{ $record->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/app/{{$app->id}}/reset" class="btn btn-danger">Reset Records</a>
        {{ $records->links() }}
    @endif
@endsection
