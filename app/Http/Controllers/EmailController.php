<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function verify()
    {
        Mail::send('随便传个空view', [], function ($message) {
            $message->from('lj550566181@163.com', 'Laravel');

            $message->to('')->cc('bar@example.com');

            // 模板变量
            $bind_data = ['url' => 'http://naux.me'];
            $template = new SendCloudTemplate('模板名', $bind_data);

            $message->getSwiftMessage()->setBody($template);
        });
        return view('login');
    }
}
