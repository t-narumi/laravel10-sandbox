<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SetCookieController extends Controller
{
    public function __invoke(): Response
    {
        return response('cookie set', 200)
            ->cookie('testKey', 'aiueo');
    }
}
