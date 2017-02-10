<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 17-2-10
 * Time: 下午4:09
 */

namespace App\Mailer;


use Illuminate\Support\Facades\Auth;

class UserMailer extends Mailer
{
    public function followNotifyEmail($email,$msg)
    {
        $data = [
            'url' => 'http://localhost:8000',
            'name' => Auth::guard('api')->user()->name
        ];
        $this->sendTo('emails.notice',$data,$email,$msg);
    }

    public function passwordReset($token,$email,$msg)
    {
        $data = ['url' => url('password/reset',$token)];
        $this->sendTo('emails.reset',$data,$email,$msg);
    }

    public function welcome(User $user)
    {
        $data = [
            'url' => route('email.verify',['token' => $user->confirmation_token]),
            'name' => $user->name
        ];
        $this->sendTo('emails.test',$user->email,'请激活您的邮件');
    }
}