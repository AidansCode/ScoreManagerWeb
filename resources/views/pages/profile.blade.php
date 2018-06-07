@extends('layouts.app')

@section('title')
    My Profile
@endsection

@section('content')
    <button type="button" class="btn btn-primary btn-lg float-md-right mt-2" data-toggle="modal" data-target="#registerAppModal">
        Register App
    </button>
    <h1 class="display-4">Hello, {{$user->name}}!</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="api-key"><h1>API Key:</h1></label>
                <input type="text" id="api-key" class="form-control" value="{{$user->api_key}}" readonly>
                <button class="btn btn-info mt-3" id="copy-api-key-btn" onclick="copyApiKey()">Copy Key</button>
            </div>
            <hr class="d-md-none">
        </div>
        <div class="col-md-6">
            <h1>My Apps</h1>
            @if(count($apps) == 0)
                <h3>You don't have any apps registered! Make one?</h3>
            @else
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>View</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($apps as $app)
                        <tr>
                            <td>{{ $app->id }}</td>
                            <td>{{ $app->name }}</td>
                            <td>{{ $app->created_at }}</td>
                            <td><a href="/app/{{$app->id}}" class="btn btn-info btn-sm">View</a></td>
                            <td>
                                {!! Form::open(['action' => ['AppController@destroy', $app->id], 'method' => 'DELETE']) !!}
                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="modal fade" id="registerAppModal" tabindex="-1" role="dialog" aria-labelledby="registerAppModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerAppModalLabel">Register New App</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => 'AppController@store']) !!}
                    <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('name', 'App Name') }}
                                {{ Form::text('name', '', ['class' => 'form-control']) }}
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        {{ Form::submit('Register App', ['class' => 'btn btn-primary']) }}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('jscript')
    <script>
        function copyApiKey() {
            /* Get the text field */
            var copyText = $('#api-key');

            /* Select the text field */
            copyText.select();

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Show success notification to user */
            $(copyText).notify(
                "You have copied the API key to your clipboard",
                //"success",
                {
                    position: "bottom right",
                    className: "success"
                }
            );
        }
    </script>
@endsection
