<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class PageController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['only' => ['profile']]);
    }

    public function index() {
        return view('pages.index');
    }

    public function docs() {
        return view('pages.docs');
    }

    public function profile() {
        $user = Auth::user();
        $data = [
            'user' => $user,
            'apps' => $user->apps
        ];

        return view('pages.profile')->with($data);
    }

    public function download() {
        return redirect('https://github.com/ZeezCode/ScoreManagerClient/releases');
    }
}
