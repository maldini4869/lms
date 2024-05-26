<?php

namespace App\Models;

class SessionItemModel extends BaseModel
{
    protected $table      = 'session_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['session_id', 'text', 'file', 'type', 'user_id'];
    protected $useTimestamps = true;
    protected $with = 'users';
}
