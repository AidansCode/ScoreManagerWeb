@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <div class="jumbotron text-center py-5">
        <h1 class="font-weight-bold">Welcome to ScoreManager</h1>
        <h4>ScoreManager is a light-weight solution for recording high scores and records in your Java app!</h4>
        <hr>
        @guest
            <h5>Log In or Register to Get Started</h5>
            <a href="/login" class="btn btn-primary btn-lg mr-3">Log In</a>
            <a href="/register" class="btn btn-success btn-lg">Register</a>
        @else
            <a href="/docs" class="btn btn-link">You're already logged in! Go to the docs to get started.</a>
        @endguest
    </div>
@endsection
