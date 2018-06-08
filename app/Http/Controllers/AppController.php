<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\App;

class AppController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function show($id) {
        $app = App::find($id);

        if ($app == null)
            return redirect('/profile')->withErrors(['The specified app does not exist!']);

        if ($app->user_id != Auth::id())
            return redirect('/profile')->withErrors(['You do not have permission to view the specified app!']);

        $data = [
            'app' => $app,
            'records' => $app->records()->orderBy('score', 'desc')->paginate(10)
        ];

        return view('pages.show_app')->with($data);
    }

    public function reset($id) {
        $app = App::find($id);

        if ($app == null)
            return redirect('/profile')->withErrors(['The specified app does not exist!']);

        if ($app->user_id != Auth::id())
            return redirect('/profile')->withErrors(['You do not have permission to reset the specified app!']);

        $app->records()->delete();
        return redirect('/app/' . $app->id)->with('success', 'You have successfully reset the app!');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $app = new App;
        $app->user_id = Auth::id();
        $app->name = $request->input('name');
        $app->save();

        return redirect('/profile')->with('success', 'You have successfully registered app: ' . $app->name);
    }

    public function destroy($id) {
        $app = App::find($id);

        if ($app == null)
            return redirect('/profile')->withErrors(['The specified app does not exist!']);

        if ($app->user_id != Auth::id())
            return redirect('/profile')->withErrors(['You do not have permission to delete the specified app!']);

        //delete app's records
        $app->records()->delete();

        //delete app
        $app->delete();
        return redirect('/profile')->with('success', 'You have successfully deleted app: ' . $app->name);
    }

}
