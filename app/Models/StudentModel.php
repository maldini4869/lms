<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table      = 'student';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'full_name', 'nisn'];
    protected $useTimestamps = true;
}
