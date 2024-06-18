<?php

namespace App\Models;

class StudentAssignmentModel extends BaseModel
{
    protected $table      = 'student_assignments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['session_item_id', 'student_id', 'file', 'grade', 'feedback'];
    protected $useTimestamps = true;
    protected $with = 'students';
}
