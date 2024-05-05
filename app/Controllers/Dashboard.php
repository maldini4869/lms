<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'LMS - Dashboard'
        ];
        return view('dashboard', $data);
    }
}
