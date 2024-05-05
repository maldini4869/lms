<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table      = 'subject';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
}
