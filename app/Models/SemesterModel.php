<?php

namespace App\Models;

class SemesterModel extends BaseModel
{
    protected $table      = 'semesters';
    protected $primaryKey = 'id';
    protected $allowedFields = ['semester', 'semester_year'];
    protected $useTimestamps = true;
}
