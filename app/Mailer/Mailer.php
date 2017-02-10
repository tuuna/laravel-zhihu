<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 17-2-10
 * Time: 下午2:36
 */

namespace App\Mailer;




use Illuminate\Support\Facades\Mail;

class Mailer
{
    public function sendTo($view,array $data,$email,$msg)
    {
        Mail::send(
            $view,
            $data,
            function($message) use ($email,$msg) {
                $message->to($email)
                    ->subject($msg);
            }
        );
    }
}