<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table      = 'teacher';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'full_name', 'nip'];
    protected $useTimestamps = true;
}
