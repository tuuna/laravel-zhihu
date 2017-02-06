<?php
namespace App\Repositories;

use App\Answer;

class AnswerRepository
{
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }

    public function addAnswerCount($query)
    {
        return $query->question()->increment('answers_count');
    }
}