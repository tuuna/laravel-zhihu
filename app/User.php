<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','confirmation_token','api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function owns(Model $model)
    {
        return $this->id == $model->user_id;
    }

    public function follows()
    {
        return $this->belongsToMany(Question::class,'user_question')->withTimestamps();
    }

    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }

    public function followed($question)
    {

        return  $this->follows()->where('question_id',$question)->count()? :0;
    }


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $data = [
            'url' => url('password/reset',$token)
        ];
        Mail::send(
            "emails.reset",
            $data,
            function($message) {
                $message->to($this->email)
                    ->subject("这是一封最终的测试邮件");
            }
        );
    }
}
