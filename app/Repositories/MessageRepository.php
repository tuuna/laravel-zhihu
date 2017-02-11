<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 17-2-11
 * Time: 下午2:08
 */

namespace App\Repositories;


use App\Message;

class MessageRepository
{
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }

}