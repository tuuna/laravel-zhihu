<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionFollowController extends Controller
{
    /**
     * QuestionFollowController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function follow($question_id)
    {
        Auth::user()->followThis($question_id);

        return back();
    }
}
