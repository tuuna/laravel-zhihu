<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    protected $messages;

    public function __construct(MessageRepository $messages)
    {
        $this->messages = $messages;
    }

    public function store()
    {
        $message = $this->messages->create([
                    'to_user_id' => request('user'),
                    'from_user_id' => Auth::guard('api')->user()->id,
                    'body' => request('body')
        ]);
        if($message) {
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
}
