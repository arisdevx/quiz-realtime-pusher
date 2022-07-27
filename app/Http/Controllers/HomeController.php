<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Events
use App\Events\NoteEvent;
use App\Events\QuizEvent;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function testNotePost(Request $request)
    {
        $key = $request->key;

        event(new NoteEvent(Auth::user(), $key));
    }

    public function postAnswer(Request $request)
    {
        $user = Auth::user();
        $answer = $request->answer;

        event(new QuizEvent($user, $answer));
    }
}
