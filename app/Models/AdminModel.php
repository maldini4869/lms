<?php

namespace App\Models;

class AdminModel extends BaseModel
{
    protected $table      = 'admins';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'full_name'];
    protected $useTimestamps = true;
}
