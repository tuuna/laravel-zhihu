<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function isHidden()
    {
        return $this->is_hidden === 'T';
    }
}
