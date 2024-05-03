<?php

namespace App\Controllers;

class Student extends BaseController
{
    public function __construct()
    {
        if (is_loggeded_in() && is_authorized([ROLE_ADMIN, ROLE_TEACHER, ROLE_STUDENT])) {
            return redirect()->to('/auth/login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'LSM - Dashboard'
        ];
        return view('student/list', $data);
    }
}
