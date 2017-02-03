<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['name','questions_count','summary'];

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
}
