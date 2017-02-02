<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];
    public function isHidden()
    {
        return $this->is_hidden === 'T';
    }
}
