<?php

namespace App\Models;

class UserModel extends BaseModel
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email', 'password', 'full_name', 'role_id', 'profile_picture', 'phone_number', 'is_active'
    ];
    protected $useTimestamps = true;
}
