<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function home()
    {
        return view('frontend.home');
    }

    public function host()
    {
        return view('frontend.host');
    }

    public function invite()
    {
        return view('frontend.invite');
    }

    public function meetings()
    {
        return view('frontend.meetings');
    }

    public function past_meetings()
    {
        return view('frontend.past_meetings');
    }

    public function unauthorized_recording()
    {
        return view('frontend.unauthorized_recording');
    }
}
