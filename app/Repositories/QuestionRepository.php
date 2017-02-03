<?php
namespace App\Repositories;

use App\Question;
use App\Topic;

/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 17-2-3
 * Time: 下午9:48
 */
class QuestionRepository
{
    public function byIdWithTopics($id)
    {
        return Question::with('topics')->findOrfail($id);
    }

    public function create(array $attribute)
    {
        return Question::created($attribute);
    }

    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function($topic) {
            if(is_numeric($topic)) {
                Topic::find($topic)->increment('questions_count');
                return (int) $topic;
            }
            $newTopic = Topic::create(['name' => $topic,'questions_count' => 1]);
            return $newTopic->id;
        })->toArray();
    }
}