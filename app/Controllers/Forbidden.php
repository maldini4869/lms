<?php

namespace App\Controllers;

class Forbidden extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'LSM - Forbidden'
        ];
        return view('403', $data);
    }
}
