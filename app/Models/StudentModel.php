<?php

namespace App\Models;

class StudentModel extends BaseModel
{
    protected $table      = 'students';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'full_name', 'nisn'];
    protected $useTimestamps = true;
    protected $with = 'users';
}
