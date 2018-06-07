<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App;
use Carbon\Carbon;

class CronController extends Controller
{

    public function purge(Request $request) {
        $k1 = $request->input('k1');
        $k2 = $request->input('k2');

        $key1 = env('CRON_KEY1');
        $key2 = env('CRON_KEY2');

        if ($k1 == $key1 && $k2 == $key2) {
            $formatted_date = Carbon::now()->subMonths(2)->toDateTimeString();

            $apps = App::where('created_at', '<=', $formatted_date)->get();

            //loop through resulting apps (all existing older than 2 months)
            foreach ($apps as $app) {
                //delete child records
                $app->records()->delete();

                //delete app
                $app->delete();
            }
        }

        return '';
    }

}
