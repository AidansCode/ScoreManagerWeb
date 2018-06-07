@extends('layouts.app')

@section('title')
    Docs
@endsection

@section('content')
    <h1 class="display-3 bold text-center">ScoreManager Docs (v1.0-beta)</h1>
    <hr class="my-0">
    <h1 class="mt-3">What is ScoreManager?</h1>
    <h5>
        ScoreManager is a free service for students at Eastern HS to use to easily add a record keeping/high score feature to their programs.
    </h5>

    <h1 class="mt-3">It's free?</h1>
    <h5>
        Yes, all apps and records are stored on the server for free and can be accessed any time through the website or API.
        To keep server and storage costs down, all apps older than two months are automatically deleted along with their associated
        records. <strong>Don't use this service for production apps.</strong>
    </h5>

    <h1 class="mt-3">How do I set it up?</h1>
    <h5>
        <ol>
            <li>Register an account on the website <a href="{{ route('login') }}" target="_blank">here</a> if you haven't already</li>
            <li>Go to your profile page <a href="{{ route('pages.profile') }}" target="_blank">here</a></li>
            <li>
                Click "Register App"
                <ol>
                    <li>Give your app a name</li>
                    <li>Click "Register App"</li>
                </ol>
            </li>
            <li>
                Add the client .jar to your Java project
                <ol>
                    <strong>Steps for Eclipse Users</strong>
                    <li>Download the latest version of <a href="{{ route('pages.download') }}" target="_blank">ScoreManager.jar</a></li>
                    <li>Open your project in Eclipse</li>
                    <li>In Package Explorer, right click your project, go to Build Path -> Configure Build Path</li>
                    <li>Click Add External Jars, then navigate to the downloaded ScoreManager.jar and click OK</li>
                </ol>
            </li>
        </ol>
    </h5>

    <h1 class="mt-3">How do I use it?</h1>
    <h5>
        First, take note of the API key and IDs of your registered apps, all shown on your profile page.
        You'll need to know these to use the API.

        First, create a new instance of the ScoreManager class using your API key and app ID.
    </h5>
    <pre class="mb-0 pb-0">
        <code class="java">
import com.aidanmurphey.scoremanager.ScoreManager;

public class Main {

    public static void main(String[] args) {
        String apiKey = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"; //32 character string, given in your profile page
        int appID = 33; //Integer, given in your profile page. Different for each app you register with the service
        ScoreManager scoreManager = new ScoreManager(apiKey, appID);
    }

}
        </code>
    </pre>
    <h5 class="mt-0 pt-0">Example code, insert a record into the leaderboard then display all records</h5>
    <pre class="mb-0 pb-0">
        <code class="java">
import java.util.ArrayList;

import com.aidanmurphey.scoremanager.ApiResponse;
import com.aidanmurphey.scoremanager.Record;
import com.aidanmurphey.scoremanager.ScoreManager;

public class Main {

    public static void main(String[] args) {
        String apiKey = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"; //32 character string, given in your profile page
        int appID = 33; //Integer, given in your profile page. Different for each app you register with the service
        ScoreManager scoreManager = new ScoreManager(apiKey, appID);

        //add new record
        String nameOfRecordHolder = "Aidan";
        int score = 338;
        ApiResponse response = scoreManager.submitRecord(nameOfRecordHolder, score);
        if (response.getFailed()) {
            System.out.println(response.getError());
        } else {
            System.out.println("Successfully added new record to leaderboards!");
        }

        //fetch all records and display
        ApiResponse response2 = scoreManager.requestRecords();
        if (response2.getFailed()) {
            System.out.println(response2.getError());
        } else {
            ArrayList{{ "<Record>" }} records = response2.getRecords();
            records.forEach(record -> {
                int rank = records.indexOf(record) + 1;
                System.out.println(rank + ") " + record.getName() + " - " + record.getScore());
            });
        }
    }

}
/*
    Output (On newly registered app with no existing records):
    Successfully added new record to leaderboards!
    1) Aidan - 338.0
*/
        </code>
    </pre>
@endsection
