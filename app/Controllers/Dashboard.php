<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function __construct()
    {
        protect_page([ROLE_ADMIN, ROLE_TEACHER, ROLE_STUDENT]);
    }

    public function index()
    {
        $data = [
            'title' => 'LSM - Dashboard'
        ];
        return view('dashboard', $data);
    }
}
