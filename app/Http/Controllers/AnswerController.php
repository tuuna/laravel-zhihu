<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\AnswerRepository;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    protected $answer;

    /**
     * AnswerController constructor.
     * @param AnswerRepository $answer
     */
    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param StoreQuestionRequest $request
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreQuestionRequest $request,$question)
    {
        $answer = $this->answer->create([
            'question_id' => $question,
            'user_id' => Auth::id(),
            'body' => $request->get('body')
        ]);

        $this->answer->addAnswerCount($answer);
        return back();
    }
}
