<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function verify()
    {
        Mail::send('随便传个空view', [], function ($message) {
            $message->from('us@example.com', 'Laravel');

            $message->to('foo@example.com')->cc('bar@example.com');

            // 模板变量
            $bind_data = ['url' => 'http://naux.me'];
            $template = new SendCloudTemplate('模板名', $bind_data);

            $message->getSwiftMessage()->setBody($template);
        });
    }
}
