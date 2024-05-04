<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email', 'password', 'full_name', 'role_id', 'profile_picture', 'phone_number', 'is_active'
    ];
    protected $useTimestamps = true;
}
