@extends('layouts.app')

@section('title')
    Docs
@endsection

@section('content')
    <h1 class="bold text-center" style="font-size: 6vw;">ScoreManagerClient Docs<br/>(v1.1-beta)</h1>
    <hr class="my-0">
    <h1 class="mt-3">ScoreManager.java</h1>
    <h2>public ScoreManager(final String apiKey, int appId)</h2>
    <div class="border-left border-dark">
        <h5 class="ml-4">
            <p>Arguments:</p>
            <ul>
                <li>final String apiKey: The API key for your user account</li>
                <li>int appId: The app ID of your ScoreManager registered app</li>
            </ul>
            <p>Return: N/A</p>
            <p>Description: Constructor of ScoreManager class. Creates a new instance of ScoreManager</p>
            <p>Throws: N/A</p>
        </h5>
    </div>

    <h2>public ArrayList{{ "<Record>" }} requestRecords()</h2>
    <div class="border-left border-dark">
        <h5 class="ml-4">
            <p>Arguments: N/A</p>
            <p>Return: ArrayList{{ "<Record>" }}</p>
            <p>Description: Gathers and returns an ArrayList of all the app's records in order, descending</p>
            <p>Throws: APIException, a RuntimeException, if API call fails or returns with an error.</p>
        </h5>
    </div>

    <h2>public void submitRecord(String name, int score)</h2>
    <div class="border-left border-dark">
        <h5 class="ml-4">
            <p>Arguments:</p>
            <ul>
                <li>String name: The name of the holder of the record being added</li>
                <li>int score: The score of the record being added</li>
            </ul>
            <p>Return: N/A</p>
            <p>Description: Submits a new record to the app's list of records.</p>
            <p>Throws: APIException, a RuntimeException, if API call fails or returns with an error.</p>
        </h5>
    </div>
@endsection
