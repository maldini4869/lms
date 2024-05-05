<?php

namespace App\Controllers;

class Forbidden extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'LMS - Forbidden'
        ];
        return view('403', $data);
    }
}
