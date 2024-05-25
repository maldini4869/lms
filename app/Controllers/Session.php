<?php

namespace App\Controllers;

class Session extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'LMS - Pertemuan'
        ];
        return view('session/list', $data);
    }
}
