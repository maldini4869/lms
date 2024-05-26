<?php

namespace App\Models;

class SessionStudentModel extends BaseModel
{
    protected $table      = 'sessions_students';
    protected $primaryKey = 'id';
    protected $allowedFields = ['session_id', 'student_id'];
    protected $useTimestamps = true;
}
