<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\App;
use App\User;
use App\Record;

class ApiController extends Controller
{
    public function getRecords(Request $request, $id) {
        $response = [
            'failed' => false
        ];

        $api_key = $request->header('Api-Key');
        if ($api_key == null || $api_key == '') { //if empty/missing API key
            $response['failed'] = true;
            $response['error'] = 'Empty or no API key specified!';
        } else { //definitely have an API key
            $user = User::where('api_key', $api_key)->first();

            if ($user == null) { //if no user is associated with given API key
                $response['failed'] = true;
                $response['error'] = 'Invalid API key specified!';
            } else { //user found, valid API key
                $app = App::find($id);
                if ($app == null) { //if invalid App id
                    $response['failed'] = true;
                    $response['error'] = 'Invalid or no API key specified!';
                } else { //valid App id, app found
                    if ($user->id != $app->user_id) { //if user is owner of registered app
                        $response['failed'] = true;
                        $response['error'] = 'You do not have permission to view this app\'s records!';
                    } else { //everything verified, insert app's records into response
                        $response['records'] = $app->records()->orderBy('score', 'desc')->get();
                    }
                }
            }
        }

        return response()->json($response);
    }

    public function addRecord(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'score' => 'required|numeric'
        ]);

        $response = [
            'failed' => false
        ];

        if ($validator->fails()) {
            $response['failed'] = true;
            $response['error'] = 'Invalid or missing post data!';
        } else {
            $api_key = $request->header('Api-Key');
            if ($api_key == null || $api_key == '') { //if empty/missing API key
                $response['failed'] = true;
                $response['error'] = 'Empty or no API key specified!';
            } else { //definitely have an API key
                $user = User::where('api_key', $api_key)->first();

                if ($user == null) { //if no user is associated with given API key
                    $response['failed'] = true;
                    $response['error'] = 'Invalid API key specified!';
                } else { //user found, valid API key
                    $app = App::find($id);

                    if ($app == null) { //if invalid App id
                        $response['failed'] = true;
                        $response['error'] = 'Invalid or no app id specified!';
                    } else { //valid App id, app found
                        if ($user->id != $app->user_id) { //if user is owner of registered app
                            $response['failed'] = true;
                            $response['error'] = 'You do not have permission to edit this app\'s records!';
                        } else { //everything verified, add new record
                            $record = new Record;
                            $record->app_id = $id;
                            $record->name = $request->input('name');
                            $record->score = $request->input('score');
                            $record->save();
                        }
                    }
                }
            }
        }

        return response()->json($response);
    }

    //Method is WIP
    public function resetRecords(Request $request, $id) {
        $response = [
            'failed' => false
        ];

        $api_key = $request->header('Api-Key');
        if ($api_key == null || $api_key == '') { //if empty/missing API key
            $response['failed'] = true;
            $response['error'] = 'Empty or no API key specified!';
        } else { //definitely have an API key
            $user = User::where('api_key', $api_key)->first();

            if ($user == null) { //if no user is associated with given API key
                $response['failed'] = true;
                $response['error'] = 'Invalid API key specified!';
            } else { //user found, valid API key
                $app = App::find($id);

                if ($app == null) { //if invalid App id
                    $response['failed'] = true;
                    $response['error'] = 'Invalid or no app id specified!';
                } else { //valid App id, app found
                    if ($user->id != $app->user_id) { //if user is owner of registered app
                        $response['failed'] = true;
                        $response['error'] = 'You do not have permission to edit this app\'s records!';
                    } else { //everything verified, reset records
                        /*
                         * TODO: Verify all if statements, copied and pasted from last controller method, dunno if this is everything I need
                         *          or even if it'll work haha
                         */
                    }
                }
            }
        }

        return response()->json($response);
    }
}
