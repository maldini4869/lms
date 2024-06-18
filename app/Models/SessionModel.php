<?php

namespace App\Models;

class SessionModel extends BaseModel
{
    protected $table      = 'sessions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'schedule_id', 'week'];
    protected $useTimestamps = true;
    protected $with = ['schedules'];
}
