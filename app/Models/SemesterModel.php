<?php

namespace App\Models;

use CodeIgniter\Model;

class SemesterModel extends Model
{
    protected $table      = 'semester';
    protected $primaryKey = 'id';
    protected $allowedFields = ['semester', 'semester_year'];
    protected $useTimestamps = true;
}
