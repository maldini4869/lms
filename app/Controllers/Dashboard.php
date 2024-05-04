<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'LSM - Dashboard'
        ];
        return view('dashboard', $data);
    }
}
