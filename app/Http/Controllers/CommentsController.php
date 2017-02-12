<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store()
    {
        $model = $this->getModelNameFromType(request('type'));

        $comment = Comment::create([
            'commentable_id' => request('id'),
            'commentable_type' => $model,
            'user_id' => Auth::guard('api')->user()->id,
            'body' => request('body')
        ]);

        if(request('type') == 'question')
            Question::increment('comments_count');
        return $comment;
    }

    public function question($id)
    {
        $question = Question::with('comments','comments.user')
                             ->where('id',$id)
                             ->first();
        return $question->comments;
//        dd($question->comments);
    }

    public function answer($id)
    {
        $answer = Answer::with('comments','comments.user')
            ->where('id',$id)
            ->first();
        return $answer->comments;
    }

    private function getModelNameFromType($type)
    {
        return $type === 'question' ? 'App\Question' : 'App\Answer';
    }
}
