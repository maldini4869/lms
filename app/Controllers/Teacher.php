<?php

namespace App\Controllers;

use App\Models\TeacherModel;

class Teacher extends BaseController
{

    protected $teacherModel;

    public function __construct()
    {
        protect_page([ROLE_ADMIN]);

        $this->teacherModel = new TeacherModel();
    }

    public function index()
    {
        $data = [
            'title' => 'LSM - Guru'
        ];
        return view('teacher/list', $data);
    }
}
