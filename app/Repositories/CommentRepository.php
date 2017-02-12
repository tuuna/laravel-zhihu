<?php
namespace App\Repositories;

use App\Answer;
use App\Comment;
use App\Question;

class CommentRepository
{
    public function create(array $attributes)
    {
        return Comment::create($attributes);
    }

    public function getModelNameFromType($type)
    {
        return $type === 'question' ? 'App\Question' : 'App\Answer';
    }

    public function findQuestions($id)
    {
        return Question::with('comments','comments.user')
                        ->where('id',$id)
                        ->first();
    }

    public function findAnswers($id)
    {
        return Answer::with('comments','comments.user')
                        ->where('id',$id)
                        ->first();
    }
}