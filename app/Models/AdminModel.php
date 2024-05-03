<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'full_name'];
    protected $useTimestamps = true;
}
