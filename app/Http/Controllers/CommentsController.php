<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    protected $answer;
    protected $question;
    protected $comment;

    public function __construct(CommentRepository $answer,CommentRepository $question,CommentRepository $comment)
    {
        $this->answer = $answer;
        $this->question = $question;
        $this->comment = $comment;
    }

    public function store()
    {
        $model = $this->comment->getModelNameFromType(request('type'));

        $comment = $this->comment->create([
            'commentable_id' => request('id'),
            'commentable_type' => $model,
            'user_id' => Auth::guard('api')->user()->id,
            'body' => request('body')
        ]);

        return $comment;
    }

    public function question($id)
    {
        $question = $this->question->findQuestions($id);
        return $question->comments;
    }

    public function answer($id)
    {
        $answer = $this->answer->findAnswers($id);
        return $answer->comments;
    }


}
